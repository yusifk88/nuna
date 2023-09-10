<template>
  <ion-page ref="page">


    <ion-header v-if="!$store.state.initApp" mode="ios">
      <ion-toolbar>

        <ion-row>
          <ion-col class="ion-align-self-start">
            <img height="40"
                 src="https://objectstorage.uk-london-1.oraclecloud.com/n/lrj6a9vl4is6/b/MyBucket/o/logo.png"
            >
          </ion-col>
          <ion-col size="2">
            <ion-icon :icon="notificationsOutline" class="ion-margin-top" size="large"
                      @click="$router.push({path:'/notifications'})"></ion-icon>

          </ion-col>
          <ion-col class="ion-align-self-end" size="2">

            <ion-avatar v-if="$store.state.user" height="20" @click="$router.push({path:'/profile'})">
              <img :alt="$store.state.user.first_name+' profile photo'"
                   src="https://ionicframework.com/docs/demos/api/avatar/avatar.svg"/>
            </ion-avatar>

          </ion-col>

        </ion-row>
      </ion-toolbar>

    </ion-header>

    <list-loading-component v-if="loading" :count="6"></list-loading-component>

    <ion-content v-else :fullscreen="true" class="ion-padding">

      <ion-refresher slot="fixed" @ionRefresh="getDashboard($event)">
        <ion-refresher-content></ion-refresher-content>
      </ion-refresher>

      <ion-row>
        <ion-col size="8">
          <ion-text v-if="$store.state.user">
            <small v-if="!dashboard" class="text-muted">Let's get you up and running</small>
            <small v-else class="text-muted font-weight-bold">Good day!</small>

            <h2 class="no-margin no-padding">{{ $store.state.user.first_name }} {{ $store.state.user.last_name }}</h2>

          </ion-text>
        </ion-col>

        <ion-col size="2">

          <ion-button class="ion-margin-top" fill="clear" shape="round" size="small" @click="getDashboard">
            <ion-icon :icon="reloadCircleOutline" size="large"></ion-icon>
          </ion-button>

        </ion-col>

        <ion-col size="2">

          <ion-button v-if="dashboard && dashboard.weddings.length>0" id="add-shortcut"
                      class="ion-margin-top" fill="clear" shape="round" size="small"
                      @click="shareLink(getURL(dashboard.weddings[0]))">
            <ion-icon :icon="shareOutline" size="large"></ion-icon>
          </ion-button>


        </ion-col>


      </ion-row>


      <get-started-component v-if="dashboard && !dashboard.weddings.length"></get-started-component>

      <dashboard-cards v-else-if="dashboard" :weddings="dashboard.weddings"></dashboard-cards>

      <ion-row v-if="dashboard && dashboard.weddings.length">
        <ion-col size="12">
          <p>Summary</p>

        </ion-col>
      </ion-row>

      <dashboard-summary-component
          v-if="dashboard && dashboard.weddings.length"
          :dashboard="dashboard"
          @contributionTapped="showcontribution"
          @guestTapped="showGuest"
      ></dashboard-summary-component>

      <ion-row v-if="dashboard && dashboard.weddings.length">
        <ion-col size="12">
          <p>Recent Activities</p>
        </ion-col>
      </ion-row>

      <dashbord-recent-acitivities-component
          v-if="dashboard && dashboard.weddings.length"></dashbord-recent-acitivities-component>


      <ion-modal ref="modal"
                 :is-open="showGuestDialog"
                 :presenting-element="presentingElement"
                 mode="ios">
        <ion-header>
          <ion-toolbar>
            <ion-title>{{ dialogType === 'guest' ? 'Guests' : 'Contributions' }} List</ion-title>
            <ion-buttons slot="end">
              <ion-button @click="dismiss">Close</ion-button>
            </ion-buttons>
          </ion-toolbar>
        </ion-header>


        <ion-content class="ion-padding">

          <guest-list v-if="dialogType==='guest'"></guest-list>
          <contribution-list :lite="true" v-else></contribution-list>

        </ion-content>


      </ion-modal>

<tips-component></tips-component>
    </ion-content>
  </ion-page>


</template>

<script>

import store from "@/store";
import {Share} from '@capacitor/share';


import {defineComponent} from 'vue';
import {
  arrowForwardOutline,
  reloadCircleOutline,
  warningOutline,
  addOutline,
  shareOutline,
  notificationsOutline
} from "ionicons/icons";
import {
  IonTitle,
  IonButtons,
  IonAvatar,
  IonCol,
  IonContent,
  IonHeader,
  IonIcon,
  IonPage,
  IonRow,
  IonText,
  IonToolbar,
  IonButton,
  IonRefresher,
  IonRefresherContent,
  IonModal
} from '@ionic/vue';
import GetStartedComponent from "@/components/getStartedComponent.vue";
import axios from "axios";
import DashboardCards from "@/components/dashboardCards";
import DashboardSummaryComponent from "@/components/dashboardSummaryComponent";
import DashbordRecentAcitivitiesComponent from "@/components/dashbordRecentAcitivitiesComponent";
import ListLoadingComponent from "@/components/ListLoadingComponent";
import GuestList from "@/components/GuestList";
import ContributionList from "@/components/contributionList";
import TipsComponent from "@/components/TipsComponent.vue";

export default defineComponent({
  name: 'Tab1Page',
  components: {
    TipsComponent,
    ContributionList,
    GuestList,
    IonTitle,
    IonButtons,
    IonModal,
    ListLoadingComponent,
    DashbordRecentAcitivitiesComponent,
    DashboardSummaryComponent,
    DashboardCards,
    GetStartedComponent,
    IonAvatar,
    IonRow,
    IonCol,
    IonHeader,
    IonToolbar,
    IonContent,
    IonPage,
    IonText,
    IonIcon,
    IonButton,
    IonRefresher,
    IonRefresherContent
  },
  data() {
    return {
      showGuestDialog: false,
      store,
      arrowForwardOutline,
      warningOutline,
      reloadCircleOutline,
      addOutline,
      shareOutline,
      loading: false,
      dashboard: null,
      presentingElement: null,
      dialogType: "guest",
      notificationsOutline
    }
  },
  methods: {

    dismiss() {
      this.$refs.modal.$el.dismiss();
      this.showGuestDialog = false;
    },
    showGuest() {
      this.showGuestDialog = true;
      this.dialogType = "guest";
    },
    showcontribution() {
      this.showGuestDialog = true;
      this.dialogType = "contribution";
    },

    getURL(wedding) {

      return this.store.state.baseURL + "/w/" + wedding.tag;

    },
    async shareLink(link) {

      await Share.share({
        title: this.dashboard.weddings[0].tag,
        text: this.dashboard.weddings[0].groom_name + " and " + this.dashboard.weddings[0].bride_name + "'s wedding",
        url: link,
        dialogTitle: 'Share you wedding link',
      });

    },


    getDashboard(e) {

      this.loading = true;

      axios.get("/dashboard")
          .then(res => {
            this.dashboard = res.data.data;
            this.$store.state.weddings = this.dashboard.weddings;

            this.loading = false;

            if (e) {
              e.target.complete();
            }
          })
          .catch(() => {

            this.loading = false;

            if (e) {
              e.target.complete();
            }

          })
    }


  },
  mounted() {
    this.getDashboard();
    this.presentingElement = this.$refs.page.$el;
  }

});

</script>
<style>

</style>

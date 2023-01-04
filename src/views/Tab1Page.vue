<template>
  <ion-page>


    <ion-header mode="ios" v-if="!$store.state.initApp">
      <ion-toolbar>

        <ion-row>
          <ion-col class="ion-align-self-start">
            <img height="40"
                 src="https://objectstorage.uk-london-1.oraclecloud.com/n/lrj6a9vl4is6/b/MyBucket/o/logo.png"
            >
          </ion-col>

          <ion-col size="2" class="ion-align-self-end">

            <ion-avatar v-if="$store.state.user">
              <img width="10" :alt="$store.state.user.first_name+' profile photo'"
                   src="https://ionicframework.com/docs/demos/api/avatar/avatar.svg"/>
            </ion-avatar>

          </ion-col>

        </ion-row>
      </ion-toolbar>

    </ion-header>

    <list-loading-component v-if="loading" :count="6"></list-loading-component>

    <ion-content v-else :fullscreen="true" class="ion-padding">

      <ion-refresher @ionRefresh="getDashboard($event)" slot="fixed">
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

          <ion-button class="ion-margin-top" @click="getDashboard" shape="round" size="small" fill="clear">
            <ion-icon size="large" :icon="reloadCircleOutline"></ion-icon>
          </ion-button>

        </ion-col>

        <ion-col size="2">

          <ion-button v-if="dashboard && dashboard.weddings.length>0" class="ion-margin-top" @click="shareLink(getURL(dashboard.weddings[0]))" id="add-shortcut" fill="clear" shape="round" size="small">
            <ion-icon size="large" :icon="shareOutline"></ion-icon>
          </ion-button>


        </ion-col>




      </ion-row>


      <get-started-component v-if="dashboard && !dashboard.weddings.length"></get-started-component>

      <dashboard-cards v-else-if="dashboard" :weddings="dashboard.weddings"></dashboard-cards>

      <ion-row v-if="dashboard && dashboard.weddings.length">
        <ion-col size="12">
          <h3>Summary</h3>

        </ion-col>
      </ion-row>

      <dashboard-summary-component v-if="dashboard && dashboard.weddings.length"></dashboard-summary-component>

      <ion-row v-if="dashboard && dashboard.weddings.length">
        <ion-col size="12">
      <h3>Recent Activities</h3>
        </ion-col>
      </ion-row>

      <dashbord-recent-acitivities-component v-if="dashboard && dashboard.weddings.length"></dashbord-recent-acitivities-component>
    </ion-content>
  </ion-page>

<!--  <loading-component></loading-component>-->

</template>

<script>

import store from "@/store";
import { Share } from '@capacitor/share';

import {defineComponent} from 'vue';
import {arrowForwardOutline, reloadCircleOutline, warningOutline,addOutline,shareOutline} from "ionicons/icons";
import {
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
    IonRefresherContent
} from '@ionic/vue';
import GetStartedComponent from "@/components/getStartedComponent.vue";
import axios from "axios";
import DashboardCards from "@/components/dashboardCards";
import DashboardSummaryComponent from "@/components/dashboardSummaryComponent";
import DashbordRecentAcitivitiesComponent from "@/components/dashbordRecentAcitivitiesComponent";
import ListLoadingComponent from "@/components/ListLoadingComponent";

export default defineComponent({
  name: 'Tab1Page',
  components: {
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
      store,
      arrowForwardOutline,
      warningOutline,
      reloadCircleOutline,
      addOutline,
      shareOutline,
      loading:false,
      dashboard: null
    }
  },
  methods: {

    getURL(wedding) {

      return this.store.state.baseURL+"/w/" + wedding.tag;


    },
   async shareLink(link){

      await Share.share({
        title: this.dashboard.weddings[0].tag,
        text: this.dashboard.weddings[0].groom_name+" and "+this.dashboard.weddings[0].bride_name+"'s wedding",
        url: link,
        dialogTitle: 'Share you wedding link',
      });

    },


    getDashboard(e) {

     this.loading=true;

      axios.get("/dashboard")
          .then(res => {
            this.dashboard = res.data.data;
            this.$store.state.weddings = this.dashboard.weddings;

            this.loading=false;

            if (e) {
              e.target.complete();
            }
          })
          .catch(erros => {
            if (e) {
              e.target.complete();
            }

          })
    }


  },
  mounted() {
    this.getDashboard();
  }

});

</script>
<style>

</style>

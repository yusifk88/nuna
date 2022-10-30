<template>
  <ion-page>


    <ion-header mode="ios" v-if="!$store.state.initApp">
      <ion-toolbar>

        <ion-row>
          <ion-col class="ion-align-self-start">
            <img height="40"
                 src="https://objectstorage.uk-london-1.oraclecloud.com/n/lrj6a9vl4is6/b/MyBucket/o/logo.png">
          </ion-col>

          <ion-col size="2" class="ion-align-self-end">
            <ion-badge v-if="$store.state.user && !$store.state.user.email_verified_at" color="danger">
              <ion-icon :icon="warningOutline"></ion-icon>
            </ion-badge>
            <ion-avatar style="border: 2px solid red" v-if="$store.state.user">
              <img width="10" :alt="$store.state.user.first_name+' profile photo'"
                   src="https://ionicframework.com/docs/demos/api/avatar/avatar.svg"/>
            </ion-avatar>

          </ion-col>

        </ion-row>
      </ion-toolbar>

    </ion-header>


    <ion-content :fullscreen="true" class="ion-padding">

      <ion-row>
        <ion-col size="8">
          <ion-text v-if="$store.state.user">
            <h2 class="no-margin no-padding">{{ $store.state.user.first_name }} {{ $store.state.user.last_name }}</h2>

            <small v-if="!dashboard" class="text-muted">Let's get you up and running</small>
            <small v-else class="text-muted ion-margin-start">Good day!</small>

          </ion-text>
        </ion-col>

        <ion-col size="2">

          <ion-fab-button @click="$router.push({path:'/new/wedding'})" id="add-shortcut" size="small" shape="round">
            <ion-icon :icon="addOutline"></ion-icon>
          </ion-fab-button>


        </ion-col>

        <ion-col size="2">

          <ion-button class="ion-margin-top" @click="getDashboard" size="small" fill="clear">
            <ion-icon size="large" :icon="reloadCircleOutline"></ion-icon>
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
</template>

<script>

import store from "@/store";
import {defineComponent} from 'vue';
import {arrowForwardOutline, reloadCircleOutline, warningOutline,addOutline} from "ionicons/icons";
import {
  IonAvatar,
  IonBadge,
  IonCol,
  IonContent,
  IonHeader,
  IonIcon,
  IonPage,
  IonRow,
  IonText,
  IonToolbar,
    IonFabButton,
    IonButton
} from '@ionic/vue';
import GetStartedComponent from "@/components/getStartedComponent.vue";
import axios from "axios";
import DashboardCards from "@/components/dashboardCards";
import DashboardSummaryComponent from "@/components/dashboardSummaryComponent";
import DashbordRecentAcitivitiesComponent from "@/components/dashbordRecentAcitivitiesComponent";

export default defineComponent({
  name: 'Tab1Page',
  components: {
    DashbordRecentAcitivitiesComponent,
    DashboardSummaryComponent,
    DashboardCards,
    GetStartedComponent,
    IonBadge,
    IonAvatar,
    IonRow,
    IonCol,
    IonHeader,
    IonToolbar,
    IonContent,
    IonPage,
    IonText,
    IonIcon,
    IonFabButton,
    IonButton,

  },
  data() {
    return {
      store,
      arrowForwardOutline,
      warningOutline,
      reloadCircleOutline,
      addOutline,
      dashboard: null
    }
  },
  methods: {

    getDashboard(e) {

      this.$store.state.mainLoadingText = "Hung on...";
      this.$store.state.mainLoadingDescription = "We are getting your dashboard...";
      this.$store.state.mainLoading = true;

      axios.get("/dashboard")
          .then(res => {
            this.dashboard = res.data.data;

            this.$store.state.mainLoading = false;
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

<template>
  <ion-page>


    <ion-header mode="ios" v-if="!$store.state.initApp">
      <ion-toolbar>

        <ion-row>
          <ion-col class="ion-align-self-start">
            <img height="50"
                 src="https://objectstorage.uk-london-1.oraclecloud.com/n/lrj6a9vl4is6/b/MyBucket/o/logo.png">
          </ion-col>

          <ion-col size="2" class="ion-align-self-end">
            <ion-badge v-if="$store.state.user && !$store.state.user.email_verified_at" color="danger">
              <ion-icon :icon="warningOutline"></ion-icon>
            </ion-badge>
            <ion-avatar style="border: 2px solid red">
              <img alt="Silhouette of a person's head"
                   src="https://ionicframework.com/docs/demos/api/avatar/avatar.svg"/>
            </ion-avatar>

          </ion-col>

        </ion-row>
      </ion-toolbar>

    </ion-header>
    <ion-content :fullscreen="true" class="ion-padding">

      <ion-row>
        <ion-col size="10">
          <ion-text v-if="$store.state.user">
            <h2>{{ $store.state.user.first_name }} {{ $store.state.user.last_name }}</h2>

            <small v-if="!dashboard" class="text-muted">Let's get you up and running</small>
            <small v-else class="text-muted">Good morning</small>

          </ion-text>
        </ion-col>
        <ion-col size="2">

          <ion-button @click="getDashboard" size="large" fill="clear">
            <ion-icon :icon="reloadCircleOutline"></ion-icon>
          </ion-button>

        </ion-col>
      </ion-row>


      <get-started-component v-if="!dashboard"></get-started-component>

      <dashboard-cards v-else :weddings="dashboard.weddings"></dashboard-cards>


    </ion-content>
  </ion-page>
</template>

<script>

import store from "@/store";
import {defineComponent} from 'vue';
import {arrowForwardOutline, reloadCircleOutline, warningOutline} from "ionicons/icons";
import {
  IonAvatar,
  IonBadge,
  IonButton,
  IonCol,
  IonContent,
  IonHeader,
  IonIcon,
  IonPage,
  IonRow,
  IonText,
  IonToolbar
} from '@ionic/vue';
import GetStartedComponent from "@/components/getStartedComponent.vue";
import axios from "axios";
import DashboardCards from "@/components/dashboardCards";

export default defineComponent({
  name: 'Tab1Page',
  components: {
    DashboardCards,
    IonButton,
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
    IonIcon
  },
  data() {
    return {
      store,
      arrowForwardOutline,
      warningOutline,
      reloadCircleOutline,
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
            console.log(res.data.data);

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
<style scoped>
ion-badge {
  position: absolute;
  left: -12px;
}
</style>

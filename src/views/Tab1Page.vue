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

      <ion-text v-if="$store.state.user">
        <h1>Howdy {{ $store.state.user.first_name }},</h1>
      </ion-text>

      <verify-card-component></verify-card-component>

      <ion-text v-if="$store.state.user">
        <p>Let's get you up and running</p>
      </ion-text>

      <get-started-component></get-started-component>


    </ion-content>
  </ion-page>
</template>

<script lang="ts">

import store from "@/store";
import {defineComponent} from 'vue';
import {arrowForwardOutline, warningOutline} from "ionicons/icons";
import {
  IonAvatar,
  IonRow,
  IonCol,
  IonPage,
  IonHeader,
  IonToolbar,
  IonContent,
  IonText,
  IonBadge,
  IonIcon
} from '@ionic/vue';
import VerifyCardComponent from "@/components/verifyCardComponent.vue";
import GetStartedComponent from "@/components/getStartedComponent.vue";

export default defineComponent({
  name: 'Tab1Page',
  components: {
    GetStartedComponent,
    VerifyCardComponent,
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
      warningOutline
    }
  }

});

</script>
<style scoped>
ion-badge {
  position: absolute;
  left: -12px;
}
</style>

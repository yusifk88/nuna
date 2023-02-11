<template>
  <ion-app>
    <error-component></error-component>
    <ion-spinner style="font-size: 200px !important; margin: auto !important;" name="dots" color="primary"
                 v-if="$store.state.initApp"></ion-spinner>
    <ion-router-outlet v-else/>

    <!--    <loading-component v-if="!$store.state.initApp"></loading-component>-->
  </ion-app>
  <ion-modal :is-open="showStart">


    <ion-content>
      <ion-row>
        <ion-col size="10">
        </ion-col>
        <ion-col size="2">

        </ion-col>

      </ion-row>
      <ion-row>
        <ion-col size="12" class="ion-text-center">

          <img height="40" src="https://objectstorage.uk-london-1.oraclecloud.com/n/lrj6a9vl4is6/b/MyBucket/o/logo.png">
        </ion-col>


      </ion-row>

      <ion-slides ref="startSlide" class="no-padding swiper" style="height: 76vh; margin-top: 80px">

        <ion-slide class="ion-text-center">

<span>
 <lottie-animation
     :width="350"
     :height="350"
     class="ion-margin"
     path="welcome.json"></lottie-animation>

      <h1 class="font-weight-bold ion-margin">Lose the barriers in gifting</h1>
      <p class="text-muted ion-margin">
        Super charge your milestones in life, let your friends send you gifts from across the globe.
        There are no limits!
      </p>


              <ion-button @click="goToNext" class="ion-margin" expand="block" size="large">Continue<ion-icon
                  :icon="arrowForwardOutline"></ion-icon></ion-button>

  </span>

        </ion-slide>

        <ion-slide>
         <span>
 <lottie-animation
     :width="350"
     :height="350"
     class="ion-margin"
     path="people.json"></lottie-animation>

      <h1 class="font-weight-bold ion-margin">Know your guests ahead of time!</h1>
      <p class="text-muted ion-margin">
       Plan better by easily building a guest list ahead of time, get a personalised page
        where your friends can indicate that they would be attending.
      </p>

              <ion-button @click="goToNext" class="ion-margin" expand="block" size="large">Continue<ion-icon
                  :icon="arrowForwardOutline"></ion-icon></ion-button>

  </span>


        </ion-slide>

        <ion-slide>
                <span>
 <lottie-animation
     :width="350"
     :height="350"
     class="ion-margin"
     path="signup.json"></lottie-animation>

      <h1 class="font-weight-bold ion-margin">Get Started</h1>
      <p class="text-muted ion-margin">
        Get started by creating your Nuna Account
      </p>

              <ion-button @click="exitDialog" class="ion-margin" expand="block" size="large">Create Account</ion-button>

  </span>


        </ion-slide>

      </ion-slides>
    </ion-content>
  </ion-modal>

</template>

<script>

import {
  IonApp,
  IonRouterOutlet,
  IonSpinner,
  IonModal,
  IonContent,
  IonSlides,
  IonSlide,
  IonRow,
  IonCol,
  IonButton,
  IonIcon
} from '@ionic/vue';
import LottieAnimation from "lottie-vuejs/src/LottieAnimation.vue";

import {defineComponent} from 'vue';
import ErrorComponent from "@/components/errorComponent.vue";
import {arrowForwardOutline} from "ionicons/icons";
import store from "@/store";

export default defineComponent({
  name: 'App',
  components: {
    LottieAnimation,
    IonIcon,
    ErrorComponent,
    IonApp,
    IonRouterOutlet,
    IonSpinner,
    IonModal,
    IonContent,
    IonSlides, IonSlide, IonRow, IonCol, IonButton
  },
  data() {
    return {
      arrowForwardOutline,
      store
    }
  },
  computed: {
    showStart() {

      return store.state.showStart;

    }
  },
  methods: {
    exitDialog(){
      this.store.state.showStart=false;
      localStorage.setItem("showstart","true");
    },
    goToNext() {
      const swiper = document.querySelector('.swiper').swiper;

// Now you can use all slider methods like
      swiper.slideNext();

    }
  }
});
</script>

<style>

ion-card {
  box-shadow: none !important;
}

ion-toolbar {
  --border-color: transparent;
  --border-width: 0;
}

ion-badge {
  position: absolute;
  left: -12px;
}

.text-muted {
  color: grey;
}

ion-header {
  box-shadow: none !important;

}

ion-button {
  box-shadow: none !important;


}

.font-weight-bold {
  font-weight: bolder !important;
}

ion-toolbar {
  box-shadow: none !important;
}

ion-button {
  box-shadow: none !important;
}

</style>
<template>
  <ion-app>
    <error-component></error-component>
    <ion-spinner style="font-size: 200px !important; margin: auto !important;" name="dots" color="primary"
                 v-if="$store.state.initApp"></ion-spinner>

    <ion-router-outlet v-else-if="store.state.networkConnected"/>

    <ion-content class="ion-padding ion-text-center" v-else>

      <img style="height: 100px; width: 100px; margin-top: 10%" class="ion-margin" src="/assets/icon/network.png">

      <h1>No Internet</h1>
      <p class="text-muted ion-padding">It looks like you are not connected to the internet, please check your connection and try again.</p>
      <ion-button @click="retry" size="large" expand="block" mode="ios" class="ion-margin" >Retry</ion-button>

    </ion-content>

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


              <ion-button mode="ios" @click="goToNext" class="ion-margin" expand="block" size="large">Continue<ion-icon
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

              <ion-button mode="ios"  @click="goToNext" class="ion-margin" expand="block" size="large">Continue<ion-icon
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

        <ion-button mode="ios"  @click="exitDialog" class="ion-margin" expand="block" size="large">Create Account</ion-button>

  </span>


        </ion-slide>

      </ion-slides>
    </ion-content>
  </ion-modal>

</template>

<script>

import { Network } from '@capacitor/network';

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
import router from "@/router";

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
    retry(){
      store.commit("initUser");

    },
    exitDialog(){
      this.store.state.showStart=false;

      router.push("/register");

      localStorage.setItem("showstart","true");
    },
    goToNext() {
      const swiper = document.querySelector('.swiper').swiper;

// Now you can use all slider methods like
      swiper.slideNext();

    }
  },
  mounted() {

    Network.addListener('networkStatusChange', status => {

      store.state.networkConnected = status.connected;


    });

  }
});
</script>

<style>

@keyframes slide-in {
  0% {
    opacity: 0;
    transform: translateX(250px);
  }

  100% {
    opacity: 1;
    transform: translateX(0);
  }
}

.font-weight-light {
  font-weight: lighter;
}


.smooth-in {
  animation: slide-in 0.3s ease-in-out 0s 1 normal forwards;
}

.ui-pattern{
  width: 100%;
  height: 15vh;
  background-color: rgba(0, 128, 128, 0.99);
  border-bottom-left-radius: 50%;
  position: absolute;
  top: 0;
  right: 0;
  background-image: url("/public/assets/cardBG.png");
  background-repeat: no-repeat;
  background-size: cover;
  transition: 0.3s ease-in-out;

}


ion-textarea.custom {
  --background: #D3D3D328;
  padding: 5px!important;
  border-radius: 10px;
  --placeholder-color: #80808090;
  --placeholder-opacity: .8;

  --padding-bottom: 10px;
  --padding-end: 10px;
  --padding-start: 10px;
  --padding-top: 10px;
}

.nuna-select-item{
  --background: #D3D3D328;
  border-radius: 10px;
  --placeholder-color: #80808090;
  --placeholder-opacity: .8;
}


ion-input.custom {

  --background: #D3D3D328;
  padding: 5px!important;
  padding-left: 20px !important;
  padding-right: 20px !important;
  border-radius: 10px;
  --placeholder-color: #80808090;
  --placeholder-opacity: .8;

  --padding-bottom: 10px;
  --padding-end: 10px;
  --padding-start: 10px;
  --padding-top: 10px;
}


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
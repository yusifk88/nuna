<template>
  <div class="tipComponent" v-if="CAN_SHOW_BAR">

    <ion-card class="no-margin tip-card">
      <ion-item detail lines="none" color="light" @click="isOpen=true">
        <div slot="start">
          <lottie-animation
              style="width: 3em"
              class="ion-margin"
              :loop="false"
              path="assets/share_animation.json">
          </lottie-animation>
        </div>

        <ion-label>
          <h2>Share Nuna with your friends</h2>
          <p>Easily share Nuna with friends and family with an events coming up</p>
        </ion-label>
      </ion-item>
    </ion-card>


    <ion-modal @didDismiss="saveState()" :is-open="isOpen" :keep-contents-mounted="true">

      <ion-card-content class="tip-bg">
        <ion-row style="margin-top: 10%">
          <ion-col size="9">

          </ion-col>
          <ion-col size="3">
            <ion-button color="warning" class="ion-margin-top" mode="ios" fill="outline" shape="round"
                        @click="closeDialog()">
              <ion-icon color="red" :icon="closeOutline"></ion-icon>
            </ion-button>
          </ion-col>
        </ion-row>


        <ion-row>
          <ion-col size="12">
            <ion-text color="white">
              <h1 class="ion-text-center">Share Nuna with your friends</h1>
              <h3 class="ion-text-center">Share Nuna with friends and family with events coming up</h3>
            </ion-text>
          </ion-col>
        </ion-row>

        <ion-row>
          <ion-col size="12">
            <center>

              <img src="/assets/share.png" height="500">
            </center>

          </ion-col>
        </ion-row>


        <ion-row>
          <ion-col size="12">
            <ion-text color="white">
              <h3 class="ion-text-center">Visit your profile to share Nuna with your friends</h3>
            </ion-text>
            <share-button-compoent></share-button-compoent>
          </ion-col>
        </ion-row>

      </ion-card-content>
    </ion-modal>


  </div>
</template>

<script>
import LottieAnimation from "lottie-vuejs/src/LottieAnimation.vue";
import {
  IonButton,
  IonCard,
  IonCardContent,
  IonCol,
  IonIcon,
  IonItem,
  IonLabel,
  IonModal,
  IonRow,
  IonText
} from "@ionic/vue";
import {closeOutline, sendOutline} from "ionicons/icons";
import {defineComponent} from 'vue'
import ShareButtonCompoent from "@/components/ShareButtonCompoent.vue";

export default defineComponent({
  name: "TipsComponent",

  components: {
    ShareButtonCompoent,
    IonIcon,
    IonCard,
    IonItem,
    IonLabel,
    LottieAnimation,
    IonModal,
    IonCardContent,
    IonRow,
    IonCol,
    IonButton,
    IonText
  },
  data() {
    return {
      sendOutline,
      closeOutline,
      isOpen: false,
      showBar: true
    }
  },
  methods: {
    closeDialog() {
      this.isOpen = false;


    },
    saveState() {
      this.showBar = false;
      localStorage.setItem("seenShareTip", true);

    }
  },
  computed: {
    CAN_SHOW_BAR() {

      const rem = localStorage.getItem("seenShareTip");

      return !rem && this.showBar;

    }
  }
})
</script>


<style scoped>

.gift-icon {
  padding: 10px;
  border-radius: 20%;
  background-color: #2DD36F4A;
  margin: 5px;
  margin-left: 0 !important;
  color: #2dd36f;

}

.tip-card {
  box-shadow: 0px -1px 39px -1px rgba(0, 0, 0, 0.25) !important;
  -webkit-box-shadow: 0px -1px 39px -1px rgba(0, 0, 0, 0.25);
  -moz-box-shadow: 0px -1px 39px -1px rgba(0, 0, 0, 0.25);
}

.tip-bg {
  background-image: url("/public/assets/cardBG.png") !important;
  background-color: #008080 !important;
  height: 100%;

}

.tipComponent {

  position: fixed;
  bottom: 1.3rem;
  width: 90%;
  transition: 0.3s ease-in-out;

}
</style>
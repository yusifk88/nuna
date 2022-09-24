<template>

  <ion-card v-if="showVerifyCard" class="no-margin" mode="ios" color="primary">

    <ion-card-content class="ion-justify-content-evenly ion-text-center">
      <img height="80"
           src="https://objectstorage.uk-london-1.oraclecloud.com/n/lrj6a9vl4is6/b/MyBucket/o/verify.svg">
    </ion-card-content>

    <ion-card-header>
      <ion-card-title>
        Verify your account
      </ion-card-title>
      <p>
        You would need to verify your account to continue
      </p>
    </ion-card-header>
    <ion-card-content>
      <ion-row>
        <ion-col size="6">
          <ion-button @click="verifyLater" color="primary"  shape="round">Later
            <ion-icon :icon="closeOutline"></ion-icon>
          </ion-button>
        </ion-col>

          <ion-col size="6">
          <ion-button color="primary" shape="round">Verify Now
            <ion-icon :icon="arrowForwardOutline"></ion-icon>
          </ion-button>
        </ion-col>

      </ion-row>


    </ion-card-content>

  </ion-card>

</template>

<script>
import {arrowForwardOutline,closeOutline} from "ionicons/icons";
import {
  IonIcon,
  IonCardHeader,
  IonCardTitle,
  IonCard,
  IonCardContent,
  IonButton,
    IonRow,
    IonCol
} from "@ionic/vue";

export default {
  name: "verifyCardComponent",
  components: {
    IonButton,
    IonCardContent,
    IonCard,
    IonIcon,
    IonCardHeader,
    IonCardTitle,
    IonRow,
    IonCol
  },
  data() {
    return {
      arrowForwardOutline,
      closeOutline,
      showCard:true
    }
  },
  computed:{
    showVerifyCard(){

      return this.showCard && !localStorage.getItem("showVerifyCard");

    }
  },
  methods:{
    verifyLater(){

      this.showCard=false;
      localStorage.setItem("showVerifyCard",'true');

    }
  }
}
</script>

<style scoped>

</style>
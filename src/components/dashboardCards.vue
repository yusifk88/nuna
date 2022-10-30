<template>
<span>
 <ion-slides class="no-padding no-margin">
   <ion-slide class="no-margin no-padding" v-for="wedding in weddings" :key="wedding.id">
     <ion-card mode="ios" color="tertiary" class="no-margin ion-text-left" style="width: 100%; height: 200px">
 <ion-card-header>
   <ion-row>
    <ion-col size="9" class="no-padding">

    <ion-card-title>Wedding</ion-card-title>
    <ion-card-subtitle>{{ wedding.groom_name }} & {{ wedding.bride_name }}</ion-card-subtitle>
    </ion-col>

     <ion-col col="3">

       <qrcode-vue
           render-as="svg"
           size="55"
           :value="getURL(wedding)"
           level="L"
       ></qrcode-vue>

     </ion-col>
   </ion-row>

  </ion-card-header>
       <ion-card-content>

         <p class="ion-margin-bottom ion-padding-bottom">{{ wedding.date_time }}</p>

<ion-row>
  <ion-col size="8">
        <small class="ion-margin-top ion-padding-top">Target/Contributed</small>
         <h3 class="font-weight-bold">GHS{{
             Number(wedding.items_sum_target_amount).toFixed("2")
           }}/GHS{{ Number(wedding.items_sum_amount_contributed).toFixed("2") }}</h3>
  </ion-col>
  <ion-col size="4">
            <img height="80"
                 src="https://objectstorage.uk-london-1.oraclecloud.com/n/lrj6a9vl4is6/b/MyBucket/o/wedding.svg">

  </ion-col>
</ion-row>
         

       </ion-card-content>
     </ion-card>
   </ion-slide>
 </ion-slides>
</span>
</template>

<script>

import QrcodeVue from 'qrcode.vue'

import {
  IonCard,
  IonCardContent,
  IonCardHeader,
  IonCardSubtitle,
  IonCardTitle,
  IonCol,
  IonRow,
  IonSlide,
  IonSlides,
} from "@ionic/vue";

import {cloudOfflineOutline, eyeOutline, globeOutline} from "ionicons/icons";

export default {
  props: {
    weddings: {
      type: Object
    }
  },
  components: {
    QrcodeVue,
    IonSlides,
    IonSlide,
    IonCard,
    IonCardContent,
    IonCardHeader,
    IonCardTitle,
    IonCardSubtitle,
    IonRow,
    IonCol,
  },
  name: "dashboardCards",

  methods: {

    getURL(wedding) {

      return "https://mynuuna.com/w/" + wedding.tag;


    }
  },
  data() {
    return {
      eyeOutline,
      globeOutline,
      cloudOfflineOutline
    }
  }
}
</script>

<style scoped>

</style>
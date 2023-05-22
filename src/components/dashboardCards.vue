<template>
<span>
 <swiper class="no-padding no-margin">
   <swiper-slide v-for="wedding in weddings" :key="wedding.id" class="no-margin no-padding">
     <ion-card
         class="no-margin ion-text-left"
         color="primary"
         mode="ios"
         style="width: 100%; height: 200px;"
         @click="$router.push({path:'/event/wedding/'+wedding.id})"
     >
 <ion-card-header>
   <ion-row>
    <ion-col class="no-padding" size="9">

    <ion-card-title>Wedding</ion-card-title>
    <ion-card-subtitle>{{ wedding.groom_name }} & {{ wedding.bride_name }}</ion-card-subtitle>
      <small>On {{ dateFormat(wedding.date_time) }}</small>
    </ion-col>

     <ion-col col="3">

       <div style="background-color: white; text-align: center; padding-top: 8px; padding-bottom: 5px; border-radius: 10px; border: 0.5px solid lightgrey">

       <qrcode-vue
           :value="getURL(wedding)"
           level="M"
           render-as="svg"
           size="55"

       ></qrcode-vue>

                </div>

     </ion-col>
   </ion-row>

  </ion-card-header>
       <ion-card-content>

         <p class="ion-margin-bottom ion-padding-bottom"></p>

<ion-row>
  <ion-col size="8">
        <small class="ion-margin-top ion-padding-top font-weight-light">Contributed/Target</small>
         <h3 class="font-weight-light">{{ user.currency }}{{ Number(wedding.contributions_sum_amount).toFixed("2") }} / {{ user.currency }}{{
             Number(wedding.items_sum_target_amount).toFixed("2")
           }}</h3>
  </ion-col>
  <ion-col size="4">

    <img style="filter: drop-shadow(0 0 0.75rem rgba(255,210,0,0.69));" height="80" src="https://objectstorage.uk-london-1.oraclecloud.com/n/lrj6a9vl4is6/b/MyBucket/o/wedding.svg">

  </ion-col>
</ion-row>
         

       </ion-card-content>
     </ion-card>
   </swiper-slide>
 </swiper>
</span>
</template>

<script>

import QrcodeVue from 'qrcode.vue'
import { Swiper, SwiperSlide } from 'swiper/vue';
import 'swiper/css';
import {
  IonCard,
  IonCardContent,
  IonCardHeader,
  IonCardSubtitle,
  IonCardTitle,
  IonCol,
  IonRow
} from "@ionic/vue";

import {cloudOfflineOutline, eyeOutline, globeOutline} from "ionicons/icons";
import moment from "moment";

export default {
  props: {
    weddings: {
      type: Object
    }
  },
  components: {
    QrcodeVue,
    Swiper, SwiperSlide,
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
    dateFormat(date) {

      return moment(date).format("Do MMM, YYYY h:mm a");

    },

    getURL(wedding) {

      return "https://mynuuna.com/w/" + wedding.tag;


    }
  },
  computed: {
    user() {
      return this.$store.state.user;
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
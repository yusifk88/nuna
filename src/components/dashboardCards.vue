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

       {{wedding.view}} <ion-icon :icon="eyeOutline"></ion-icon> | <ion-icon v-if="wedding.public" :icon="globeOutline"></ion-icon> <ion-icon v-else :icon="cloudOfflineOutline"></ion-icon>

     </ion-col>
   </ion-row>

  </ion-card-header>
       <ion-card-content>

         <p class="ion-margin-bottom ion-padding-bottom">{{ wedding.date_time }}</p>


         <small class="ion-margin-top ion-padding-top">Target/Contributed</small>
         <h3 class="font-weight-bold">GHS{{ Number(wedding.items_sum_target_amount).toFixed("2") }}/GHS{{ Number(wedding.items_sum_amount_contributed).toFixed("2") }}</h3>
       </ion-card-content>
     </ion-card>
   </ion-slide>
 </ion-slides>
</span>
</template>

<script>
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
    IonIcon,
} from "@ionic/vue";

import {eyeOutline,globeOutline,cloudOfflineOutline} from "ionicons/icons";
export default {
  props: {
    weddings: {
      type: Object
    }
  },
  components: {
    IonSlides,
    IonSlide,
    IonCard,
    IonCardContent,
    IonCardHeader,
    IonCardTitle,
    IonCardSubtitle,
    IonRow,
    IonCol,
    IonIcon
  },
  name: "dashboardCards",
  data(){
    return{
      eyeOutline,
      globeOutline,
      cloudOfflineOutline
    }
  }
}
</script>

<style scoped>

</style>
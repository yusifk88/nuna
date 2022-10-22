<template>
<ion-row>
  <ion-col size="6" class="no-padding">
    <ion-card router-link="/new/wedding" mode="ios" class="no-margin" color="tertiary">
      <ion-card-content class="ion-text-center">
        <img height="80" src="https://objectstorage.uk-london-1.oraclecloud.com/n/lrj6a9vl4is6/b/MyBucket/o/wedding.svg">
      </ion-card-content>
      <ion-card-header>
        <ion-card-subtitle>
         <ion-icon :icon="addCircleOutline"></ion-icon> wedding Registry
        </ion-card-subtitle>
      </ion-card-header>
      <ion-card-content>
        <p>
          Make a registry for your wedding.
        </p>
      </ion-card-content>
    </ion-card>

  </ion-col>


    <ion-col size="6" class="no-padding">
    <ion-card color="danger" mode="ios" class="no-margin ion-margin-top">
      <ion-card-content class="ion-text-center">
        <img height="80" src="https://objectstorage.uk-london-1.oraclecloud.com/n/lrj6a9vl4is6/b/MyBucket/o/undraw_heartbroken_cble.svg">
      </ion-card-content>
      <ion-card-header>
        <ion-card-subtitle>
          <ion-icon :icon="addCircleOutline"></ion-icon> Funeral Registry
        </ion-card-subtitle>
      </ion-card-header>
      <ion-card-content>
        <p>
          Make a Registry for a funeral
        </p>

      </ion-card-content>
    </ion-card>
  </ion-col>





</ion-row>
</template>

<script>
import {addCircleOutline} from "ionicons/icons";
import {IonRow,IonCol,IonCard,IonCardContent,IonCardHeader,IonCardSubtitle,IonIcon} from "@ionic/vue";

export default {
  name: "getStartedComponent",
  components:{IonRow,IonCol,IonCard,IonCardContent,IonCardHeader,IonCardSubtitle,IonIcon},
  data(){
    return{
      addCircleOutline

    }
  }
}
</script>

<style>
.no-padding{
  padding: 0!important;
}
.no-margin{
  margin: 2px!important;
}

</style>
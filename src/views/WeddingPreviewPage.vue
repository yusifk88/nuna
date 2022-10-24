<template>
  <ion-page>
    <ion-header>
      <ion-toolbar>
        <ion-back-button slot="start"></ion-back-button>
        <ion-title>
          {{wedding ? wedding.tag : "Wedding tag..."}}
        </ion-title>
      </ion-toolbar>
    </ion-header>
    <ion-content>
      {{$route.params.id}}
      <vcl-facebook></vcl-facebook>
      <vcl-instagram></vcl-instagram>

    </ion-content>


  </ion-page>
</template>

<script>
import {IonPage, IonHeader, IonToolbar,IonBackButton,IonTitle,IonContent} from "@ionic/vue";
import { VclFacebook, VclInstagram } from 'vue-content-loading';
export default {
  name: "WeddingPreviewPage",
  components:{VclFacebook, VclInstagram,IonPage,IonHeader,IonToolbar,IonBackButton,IonTitle,IonContent},
  data(){
    return{
      wedding:null
    }
  }
}
</script>

<style scoped>

</style>
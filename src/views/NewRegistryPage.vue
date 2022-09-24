<template>
  <ion-page >
    <ion-header >
      <ion-toolbar>
        <ion-back-button slot="start"></ion-back-button>
<ion-title>
  {{$route.params.type}} registry
</ion-title>

      </ion-toolbar>
    </ion-header>
    <wedding-registry-component v-if="$route.params.type==='wedding'"></wedding-registry-component>
  </ion-page>

</template>

<script>
import {IonPage, IonHeader, IonToolbar,IonBackButton,IonTitle} from "@ionic/vue";
import WeddingRegistryComponent from "@/components/weddingRegistryComponent";

export default {
  name: "NewRegistryPage",
  components: {WeddingRegistryComponent, IonPage, IonHeader, IonToolbar,IonBackButton,IonTitle}
}
</script>

<style scoped>

</style>
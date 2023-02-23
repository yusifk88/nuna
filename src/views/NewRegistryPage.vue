<template>
  <ion-page>
    <ion-header class="ion-no-border" style="box-shadow: none !important;" v-if="!$store.state.headerTransparent">
      <ion-toolbar>
        <ion-back-button slot="start"></ion-back-button>
        <ion-title>
          {{ $route.params.type }} registry
        </ion-title>

      </ion-toolbar>
    </ion-header>
    <wedding-registry-component v-if="$route.params.type==='wedding'"></wedding-registry-component>
  </ion-page>

</template>

<script>
import {IonBackButton, IonHeader, IonPage, IonTitle, IonToolbar} from "@ionic/vue";
import WeddingRegistryComponent from "@/components/weddingRegistryComponent";

export default {
  name: "NewRegistryPage",
  components: {WeddingRegistryComponent, IonPage, IonHeader, IonToolbar, IonBackButton, IonTitle}
}
</script>

<style scoped>

ion-header {
  box-shadow: none !important;

}

ion-toolbar {
  box-shadow: none !important;
  border: none !important;
  --border-width: 0;
  --box-shadow: none;
}

</style>
<template>
  <ion-app>
    <error-component></error-component>
    <ion-spinner style="font-size: 200px !important; margin: auto !important;" name="dots" color="primary" v-if="$store.state.initApp"></ion-spinner>
    <ion-router-outlet v-else/>

    <loading-component></loading-component>
  </ion-app>
</template>

<script lang="ts">

import { IonApp, IonRouterOutlet,IonSpinner } from '@ionic/vue';
import { defineComponent } from 'vue';
import ErrorComponent from "@/components/errorComponent.vue";
import LoadingComponent from "@/components/loadingComponent.vue";


export default defineComponent({
  name: 'App',
  components: {
    LoadingComponent,
    ErrorComponent,
    IonApp,
    IonRouterOutlet,
    IonSpinner
  }
});
</script>

<style>

ion-header{
  box-shadow: none !important;

}

ion-toolbar{
  box-shadow: none !important;
}

ion-button{
  box-shadow: none !important;
}

</style>
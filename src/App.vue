<template>
  <ion-app>
    <error-component></error-component>
    <ion-spinner style="font-size: 200px !important; margin: auto !important;" name="dots" color="primary" v-if="$store.state.initApp"></ion-spinner>

    <ion-router-outlet v-else/>
  </ion-app>
</template>

<script lang="ts">
import { IonApp, IonRouterOutlet,IonSpinner } from '@ionic/vue';
import { defineComponent } from 'vue';
import ErrorComponent from "@/components/errorComponent.vue";

export default defineComponent({
  name: 'App',
  components: {
    ErrorComponent,
    IonApp,
    IonRouterOutlet,
    IonSpinner
  }
});
</script>
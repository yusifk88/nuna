<template>
  <ion-app>
    <error-component></error-component>
    <ion-spinner style="font-size: 200px !important; margin: auto !important;" name="dots" color="primary" v-if="$store.state.initApp"></ion-spinner>
    <ion-router-outlet v-else/>

<!--    <loading-component v-if="!$store.state.initApp"></loading-component>-->
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

<style>

ion-card{
  box-shadow: none !important;
}

ion-toolbar{
  --border-color:transparent;
  --border-width:0;
}

ion-badge {
  position: absolute;
  left: -12px;
}

.text-muted{
 color: grey;
}
ion-header{
  box-shadow: none !important;

}

ion-button{
  box-shadow: none !important;


}
.font-weight-bold {
  font-weight: bolder !important;
}

ion-toolbar{
  box-shadow: none !important;
}

ion-button{
  box-shadow: none !important;
}

</style>
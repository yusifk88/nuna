<template xmlns:ion-card-content="http://www.w3.org/1999/html">
  <ion-modal
      @onDidDismiss="()=>$store.state.mainLoading=false"
      :isOpen="$store.state.mainLoading"
      :canDismiss="$store.state.mainLoading"
      :keep-contents-mounted="true"
      id="loading-modal" ref="modal" >

<div class="ion-padding ion-text-center">

    <lottie-animation
        :width="250"
        :height="200"
        path="wait.json"></lottie-animation>
    <h3>{{$store.state.mainLoadingText}}</h3>
  <p v-if="$store.state.mainLoadingDescription">{{$store.state.mainLoadingDescription}}</p>

</div>

  </ion-modal>

</template>

<script>
import {IonModal,} from "@ionic/vue";
import LottieAnimation from "lottie-vuejs/src/LottieAnimation.vue";

export default {
  components:{IonModal,LottieAnimation},
  name: "loadingComponent"
}
</script>

<style scoped>

ion-modal#loading-modal {
  --width: fit-content;
  --min-width: 250px;
  --height: fit-content;
  --border-radius: 6px;
  --box-shadow: 0 28px 48px rgba(0, 0, 0, 0.4);
}
ion-card{
  box-shadow: none !important;
}

</style>
<template>

  <div class="ion-padding">

    <div class="ion-color-primary">

  <lottie-animation
      :width="250"
      :height="200"
      path="no_record.json"
  >
  </lottie-animation>

    </div>

  <center>
    <h5>{{title}}</h5>
    <ion-text class="text-muted">{{description}}</ion-text>
    <ion-button
        @click="$emit('buttonTapped')"
        class="ion-margin-top"
        color="primary"
        expand="block"
        shape="round"
        v-if="showButton"
        size="large"
    >
      {{buttonText}}
      <ion-icon v-if="showIcon" :icon="buttonIcon"></ion-icon>
    </ion-button>
  </center>
  </div>

</template>

<script>
import LottieAnimation from "lottie-vuejs/src/LottieAnimation.vue";
import {IonButton,IonText,IonIcon} from "@ionic/vue";
import {arrowForwardOutline} from "ionicons/icons";

export default {
  props: {
    showButton:{
      default:true,
      type:Boolean
    },
    title:{
      default:"No record found",
      type:String
    },
    description:{
      default:"We do not have any record under this category",
      type:String
    },
    showIcon:{
      default:false,
      type:Boolean
    },
    buttonIcon:{
      default:arrowForwardOutline,
      type:String

    },
    buttonText:{
      default:"Create your first record",
      type:String
    }
  },
  name: "NoRecordComponent",
  components: {LottieAnimation,IonButton,IonText,IonIcon},
  data(){
    return{
      arrowForwardOutline
    }
  }
}
</script>

<style scoped>

</style>
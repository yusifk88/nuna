<template>
  <ion-header>
    <ion-toolbar>
      <ion-title>Get help for love story</ion-title>
    </ion-toolbar>
  </ion-header>
  <ion-content class="ion-padding-bottom" style="transition: 0.5s ease-in-out !important;">


    <div class="ion-padding ion-margin ion-text-center" v-if="!answers.length">
      <lottie-animation
          :width="250"
          :height="200"
          path="assets/robot.json"
      >
      </lottie-animation>

      <h3>Hello {{ user.first_name }},</h3>
      I am here to help by suggesting beautiful love stories for your wedding page encase you run out of ideas, please
      tap on the ask button.
    </div>

    <P class="ion-margin" v-if="answers.length"><small style="font-style: italic">I hope this is helpful, if you do not like
      this suggestion feel free to ask me again and i would try to come up with a new one. Congratulations on
      wedding!</small></P>


    <swiper
        :navigation="answers.length>1"
        style="transition: 0.5s ease-in-out" :pager="true" v-if="answers.length && !loading">

      <swiper-slide style="transition: 0.5s ease-in-out" v-for="(answer,i) in answers" :key="i">
        <ion-card  color="light">
          <ion-card-content>
            <strong>Suggestion - {{i+1}}:</strong>
            <span style="font-style: italic" v-html="answer.text">
        </span>

            <br>
            <ion-button size="large" @click="$emit('selected',answer.text)" class="ion-margin-top" fill="outline">Select</ion-button>
          </ion-card-content>
        </ion-card>

      </swiper-slide>

    </swiper>


    <!--    <div class="ion-padding ion-margin" style="border: 1px solid lightgrey; border-radius: 20px; transition: 0.4s ease-in-out"  >-->
    <!--    </div>-->

    <ion-button :disabled="loading" @click="getStory" expand="block">Ask AI
      {{ answers.length ? "Again" : "" }} {{ loading ? "(Thinking...)" : "" }}
    </ion-button>
  </ion-content>
</template>

<script>
import { Navigation } from 'swiper';
import LottieAnimation from "lottie-vuejs/src/LottieAnimation.vue";

import { Swiper, SwiperSlide } from 'swiper/vue';
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';
import 'swiper/css/scrollbar';
import {IonButton, IonContent, IonHeader, IonTitle, IonToolbar, IonCard, IonCardContent} from "@ionic/vue";
import axios from "axios";

export default {
  name: "loveAiComponent",
  components: {
    IonHeader,
    IonContent,
    IonToolbar,
    IonTitle,
    IonButton,
    // eslint-disable-next-line vue/no-unused-components
    Navigation,
    IonCard, IonCardContent,Swiper, SwiperSlide,
    LottieAnimation
  },
  computed: {
    user() {
      return this.$store.state.user;
    }
  },
  data() {
    return {
      answers: [],
      loading: false,
      modules: [Navigation],

    }
  },
  methods: {
    getStory() {

      this.loading = true;
      axios.get("get-love-story")
          .then(res => {

            this.answers.push({text:res.data.data.text});
            this.loading = false;

          })
    }
  }
}
</script>

<style scoped>

</style>
<template>
  <ion-page ref="mainPage">
    <ion-header>
      <ion-toolbar>
        <ion-back-button slot="start"></ion-back-button>
        <ion-title>
          {{ wedding ? wedding.tag : "Wedding tag..." }}
        </ion-title>
      </ion-toolbar>
      <ion-toolbar>
        <ion-segment :scrollable="true" color="primary" :value="defaultSegment">

          <ion-segment-button @click="defaultSegment='items'" value="items">
            Contributions
          </ion-segment-button>

          <ion-segment-button @click="defaultSegment='guest'" value="guest">
            Guest
          </ion-segment-button>

          <ion-segment-button @click="defaultSegment='info'" value="info">
            Event Info.
          </ion-segment-button>


        </ion-segment>
      </ion-toolbar>
    </ion-header>
    <ion-content :fullscreen="true" class="ion-padding" v-if="wedding">


      <ion-content style="transition: 0.3s ease-in-out;" class="no-padding" v-if="defaultSegment==='items'">

<!--        <wish-list-component v-if="wedding" :wedding-i-d="wedding.id"></wish-list-component>-->

            <cash-target-component v-if="wedding" :wedding-i-d="wedding.id" ></cash-target-component>

      </ion-content>


      <ion-content style="transition: 0.3s ease-in-out;" class="no-padding" v-if="defaultSegment==='info'">
        <ion-slides :pager="true" :option="previewSlideOption">
          <ion-slide>

            <div :style="'background-image:url('+imgURL+')'"
                 style="margin:5px; height: 300px; width: 100%; background-repeat: no-repeat; background-size: cover; border-radius: 3%;">
              <div
                  style="width: 100%;height: 100%; padding: 10px; background-color: rgba(0,0,0,0.38); color: white;  border-radius: 3%; text-align: center;">
                <h3 style="font-family: cursive;" class="ion-margin-top">Our Story</h3>
                <small class="ion-margin-top" style="display: block;">{{ wedding.story }}</small>
                <ion-icon class="ion-margin-top" style="margin-right: -10px" :icon="heartOutline"
                          size="large"></ion-icon>
                <ion-icon class="ion-margin-top" style="margin-left: -10px" :icon="heartOutline"
                          size="large"></ion-icon>
                <h3 style="font-family: cursive;" class="ion-margin-top">{{ wedding.tag }}</h3>
              </div>
            </div>
          </ion-slide>

          <ion-slide v-if="wedding.photo_one">

            <div :style="'background-image:url('+$store.state.baseURL+wedding.photo_one+')'"
                 style="margin:5px;height: 300px; width: 100%; background-repeat: no-repeat; background-size: cover; border-radius: 3%;">
            </div>

          </ion-slide>

          <ion-slide v-if="wedding.photo_two">

            <div :style="'background-image:url('+$store.state.baseURL+wedding.photo_two+')'"
                 style="margin:5px;height: 300px; width: 100%; background-repeat: no-repeat; background-size: cover; border-radius: 3%;">
            </div>

          </ion-slide>


          <ion-slide v-if="wedding.photo_three">

            <div :style="'background-image:url('+$store.state.baseURL+wedding.photo_three+')'"
                 style="margin:5px;height: 300px; width: 100%; background-repeat: no-repeat; background-size: cover; border-radius: 3%;">
            </div>

          </ion-slide>
          <ion-slide v-if="wedding.photo_four">

            <div :style="'background-image:url('+$store.state.baseURL+wedding.photo_four+')'"
                 style="margin:5px;height: 300px; width: 100%; background-repeat: no-repeat; background-size: cover; border-radius: 3%;">
            </div>

          </ion-slide>


        </ion-slides>

        <h2>Reservation</h2>

        <ion-row>
          <ion-col size="12" class="ion-text-center">

            <qrcode-vue
                render-as="svg"
                size="120"
                :value="getURL(wedding)"
                level="L"
                class="ion-margin"
            ></qrcode-vue>

          </ion-col>
        </ion-row>


        <div
            style=" background-image: url('/assets/rsvp_card.png'); height: 350px; width: 100%; background-repeat: no-repeat; background-size: cover; background-position: center; border-radius: 3%;">
          <div style="width: 100%;height: 100%; padding: 10px; text-align: center;">

            <h2 style="color: #3E7460; margin-top: 170px; font-size: 45px; font-weight: lighter; margin-bottom: 0 !important;"
                class="font-weight-light">{{ weddingNames }}</h2>
            <p style="color: black; margin-top: 0!important; margin-bottom: 0; letter-spacing: 0.1em;">
              {{ weddingDate }}</p>
            <p style="color: black; margin-top: 0!important; letter-spacing: 0.3em;">Tel:
              {{ wedding.rsv_phone_number }}</p>

          </div>
        </div>


        <h2>Location</h2>

        <p>{{ wedding.location }}</p>
        <maps-component class="no-margin" :place="position" v-if="wedding.coordinates"></maps-component>

      </ion-content>

    </ion-content>
  </ion-page>
</template>

<script>

import QrcodeVue from 'qrcode.vue'

import {
  IonBackButton,
  IonCol,
  IonContent,
  IonHeader,
  IonIcon,
  IonPage,
  IonRow,
  IonSegment,
  IonSegmentButton,
  IonSlide,
  IonSlides,
  IonTitle,
  IonToolbar
} from "@ionic/vue";
import {heartOutline} from "ionicons/icons";
import moment from "moment";

import axios from "axios";
import MapsComponent from "@/components/MapsComponent";
import CashTargetComponent from "@/components/CashTargetComponent";

export default {
  name: "WeddingPreviewPage",
  components: {
    CashTargetComponent,
    QrcodeVue,
    MapsComponent,
    IonSegment,
    IonSegmentButton,
    IonSlide,
    IonSlides,
    IonPage,
    IonHeader,
    IonToolbar,
    IonBackButton,
    IonTitle,
    IonContent,
    IonIcon,
    IonRow,
    IonCol
  },
  data() {
    return {
      defaultSegment: "items",
      wedding: null,
      heartOutline,
      previewSlideOption: {
        spaceBetween: 10,
        slidesPerView: 1,
        initialSlide: 0,
        speed: 400,
        effect: "cards",
        autoplay: {
          delay: 5000,
        }

      },
    }
  },
  computed: {

    position() {

      if (this.wedding && this.wedding.coordinates) {

        const codsArr = this.wedding.coordinates.split(",");

        return {
          lat: Number(codsArr[1]),
          lng: Number(codsArr[0])
        }

      }

      return null;

    },
    weddingDate() {

      if (this.wedding) {


        return moment(this.wedding.date).format("dddd, Do MMMM Y h:mm a");

      }

      return "";
    },
    weddingNames() {

      if (this.wedding) {

        const groomNameSplit = this.wedding.groom_name.split(" ");
        const brideNameSplit = this.wedding.bride_name.split(" ");
        return groomNameSplit[0] + " & " + brideNameSplit[0];
      }

      return "";


    },
    imgURL() {
      if (this.wedding) {
        if (this.wedding.photo_one) {

          return this.$store.state.baseURL + this.wedding.photo_one;

        } else if (this.wedding.photo_two) {

          return this.$store.state.baseURL + this.wedding.photo_two;

        } else if (this.wedding.photo_three) {

          return this.$store.state.baseURL + this.wedding.photo_three;

        } else if (this.wedding.photo_four) {

          return this.$store.state.baseURL + this.wedding.photo_four;

        } else {

          return "https://ionicframework.com/docs/img/demos/avatar.svg";

        }


      }
      return "https://ionicframework.com/docs/img/demos/avatar.svg";


    }
  },
  methods: {

    getURL(wedding) {

      return "https://mynuuna.com/w/" + wedding.tag;


    },
    getWedding() {
      this.$store.state.mainLoadingText = "Hung on...";
      this.$store.state.mainLoadingDescription = "We are getting your wedding...";
      this.$store.state.mainLoading = true;

      axios.get("/weddings/" + this.$route.params.id)
          .then(res => {
            this.wedding = res.data.data;
            this.$store.state.mainLoading = false;
          })

    }
  },
  mounted() {
    this.getWedding();

  }
}
</script>

<style scoped>

</style>
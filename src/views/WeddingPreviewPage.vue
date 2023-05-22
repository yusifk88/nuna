<template>
  <ion-page ref="mainPage">
    <ion-header class="ion-no-border">
      <ion-toolbar>
        <ion-back-button slot="start"></ion-back-button>
        <ion-title>
          {{ wedding ? wedding.tag : "Wedding tag..." }}
        </ion-title>
        <ion-buttons slot="end">
          <ion-button :disabled="!wedding" mode="ios" size="large" @click="shareLink(getURL(wedding))">
            <ion-icon :icon="shareOutline"></ion-icon>
            Share
          </ion-button>
        </ion-buttons>
      </ion-toolbar>
      <ion-toolbar>
        <ion-segment :scrollable="true" :value="defaultSegment" color="primary">

          <ion-segment-button value="items" @click="defaultSegment='items'">
            Gifts
          </ion-segment-button>

          <ion-segment-button value="guest" @click="defaultSegment='guest'">
            Guests
          </ion-segment-button>

          <ion-segment-button value="info" @click="defaultSegment='info'">
            Event Info.
          </ion-segment-button>


        </ion-segment>
      </ion-toolbar>
    </ion-header>
    <ion-content v-if="wedding" :fullscreen="true" class="ion-padding">


      <span v-if="defaultSegment==='items'" class="no-padding" style="transition: 0.3s ease-in-out;">

            <cash-target-component :wedding="wedding" :wedding-i-d="wedding.id"
                                   @cashAdded="getWedding"></cash-target-component>

      </span>

      <span v-if="defaultSegment==='guest'" class="no-padding" style="transition: 0.3s ease-in-out;">

          <guest-list :wedding-i-d="wedding.id"></guest-list>

      </span>


      <span v-if="defaultSegment==='info'" class="no-padding" style="transition: 0.3s ease-in-out;">
        <swiper :option="previewSlideOption" :pager="true">
          <swiper-slide>

            <div :style="'background-image:url('+imgURL+')'"
                 style="margin:5px; height: 300px; width: 100%; background-position: center; background-repeat: no-repeat; background-size: cover; border-radius: 3%;">
              <div
                  style="width: 100%;height: 100%; padding: 10px; background-color: rgba(0,0,0,0.38); color: white;  border-radius: 3%; text-align: center;">
                <h3 class="ion-margin-top" style="font-family: cursive;">Our Story</h3>
                <small v-if="wedding && wedding.story" class="ion-margin-top" style="display: block;"
                       v-html="wedding.story.substring(0,150)+'...'"></small>

                <ion-icon :icon="heartOutline" class="ion-margin-top" size="large"
                          style="margin-right: -10px"></ion-icon>
                <ion-icon :icon="heartOutline" class="ion-margin-top" size="large"
                          style="margin-left: -10px"></ion-icon>
                <h3 class="ion-margin-top" style="font-family: cursive;">{{ wedding.tag }}</h3>
              </div>
            </div>
          </swiper-slide>

          <swiper-slide v-if="wedding.photo_one">

            <div :style="'background-image:url('+wedding.photo_one+')'"
                 style="margin:5px;height: 300px; width: 100%; background-repeat: no-repeat; background-size: cover; border-radius: 3%;">
            </div>

          </swiper-slide>

          <swiper-slide v-if="wedding.photo_two">

            <div :style="'background-image:url('+wedding.photo_two+')'"
                 style="margin:5px;height: 300px; width: 100%; background-repeat: no-repeat; background-size: cover; border-radius: 3%;">
            </div>

          </swiper-slide>


          <swiper-slide v-if="wedding.photo_three">

            <div :style="'background-image:url('+wedding.photo_three+')'"
                 style="margin:5px;height: 300px; width: 100%; background-repeat: no-repeat; background-size: cover; border-radius: 3%;">
            </div>

          </swiper-slide>
          <swiper-slide v-if="wedding.photo_four">

            <div :style="'background-image:url('+wedding.photo_four+')'"
                 style="margin:5px;height: 300px; width: 100%; background-repeat: no-repeat; background-size: cover; border-radius: 3%;">
            </div>

          </swiper-slide>


        </swiper>

        <h4>Reservation</h4>

        <ion-card class="no-margin" color="light" style="height: 280px">
          <ion-card-content class="ion-text-center" style="text-align: center !important; padding: 40px">

            <center>

               <qrcode-vue
                   :value="getURL(wedding)"
                   class="ion-margin ion-margin-top"
                   level="L"
                   render-as="svg"
               ></qrcode-vue>
<p>
            <a :href="getURL(wedding)">Preview</a>

</p>
            </center>

          </ion-card-content>
        </ion-card>



        <div
            style=" background-image: url('/assets/rsvp_card.png'); height: 300px; width: 100%; margin-top: 15px; background-repeat: no-repeat; background-size: cover; background-position: center; border-radius: 3%;">
          <div style="width: 100%;height: 100%; padding: 10px; text-align: center;">

            <h2 class="font-weight-light"
                style="color: #3E7460; margin-top: 170px; font-size: 45px; font-weight: lighter; margin-bottom: 0 !important;">{{
                weddingNames
              }}</h2>
            <p style="color: black; margin-top: 0!important; margin-bottom: 0; letter-spacing: 0.1em;">
              {{ weddingDate }}</p>
            <p style="color: black; margin-top: 0!important; letter-spacing: 0.3em;">RSVP:
              {{ wedding.rsv_phone_number }}</p>

          </div>
        </div>


        <h4>Location</h4>

        <p>{{ wedding.location }}</p>
        <maps-component v-if="wedding.coordinates" :place="position" class="no-margin"></maps-component>

      </span>

    </ion-content>
  </ion-page>
</template>

<script>

import QrcodeVue from 'qrcode.vue'
import {Share} from '@capacitor/share';
import {Swiper, SwiperSlide} from 'swiper/vue';


import {
  IonBackButton,
  IonContent,
  IonHeader,
  IonIcon,
  IonPage,
  IonSegment,
  IonSegmentButton,

  IonTitle,
  IonToolbar,
  IonButtons,
  IonButton,
  IonCard,
  IonCardContent
} from "@ionic/vue";
import {heartOutline, shareOutline} from "ionicons/icons";
import moment from "moment";

import axios from "axios";
import MapsComponent from "@/components/MapsComponent";
import CashTargetComponent from "@/components/CashTargetComponent";
import GuestList from "@/components/GuestList";

export default {
  name: "WeddingPreviewPage",
  components: {
    IonCard,
    IonCardContent,
    GuestList,
    CashTargetComponent,
    QrcodeVue,
    MapsComponent,
    IonSegment,
    IonSegmentButton,
    Swiper, SwiperSlide,
    IonPage,
    IonHeader,
    IonToolbar,
    IonBackButton,
    IonTitle,
    IonContent,
    IonIcon,

    IonButtons,
    IonButton
  },
  data() {
    return {
      defaultSegment: "items",
      wedding: null,
      heartOutline,
      shareOutline,
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

    weddingURL() {

      return this.store.state.baseURL + "/w/" + this.wedding.tag;
    },
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


        return moment(this.wedding.date_time).format("dddd, Do MMMM Y h:mm a");

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

          return this.wedding.photo_one;

        } else if (this.wedding.photo_two) {

          return this.wedding.photo_two;

        } else if (this.wedding.photo_three) {

          return this.wedding.photo_three;

        } else if (this.wedding.photo_four) {

          return this.wedding.photo_four;

        } else {

          return "https://ionicframework.com/docs/img/demos/avatar.svg";

        }


      }
      return "https://ionicframework.com/docs/img/demos/avatar.svg";


    }
  },
  methods: {

    async shareLink(link) {

      await Share.share({
        title: this.wedding.tag,
        text: this.wedding.groom_name + " and " + this.wedding.bride_name + "'s wedding",
        url: link,
        dialogTitle: 'Share you wedding link',
      });

    },
    getURL(wedding) {

      return this.$store.state.baseURL + "/w/" + wedding.tag;

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
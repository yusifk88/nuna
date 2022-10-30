<template>
  <ion-content :class="step<=5 ? 'ion-padding' : 'no-padding'" :fullscreen="true">


  <span v-if="step==1" class="ion-text-center content-span">

    <h1 style="font-family: cursive; font-weight: bolder">Congratulations On your wedding <br> {{
        $store.state.user.first_name
      }}</h1>

    <img class="ion-margin-bottom" width="200"
         src="https://objectstorage.uk-london-1.oraclecloud.com/n/lrj6a9vl4is6/b/MyBucket/o/love.svg"
         alt="wedding illustration">
   <ion-button
       size="large"
       expand="block"
       shape="round"
       class="ion-margin-top"
       @click="start"
       style="z-index: 999999 !important;"
   >Create your registry<ion-icon :icon="arrowForwardOutline"></ion-icon></ion-button>
  </span>

    <weddin-welcom-animation v-if="step===1"></weddin-welcom-animation>


    <div class="ion-text-center smooth-in" v-if="step===2">
      <h1>Hello {{ $store.state.user.first_name }},</h1>
      <h2 class="font-weight-light">Are you the groom or the bride?</h2>

      <!--      <alert-component-->

      <!--          title="What does this mean?"-->
      <!--          description=" Depending on your choice, we would assume you are the the bride or groom<br>-->
      <!--      eg. If you say you are the bride then the only person we need to register is the groom and vise versa."-->
      <!--      ></alert-component>-->


      <ion-button style="transition: 0.1s ease-in-out" @click="groosatusSeleted=true; userIsGroom=false; setUser()"
                  class="ion-margin-top"
                  expand="block"
                  size="large"
                  shape="round" fill="outline"
      >
        <ion-icon :icon="checkmarkOutline" v-if="groosatusSeleted && !userIsGroom"></ion-icon>
        I am the bride
        <ion-icon :icon="femaleOutline"></ion-icon>

      </ion-button>

      <ion-button style="transition: 0.1s ease-in-out" @click="groosatusSeleted=true; userIsGroom=true; setUser()"
                  class="ion-margin-top" expand="block"
                  size="large"
                  shape="round" fill="outline">
        <ion-icon :icon="checkmarkOutline" v-if="groosatusSeleted && userIsGroom"></ion-icon>

        I am the groom

        <ion-icon :icon="maleOutline"></ion-icon>

      </ion-button>

    </div>


    <div class="smooth-in" v-if="step==3">

      <center>
        <ion-avatar>
          <img :src="avatarUrl">
        </ion-avatar>
      </center>

      <h4 class="ion-text-center ion-margin-top">{{ userIsGroom ? "Bride " : "Groom " }} information</h4>


      <ion-list class="ion-margin-top" v-if="userIsGroom">

        <ion-item fill="outline" shape="round">
          <ion-input :autofocus="true" v-model="bride_name" type="text" placeholder="Bride's full Name*"></ion-input>
        </ion-item>

        <ion-item class="ion-margin-top" fill="outline" shape="round">
          <ion-input inputmode="tel" v-model="bride_phone_number"
                     placeholder="Bride's phone number(optional)"></ion-input>
        </ion-item>

        <ion-item class="ion-margin-top" fill="outline" shape="round">
          <ion-input inputmode="email" v-model="bride_email"
                     placeholder="Bride's email address(optional)"></ion-input>
        </ion-item>

      </ion-list>


      <ion-list class="ion-margin-top" v-else>

        <ion-item fill="outline" shape="round">
          <ion-input :autofocus="true" v-model="groom_name" type="text" placeholder="Groom's full Name*"></ion-input>
        </ion-item>

        <ion-item class="ion-margin-top" fill="outline" shape="round">
          <ion-input inputmode="tel" v-model="groom_phone_number"
                     placeholder="Groom's phone number(optional)"></ion-input>
        </ion-item>

        <ion-item class="ion-margin-top" fill="outline" shape="round">
          <ion-input inputmode="email" v-model="groom_email"
                     placeholder="Groom's email address(optional)"></ion-input>
        </ion-item>

      </ion-list>


    </div>


    <div class="smooth-in" v-if="step==4">

      <p class="ion-text-center ion-no-margin">
        <span style="font-size: 70px">🎊</span>

      </p>

      <h2 class="ion-text-center ion-no-margin">All about the big day!</h2>

      <!--      <alert-component class="ion-margin-top" title="What's a tag?"-->
      <!--                       description="A tag is a unique text that identifies your wedding registry link. If you do not create one, a random tag would be created for you."></alert-component>-->

      <ion-list class="ion-margin-top">

        <ion-item class="ion-margin-top" fill="outline" shape="round">
          <ion-input v-model="tag" type="text" placeholder="Wedding #tag (optional)"></ion-input>
        </ion-item>

        <ion-item shape="round" class="ion-margin-top" fill="outline">
          <ion-label>Date & Time:</ion-label>
          <ion-datetime-button datetime="datetime"></ion-datetime-button>
          <ion-modal

              :keep-contents-mounted="true">
            <ion-datetime @ionChange="dateSelected" :show-default-buttons="true" hourCycle="h12" locale="en-GB"
                          id="datetime">
              <span slot="title">Set the wedding date & tIme</span>
            </ion-datetime>
          </ion-modal>

        </ion-item>

        <ion-item fill="outline" shape="round" class="ion-margin-top">
          <ion-input v-model="rsvPhoneNumber" inputmode="tel" rows="1" :autoGrow="true"
                     placeholder="RSVP Tel number*"></ion-input>
        </ion-item>

        <ion-item fill="outline" shape="round" class="ion-margin-top">
          <ion-input v-model="rsvPerson" rows="1" placeholder="RSVP contact person name*"></ion-input>
        </ion-item>

        <ion-item fill="outline" shape="round" class="ion-margin-top">
          <ion-textarea v-model="location" rows="1" :autoGrow="true"
                        placeholder="Describe the location (optional)"></ion-textarea>
        </ion-item>


      </ion-list>

      <div v-if="googlePlace" class="place-container ion-padding ion-text-center">

        <ion-icon color="primary" :icon="locationOutline" size="large"></ion-icon>
        <h3>{{ googlePlace.route }}</h3>
        <p>
          <small class="text-muted">{{ googlePlace.administrative_area_level_1 }}
            {{ googlePlace.administrative_area_level_2 }}, {{ googlePlace.country }}</small>
        </p>

        <ion-button
            shape="round"
            size="small"
            fill="outline"
            @click="googlePlace=null"
        >
          <ion-icon :icon="pencilOutline"></ion-icon>
        </ion-button>


      </div>

      <ion-button
          expand="block"
          shape="round"
          id="open-map"
          fill="clear"
          size="large"
          v-if="!googlePlace"

      >Attach map location
        <ion-icon :icon="locationOutline"></ion-icon>
      </ion-button>

      <ion-modal
          v-if="!googlePlace"
          :initial-breakpoint="0.5"
          :breakpoints="[0, 0.25, 0.5, 0.75,1]"
          handle-behavior="cycle"
          mode="ios" ref="modal" trigger="open-map"
      >
        <google-places-component
            @placeSelected="setPlace"
            @canceled="cacnelSearch"
        ></google-places-component>
      </ion-modal>

      <ion-button
          expand="block"
          shape="round"
          fill="clear"
          @click="showSocial=!showSocial"
          size="large"

      >Add video links
        <ion-icon v-if="!showSocial" :icon="caretDownOutline"></ion-icon>
        <ion-icon v-else :icon="caretUpOutline"></ion-icon>
      </ion-button>

      <ion-item v-if="showSocial" fill="outline" shape="round" class="ion-margin-top">
        <ion-input v-model="zoomLink" inputmode="url" rows="1" placeholder="Zoom link"></ion-input>
      </ion-item>

      <ion-item v-if="showSocial" fill="outline" shape="round" class="ion-margin-top">
        <ion-input v-model="youtubeLink" inputmode="url" rows="1" placeholder="YouTube link"></ion-input>
      </ion-item>


    </div>

    <div class="smooth-in" v-if="step===5">

      <h2 class="ion-text-center">Let's style things up</h2>

      <p>Add upto 4 photos to your wedding page:</p>
      <ion-grid>

        <ion-row>
          <ion-col size="6">
            <thumbnail-component @photoSelected="file=>photoOne=file" uuid="img1"></thumbnail-component>
          </ion-col>

          <ion-col size="6">
            <thumbnail-component @photoSelected="file=>photoTwo=file" uuid="img2"></thumbnail-component>
          </ion-col>


          <ion-col size="6">
            <thumbnail-component @photoSelected="file=>photoThree=file" uuid="img3"></thumbnail-component>
          </ion-col>


          <ion-col size="6">
            <thumbnail-component @photoSelected="file=>photoFour=file" uuid="img4"></thumbnail-component>
          </ion-col>


        </ion-row>
      </ion-grid>

      <p>Share something nice about your union:</p>

      <ion-item shape="round" fill="outline" class="ion-margin-top">
        <ion-textarea v-model="story" rows="1" :autoGrow="true" placeholder="A short beautiful story"></ion-textarea>
      </ion-item>

      <p>How do you want to say thank you?</p>
      <ion-radio-group :value="thankYouvalue">

        <ion-slides :options="slideOption" :scrollbar="true">


          <ion-slide v-for="(page,index) in sampleThanks" :key="index">
            <ion-card @click="thankYouvalue=index; thankYouText=page.text.trim()" color="primary" class="ion-text-left"
                      mode="ios">
              <ion-item color="primary">
                <ion-radio color="warning" :value="index"></ion-radio>
                <ion-label>Select</ion-label>

              </ion-item>
              <ion-card-header>
                <ion-card-title>{{ page.title }}


                </ion-card-title>
              </ion-card-header>
              <ion-card-content class="ion-text-left">

                <p>{{ page.text }}</p>
                <ion-card-subtitle>
                  {{ page.subTitle }}<br>
                  {{ groom_name }} & {{ bride_name }}
                </ion-card-subtitle>
              </ion-card-content>

            </ion-card>
          </ion-slide>

        </ion-slides>

      </ion-radio-group>


      <ion-item shape="round" fill="outline" class="ion-margin-top">

        <ion-textarea
            v-model="thankYouText"
            rows="1"
            :autoGrow="true"
            placeholder="Edit thank you message"
        ></ion-textarea>

      </ion-item>

    </div>

    <div style="height: 100vh" class="smooth-in ion-color-primary" v-if="step===6">

      <ion-slides :pager="true" :options="previewSlideOption">


        <ion-slide v-if="photoOne">

          <ion-card style="width: 100%; height: 300px;margin: 0!important;" mode="ios" class="card-gradient no-margin">
            <ion-card-header class="ion-margin-top ion-padding-top">
              <ion-card-title style="color: white!important;">Our Story
                <ion-icon :icon="heartCircleOutline"></ion-icon>

              </ion-card-title>

            </ion-card-header>

            <ion-card-content>

              {{ story }}
            </ion-card-content>

          </ion-card>


        </ion-slide>


        <ion-slide v-if="photoOne">
          <div :style="'background-image:url('+photoOne.preview+')'"
               style="height: 300px; width: 100%; background-repeat: no-repeat; background-size: cover; border-radius: 3%;">
          </div>

        </ion-slide>

        <ion-slide v-if="photoTwo">
          <div :style="'background-image:url('+photoTwo.preview+')'"
               style="height: 300px; width: 100%; background-repeat: no-repeat; background-size: cover; border-radius: 3%;">
          </div>

        </ion-slide>

        <ion-slide v-if="photoThree">

          <div :style="'background-image:url('+photoThree.preview+')'"
               style="height: 300px; width: 100%; background-repeat: no-repeat; background-size: cover; border-radius: 3%;">
          </div>

        </ion-slide>

        <ion-slide v-if="photoFour">
          <div :style="'background-image:url('+photoFour.preview+')'"
               style="height: 300px; width: 100%; background-repeat: no-repeat; background-size: cover; border-radius: 3%;">
          </div>

        </ion-slide>

      </ion-slides>


      <ion-list :inset="true" lines="inset">
        <ion-list-header>
          <ion-label>
            <ion-icon :icon="personOutline"></ion-icon>
            Bride's Info.
          </ion-label>
        </ion-list-header>
        <ion-item>
          <ion-label><h1>{{ bride_name ? bride_name : "N/A" }}</h1>
            <p>Name</p>
          </ion-label>
        </ion-item>
        <ion-item>
          <ion-label><h1>{{ bride_phone_number ? bride_phone_number : "N/A" }}</h1>
            <p>Phone Number</p>
          </ion-label>
        </ion-item>
        <ion-item>
          <ion-label><h1>{{ bride_email ? bride_email : "N/A" }}</h1>
            <p>Email</p>
          </ion-label>
        </ion-item>


        <ion-list-header>
          <ion-label>
            <ion-icon :icon="personOutline"></ion-icon>
            Groom's Info.
          </ion-label>
        </ion-list-header>
        <ion-item>
          <ion-label><h1>{{ groom_name ? groom_name : "N/A" }}</h1>
            <p>Name</p>
          </ion-label>
        </ion-item>
        <ion-item>
          <ion-label><h1>{{ groom_phone_number ? groom_phone_number : "N/A" }}</h1>
            <p>Phone Number</p>
          </ion-label>
        </ion-item>
        <ion-item>
          <ion-label><h1>{{ groom_email ? groom_email : "N/A" }}</h1>
            <p>Email</p>
          </ion-label>
        </ion-item>


        <ion-list-header>
          <ion-label>
            <ion-icon :icon="informationOutline"></ion-icon>
            About the wedding
          </ion-label>
        </ion-list-header>

        <ion-item>
          <ion-label>
            <h1>{{ tag ? tag : "N/A" }}</h1>
            <p>
              Wedding Tag
            </p>
          </ion-label>
        </ion-item>
        <ion-item>
          <ion-label><h1>{{ date ? date : "N/A" }}</h1>
            <p>Date & Time</p>
          </ion-label>
        </ion-item>
        <ion-item>
          <ion-label><h1>{{ rsvPhoneNumber ? rsvPhoneNumber : "N/A" }}</h1>
            <p>RSV Tel.</p>
          </ion-label>
        </ion-item>

        <ion-item>
          <ion-label>
            <h1>{{ rsvPerson ? rsvPerson : "N/A" }}</h1>
            <p>RSV Person</p>

          </ion-label>
        </ion-item>


        <ion-list-header v-if="youtubeLink&&zoomLink">
          <ion-label>
            <ion-icon :icon="linkOutline"></ion-icon>
            Links
          </ion-label>
        </ion-list-header>


        <ion-item v-if="youtubeLink">
          <ion-button size="large" :href="youtubeLink" color="danger" fill="clear" expand="block">
            <ion-icon :icon="logoYoutube"></ion-icon>
            YouTube
          </ion-button>
        </ion-item>

        <ion-item v-if="zoomLink">
          <ion-button size="large" :href="zoomLink" color="primary" fill="clear" expand="block">Zoom</ion-button>
        </ion-item>

      </ion-list>


    </div>


  </ion-content>


  <ion-footer :translucent="true" collapse="fade" v-if="step>2">
    <ion-progress-bar buffer=".8" class="ion-margin-top" :value="progressvalue"></ion-progress-bar>

    <ion-toolbar>
      <ion-button slot="start" fill="clear" @click="step--">
        <ion-icon :icon="caretBackOutline"></ion-icon>
        Prev.
      </ion-button>

      <ion-button v-if="step<6" @click="gotoNext(step)" slot="end" shape="round" size="large">

        {{ step === 5 ? "Preview" : "Continue" }}

        <ion-icon v-if="step<=5" :icon="caretForwardOutline"></ion-icon>

      </ion-button>

      <ion-button @click="saveEvent" slot="end" shape="round" v-else color="success" size="large">
        Create event
        <ion-icon :icon="checkmarkOutline"></ion-icon>
      </ion-button>
    </ion-toolbar>
  </ion-footer>
</template>

<script>


import {
  IonAvatar,
  IonButton,
  IonCard,
  IonCardContent,
  IonCardHeader,
  IonCardSubtitle,
  IonCardTitle,
  IonCol,
  IonContent,
  IonDatetime,
  IonDatetimeButton,
  IonFooter,
  IonGrid,
  IonIcon,
  IonInput,
  IonItem,
  IonLabel,
  IonList,
  IonListHeader,
  IonModal,
  IonProgressBar,
  IonRadio,
  IonRadioGroup,
  IonRow,
  IonSlide,
  IonSlides,
  IonTextarea,
  IonToolbar
} from "@ionic/vue";
import WeddinWelcomAnimation from "@/components/weddinWelcomAnimation";
import {
  arrowForwardOutline,
  caretBackOutline,
  caretDownOutline,
  caretForwardOutline,
  caretUpOutline,
  checkmarkCircle,
  checkmarkOutline,
  femaleOutline,
  heartCircleOutline,
  informationOutline,
  linkOutline,
  locationOutline,
  logoYoutube,
  maleOutline,
  pencilOutline,
  personOutline
} from "ionicons/icons";
import ThumbnailComponent from "@/components/thumbnailComponent";
import GooglePlacesComponent from "@/components/GooglePlacesComponent";
import axios from "axios";

export default {
  name: "weddingRegistryComponent",
  components: {
    IonListHeader,
    IonProgressBar,
    GooglePlacesComponent,
    IonAvatar,
    ThumbnailComponent,
    WeddinWelcomAnimation,
    IonContent,
    IonButton,
    IonIcon,
    IonList,
    IonItem,
    IonInput,
    IonToolbar,
    IonFooter,
    IonLabel,
    IonTextarea,
    IonDatetimeButton,
    IonModal,
    IonDatetime,
    IonRow,
    IonCol,
    IonGrid,
    IonSlides,
    IonSlide,
    IonCard,
    IonCardHeader,
    IonCardTitle,
    IonCardContent,
    IonCardSubtitle,
    IonRadioGroup,
    IonRadio
  },
  data() {
    return {
      heartCircleOutline,
      pencilOutline,
      story: "",
      linkOutline,
      logoYoutube,
      informationOutline,
      personOutline,
      youtubeLink: "",
      zoomLink: "",
      photoOne: null,
      photoTwo: null,
      photoThree: null,
      photoFour: null,
      rsvPhoneNumber: "",
      rsvPerson: "",
      location: "",
      showSocial: false,
      caretUpOutline,
      caretDownOutline,
      thankYouText: "",
      showMore: false,
      dialogCanDismiss: false,
      slideOption: {
        initialSlide: 0,
        speed: 400,
        effect: "overflow"
      },
      previewSlideOption: {
        slidesPerView: 1,
        cycle: true,
        initialSlide: 0,
        speed: 400,
        effect: "overflow",
        autoplay: {
          delay: 5000,
        }

      },
      thankYouvalue: 0,
      sampleThanks: [
        {
          title: "Dear [Name],",
          text: "We are so thankful to have your love and support towards our wedding day.\n" +
              "                We wouldn’t want it any other way. Thank you for playing a big part in making our big day a reality.\n" +
              "                We truly appreciate you.\n" +
              "                All our love,",
          subTitle: ""
        },
        {
          title: "Dear [Donor],",

          text: "This is a note to thank you for being there for us and supporting us.\n" +
              "                Your gift to us means more than you know. We are grateful to have family/friends\n" +
              "                like you who will do everything to celebrate our union.\n" +
              "                Thank you for reaching into your heart to share this gift with us.\n" +
              "                We love having you in our life.",
          subTitle: "Much love,"
        },
        {
          title: "Dear [Donor],",
          text: "Thank you for contributing to our wedding.\n" +
              "                Because of your generosity we will be able to celebrate our love with friends and family like you.",
          subTitle: "Thanks again,"

        },

      ],
      addMap: false,
      tag: "",
      arrowForwardOutline,
      maleOutline,
      femaleOutline,
      step: 1,
      userIsGroom: false,
      groosatusSeleted: false,
      checkmarkOutline,
      caretBackOutline,
      caretForwardOutline,
      checkmarkCircle,
      locationOutline,
      groom_name: null,
      groom_phone_number: "",
      groom_email: "",
      bride_name: null,
      bride_phone_number: "",
      bride_email: "",
      date: "",
      dateTime: "",
      maxStep: 5,
      googlePlace: null
    }
  },
  watch: {
    step() {

      this.$store.state.headerTransparent = this.step >= 6;

    }
  },
  computed: {

    goeLocation() {
      if (this.googlePlace) {
        return this.googlePlace.longitude + "," + this.googlePlace.latitude;
      }

      return null;

    },
    progressvalue() {

      return (this.step / this.maxStep).toFixed(2);

    },
    user() {
      return this.$store.state.user;
    },
    avatarUrl() {
      return this.userIsGroom ? "https://objectstorage.uk-london-1.oraclecloud.com/n/lrj6a9vl4is6/b/MyBucket/o/person1.png" : "https://objectstorage.uk-london-1.oraclecloud.com/n/lrj6a9vl4is6/b/MyBucket/o/avatar-2191918.png";

    }
  },
  methods: {

    setPlace(place) {
      this.googlePlace = place;
      console.log(place);

    },

    saveEvent() {

      this.$store.state.mainLoadingText = "Hung on...";
      this.$store.state.mainLoadingDescription = "We are saving your event...";
      this.$store.state.mainLoading = true;


      const formData = new FormData();

      formData.append("bride_name", this.bride_name);
      formData.append("bride_phone_number", this.bride_phone_number);
      formData.append("bride_email", this.bride_email);
      formData.append("groom_name", this.groom_name);
      formData.append("groom_phone_number", this.groom_phone_number);
      formData.append("groom_email", this.groom_email);
      formData.append("tag", this.tag);
      formData.append("date_time", this.date);
      formData.append("youtube_link", this.youtubeLink);
      formData.append("zoom_link", this.zoomLink);
      formData.append("location", this.location);
      formData.append("coordinates", this.goeLocation);
      formData.append("story", this.story);
      formData.append("rsv_phone_number", this.rsvPhoneNumber);
      formData.append("rsv_person", this.rsvPerson);
      formData.append("photo_one", this.photoOne ? this.photoOne.file : null);
      formData.append("photo_two", this.photoTwo ? this.photoTwo.file : null);
      formData.append("photo_three", this.photoThree ? this.photoThree.file : null);


      axios.post("/wedding", formData)
          .then(res => {

            this.$store.state.mainLoading = false;
            const url = "/event/wedding/" + res.data.data.id;
            this.$router.push({path: url});

          })
          .catch(error => {

            this.$store.state.mainLoading = false;


          })


    },


    dateSelected(dateTime) {
      this.date = dateTime.detail.value;
    },
    gotoNext(index) {

      if (index === 3) {
        if (this.userIsGroom && !this.bride_name) {

          this.$store.state.ErrorPosition = "top";
          this.$store.state.errorsArr = {name: ["You said you are the groom, Bride's name is required"]};
          this.$store.state.showErrorToast = true;
          return;

        } else if (!this.userIsGroom && !this.groom_name) {
          this.$store.state.ErrorPosition = "top";

          this.$store.state.errorsArr = {name: ["You said you are the bride, Groom's name is required"]};
          this.$store.state.showErrorToast = true;
          return;

        }


      }


      if (index === 4) {

        if (!this.rsvPhoneNumber) {
          this.$store.state.ErrorPosition = "top";

          this.$store.state.errorsArr = {name: ["RSVP Phone number is required"]};
          this.$store.state.showErrorToast = true;

          return;
        }


        if (!this.rsvPerson) {
          this.$store.state.ErrorPosition = "top";

          this.$store.state.errorsArr = {name: ["RSVP person name is required"]};
          this.$store.state.showErrorToast = true;

          return;


        }
      }

      this.step = index + 1;

    },
    cacnelSearch() {
      this.dialogCanDismiss = true;

      this.$refs.modal.$el.dismiss(null, 'cancel');

      this.dialogCanDismiss = false;

    },
    setUser() {
      if (this.userIsGroom) {

        this.groom_name = this.user.first_name + " " + this.user.last_name;
        this.groom_email = this.user.email;
        this.groom_phone_number = this.user.phone_number;
        this.bride_email = "";
        this.bride_phone_number = "";
        this.bride_name = "";

      } else {

        this.groom_name = "";
        this.bride_name = this.user.first_name + " " + this.user.last_name;
        this.bride_email = this.user.email;
        this.bride_phone_number = this.user.phone_number;

        this.groom_email = "";
        this.groom_phone_number = "";

      }
      this.step = 3;

    },
    start() {
      this.step = 2;
    }
  }

}
</script>


<style scoped>
.place-container {

  border: 1px solid #cccccc;
  border-radius: 1%;
}

.card-gradient {

  --background: rgb(131, 58, 180);
  background: linear-gradient(90deg, rgba(131, 58, 180, 1) 0%, rgba(253, 29, 29, 1) 50%, rgba(252, 176, 69, 1) 100%);
  color: #ffffff !important;
  box-shadow: none !important;
}

ion-thumbnail {
  --size: 100%;
  --border-radius: 14px;
}

@keyframes slide-in {
  0% {
    opacity: 0;
    transform: translateX(250px);
  }

  100% {
    opacity: 1;
    transform: translateX(0);
  }
}

.font-weight-light {
  font-weight: lighter;
}


.smooth-in {
  animation: slide-in 0.3s ease-in-out 0s 1 normal forwards;
}

.content-span {
  margin-top: 30%;
  position: absolute;
  width: 90%;
}
</style>
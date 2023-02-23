<template>
  <ion-content :class="step<=5 ? 'ion-padding' : 'no-padding'" :fullscreen="true">


  <span v-if="step==1" class="ion-text-center content-span">

    <h1 style="font-family: cursive; font-weight: bolder">Congratulations On your wedding <br> {{
        $store.state.user.first_name
      }}</h1>

    <img alt="wedding illustration" class="ion-margin-bottom"
         src="https://objectstorage.uk-london-1.oraclecloud.com/n/lrj6a9vl4is6/b/MyBucket/o/love.svg"
         width="200">
   <ion-button
       class="ion-margin-top"
       expand="block"
       shape="round"
       size="large"
       style="z-index: 999999 !important;"
       @click="start"
       mode="ios"
   >Create Registry<ion-icon :icon="arrowForwardOutline"></ion-icon></ion-button>
  </span>

    <weddin-welcom-animation v-if="step===1"></weddin-welcom-animation>


    <div v-if="step===2" class="ion-text-center smooth-in">
      <h1>Hello {{ $store.state.user.first_name }},</h1>
      <h2 class="font-weight-light">Are you the groom or the bride?</h2>

      <!--      <alert-component-->

      <!--          title="What does this mean?"-->
      <!--          description=" Depending on your choice, we would assume you are the the bride or groom<br>-->
      <!--      eg. If you say you are the bride then the only person we need to register is the groom and vise versa."-->
      <!--      ></alert-component>-->


      <ion-button class="ion-margin-top" expand="block"
                  fill="outline"
                  shape="round"
                  size="large"
                  mode="ios"
                  style="transition: 0.1s ease-in-out" @click="groosatusSeleted=true; userIsGroom=false; setUser()"
      >
        <ion-icon v-if="groosatusSeleted && !userIsGroom" :icon="checkmarkOutline"></ion-icon>
        I am the bride
        <ion-icon :icon="femaleOutline"></ion-icon>

      </ion-button>

      <ion-button class="ion-margin-top" expand="block"
                  fill="outline" shape="round"
                  size="large"
                  mode="ios"
                  style="transition: 0.1s ease-in-out" @click="groosatusSeleted=true; userIsGroom=true; setUser()">
        <ion-icon v-if="groosatusSeleted && userIsGroom" :icon="checkmarkOutline"></ion-icon>

        I am the groom

        <ion-icon :icon="maleOutline"></ion-icon>

      </ion-button>

    </div>


    <div v-if="step==3" class="smooth-in">

      <center>
        <ion-avatar>
          <img :src="avatarUrl">
        </ion-avatar>
      </center>

      <h4 class="ion-text-center ion-margin-top">{{ userIsGroom ? "Bride " : "Groom " }} information</h4>


      <ion-list v-if="userIsGroom" class="ion-margin-top">

        <ion-item lines="none">
          <ion-input v-model="bride_name" :autofocus="true" class="custom" placeholder="Bride's full Name*"
                     type="text"></ion-input>
        </ion-item>

        <ion-item class="ion-margin-top" lines="none">
          <ion-input v-model="bride_phone_number" class="custom" inputmode="tel"
                     placeholder="Bride's phone number(optional)"></ion-input>
        </ion-item>

        <ion-item class="ion-margin-top" lines="none">
          <ion-input v-model="bride_email" class="custom" inputmode="email" lines="none"
                     placeholder="Bride's email address(optional)"></ion-input>
        </ion-item>

      </ion-list>


      <ion-list v-else class="ion-margin-top">

        <ion-item lines="none">
          <ion-input v-model="groom_name" class="custom" placeholder="Groom's full Name*" type="text"></ion-input>
        </ion-item>

        <ion-item class="ion-margin-top" lines="none">
          <ion-input v-model="groom_phone_number" class="custom" inputmode="tel"
                     placeholder="Groom's phone number(optional)"></ion-input>
        </ion-item>

        <ion-item class="ion-margin-top" lines="none">
          <ion-input v-model="groom_email" class="custom" inputmode="email"
                     placeholder="Groom's email address(optional)"></ion-input>
        </ion-item>

      </ion-list>


    </div>


    <div v-if="step==4" class="smooth-in">

      <p class="ion-text-center ion-no-margin">
        <span style="font-size: 70px">🎊</span>

      </p>

      <h2 class="ion-text-center ion-no-margin">All about the big day!</h2>

      <!--      <alert-component class="ion-margin-top" title="What's a tag?"-->
      <!--                       description="A tag is a unique text that identifies your wedding registry link. If you do not create one, a random tag would be created for you."></alert-component>-->

      <ion-list class="ion-margin-top">

        <ion-item lines="none">
          <ion-input v-model="tag" class="custom" placeholder="Wedding #tag (optional)" type="text"></ion-input>
        </ion-item>

        <ion-item class="ion-margin-top" lines="none">
          <ion-label>Date & Time:</ion-label>
          <ion-datetime-button datetime="datetime"></ion-datetime-button>
          <ion-modal

              :keep-contents-mounted="true">
            <ion-datetime id="datetime" :show-default-buttons="true" hourCycle="h12" locale="en-GB"
                          @ionChange="dateSelected">
              <span slot="title">Set the wedding date & tIme</span>
            </ion-datetime>
          </ion-modal>

        </ion-item>

        <ion-item class="ion-margin-top" lines="none">
          <ion-input v-model="rsvPhoneNumber" :autoGrow="true" class="custom" inputmode="tel"
                     placeholder="RSVP Tel number*"></ion-input>
        </ion-item>

        <ion-item class="ion-margin-top" lines="none">
          <ion-input v-model="rsvPerson" class="custom" placeholder="RSVP contact person name*"></ion-input>
        </ion-item>

        <ion-item class="ion-margin-top" lines="none">
          <ion-textarea v-model="location" :autoGrow="true" class="custom" placeholder="Describe the location (optional)"
                        rows="1"></ion-textarea>
        </ion-item>


      </ion-list>

      <div v-if="googlePlace" class="place-container ion-padding ion-text-center">

        <ion-icon :icon="locationOutline" color="primary" size="large"></ion-icon>
        <h3>{{ googlePlace.route }}</h3>
        <p>
          <small class="text-muted">{{ googlePlace.administrative_area_level_1 }}
            {{ googlePlace.administrative_area_level_2 }}, {{ googlePlace.country }}</small>
        </p>

        <ion-button
            fill="outline"
            shape="round"
            size="small"
            @click="googlePlace=null"
            mode="ios"
        >
          <ion-icon :icon="pencilOutline"></ion-icon>
        </ion-button>


      </div>

      <ion-button
          v-if="!googlePlace"
          id="open-map"
          expand="block"
          fill="clear"
          shape="round"
          size="large"
          mode="ios"

      >Attach map location
        <ion-icon :icon="locationOutline"></ion-icon>
      </ion-button>

      <ion-modal
          v-if="!googlePlace"
          ref="modal"
          :breakpoints="[0, 0.25, 0.5, 0.75,1]"
          :initial-breakpoint="0.5"
          handle-behavior="cycle"
          mode="ios"
          trigger="open-map"
      >
        <google-places-component
            @canceled="cacnelSearch"
            @placeSelected="setPlace"
        ></google-places-component>
      </ion-modal>

      <ion-button
          expand="block"
          fill="clear"
          shape="round"
          size="large"
          @click="showSocial=!showSocial"
          mode="ios"

      >Add video links
        <ion-icon v-if="!showSocial" :icon="caretDownOutline"></ion-icon>
        <ion-icon v-else :icon="caretUpOutline"></ion-icon>
      </ion-button>

      <ion-item v-if="showSocial" class="ion-margin-top" lines="none">
        <ion-input v-model="zoomLink" class="custom" inputmode="url" placeholder="Zoom link"></ion-input>
      </ion-item>

      <ion-item v-if="showSocial" class="ion-margin-top" lines="none">
        <ion-input v-model="youtubeLink" class="custom" inputmode="url" placeholder="YouTube link"></ion-input>
      </ion-item>


    </div>

    <div v-if="step===5" class="smooth-in">

      <h2 class="ion-text-center">Let's style things up</h2>

      <p>Add upto 4 photos to your wedding page:</p>
      <ion-grid>

        <ion-row>
          <ion-col size="6">
            <thumbnail-component uuid="img1" @photoSelected="file=>photoOne=file"></thumbnail-component>
          </ion-col>

          <ion-col size="6">
            <thumbnail-component uuid="img2" @photoSelected="file=>photoTwo=file"></thumbnail-component>
          </ion-col>


          <ion-col size="6">
            <thumbnail-component uuid="img3" @photoSelected="file=>photoThree=file"></thumbnail-component>
          </ion-col>


          <ion-col size="6">
            <thumbnail-component uuid="img4" @photoSelected="file=>photoFour=file"></thumbnail-component>
          </ion-col>


        </ion-row>
      </ion-grid>

      <p>Share something nice about your union:</p>

      <ion-item class="ion-margin-top" lines="none">
        <ion-textarea v-model="story" :autoGrow="true" class="custom" placeholder="A short beautiful story"
                      rows="1"></ion-textarea>
      </ion-item>
      <ion-button id="ai-help-button" class="ion-margin" fill="clear">Seek suggestions</ion-button>

      <ion-modal
          ref="AImodal"
          :breakpoints="[0, 0.25, 0.5, 0.75,1]"
          :initial-breakpoint="0.75"
          handle-behavior="cycle"
          mode="ios"
          trigger="ai-help-button"
      >
        <love-ai-component @selected="suggestionSelected"></love-ai-component>
      </ion-modal>
      <p>How do you want to say thank you?</p>
      <ion-radio-group :value="thankYouvalue">

        <ion-slides :options="slideOption" :scrollbar="true">


          <ion-slide v-for="(page,index) in sampleThanks" :key="index">
            <ion-card class="ion-text-left" color="primary" mode="ios"
                      @click="thankYouvalue=index; thankYouText=page.text.trim()">
              <ion-item color="primary">
                <ion-radio :value="index" color="warning"></ion-radio>
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


      <ion-item class="ion-margin-top" lines="none">

        <ion-textarea
            v-model="thankYouText"
            :autoGrow="true"
            class="custom"
            placeholder="Edit thank you message"
            rows="1"
        ></ion-textarea>

      </ion-item>

    </div>

    <div v-if="step===6" class="smooth-in ion-color-primary" style="height: 100vh">

      <ion-slides :options="previewSlideOption" :pager="true">


        <ion-slide v-if="photoOne">

          <ion-card class="card-gradient no-margin" mode="ios" style="width: 100%; height: 300px;margin: 0!important;">
            <ion-card-header class="ion-margin-top ion-padding-top">
              <ion-card-title style="color: white!important;">Our Story
                <ion-icon :icon="heartCircleOutline"></ion-icon>

              </ion-card-title>

            </ion-card-header>

            <ion-card-content>

              <span v-html="story">

              </span>
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
          <ion-button mode="ios" :href="youtubeLink" color="danger" expand="block" fill="clear" size="large">
            <ion-icon :icon="logoYoutube"></ion-icon>
            YouTube
          </ion-button>
        </ion-item>

        <ion-item v-if="zoomLink">
          <ion-button mode="ios" :href="zoomLink" color="primary" expand="block" fill="clear" size="large">Zoom</ion-button>
        </ion-item>

      </ion-list>


    </div>


  </ion-content>


  <ion-footer v-if="step>2" :translucent="true" collapse="fade">
    <ion-progress-bar :value="progressvalue" buffer=".8" class="ion-margin-top"></ion-progress-bar>

    <ion-toolbar>
      <ion-button mode="ios" slot="start" fill="clear" @click="step--">
        <ion-icon :icon="caretBackOutline"></ion-icon>
        Prev.
      </ion-button>

      <ion-button mode="ios" v-if="step<6" slot="end" shape="round" size="large" @click="gotoNext(step)">

        {{ step === 5 ? "Preview" : "Continue" }}

        <ion-icon v-if="step<=5" :icon="caretForwardOutline"></ion-icon>

      </ion-button>

      <ion-button mode="ios" v-else slot="end" :disabled="loading" color="success" shape="round" size="large" @click="saveEvent">
        <template v-if="!loading">

          Create event
          <ion-icon :icon="checkmarkOutline"></ion-icon>
        </template>
        <ion-spinner v-else></ion-spinner>
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
  IonSpinner,
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
import LoveAiComponent from "@/components/loveAiComponent";

export default {
  name: "weddingRegistryComponent",
  components: {
    IonSpinner,
    LoveAiComponent,
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
      googlePlace: null,
      loading: false
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

    suggestionSelected(story) {

      this.story = story;
      this.$refs.AImodal.$el.dismiss(null, 'cancel');

    },

    setPlace(place) {
      this.googlePlace = place;

    },

    saveEvent() {

      this.loading = true;

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
      formData.append("photo_four", this.photoFour ? this.photoFour.file : null);


      axios.post("/wedding", formData)
          .then(res => {

            this.loading = false;

            const url = "/event/wedding/" + res.data.data.id;
            this.$router.push({path: url});

          })
          .catch(error => {

            this.$store.state.mainLoading = false;
            this.loading = false;


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
<template>
  <ion-content class="ion-padding" :fullscreen="true">
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

      <h4 class="ion-text-center ion-margin-top">{{userIsGroom ? "Bride " : "Groom "}} information</h4>


      <ion-list class="ion-margin-top" v-if="userIsGroom">

        <ion-item fill="outline" shape="round">
          <ion-input :autofocus="true" v-model="bride_name" type="text" placeholder="Bride's full Name"></ion-input>
        </ion-item>

        <ion-item class="ion-margin-top" fill="outline" shape="round">
          <ion-input :autofocus="true" type="text" v-model="bride_phone_number" placeholder="Bride's phone number"></ion-input>
        </ion-item>

        <ion-item class="ion-margin-top" fill="outline" shape="round">
          <ion-input :autofocus="true" type="text" v-model="bride_email" placeholder="Bride's email address"></ion-input>
        </ion-item>

      </ion-list>


      <ion-list class="ion-margin-top" v-else>

        <ion-item fill="outline" shape="round">
          <ion-input :autofocus="true" v-model="groom_name" type="text" placeholder="Groom's full Name"></ion-input>
        </ion-item>

        <ion-item class="ion-margin-top" fill="outline" shape="round">
          <ion-input type="tel" :autofocus="true"  v-model="groom_phone_number" placeholder="Groom's phone number"></ion-input>
        </ion-item>

        <ion-item class="ion-margin-top" fill="outline" shape="round">
          <ion-input type="email" :autofocus="true"  v-model="groom_email" placeholder="Groom's email address"></ion-input>
        </ion-item>

      </ion-list>


    </div>


    <div class="smooth-in" v-if="step==4">

      <p class="ion-text-center ion-no-margin">
        <span style="font-size: 70px">🎊</span>

      </p>

      <h2 class="ion-text-center ion-no-margin">All about the big day!</h2>

      <alert-component class="ion-margin-top" title="What's a tag?"
                       description="A tag is a unique text that identifies your wedding registry link. If you do not create one, a random tag would be created for you."></alert-component>

      <ion-list class="ion-margin-top">

        <ion-item class="ion-margin-top" fill="outline" shape="round">
          <ion-input v-model="tag" type="text" placeholder="Wedding #tag"></ion-input>
        </ion-item>

        <ion-item shape="round"  class="ion-margin-top" fill="outline">
          <ion-label>Date & Time:</ion-label>
          <ion-datetime-button datetime="datetime"></ion-datetime-button>
          <ion-modal :keep-contents-mounted="true">
            <ion-datetime hourCycle="h12" locale="en-GB" id="datetime"></ion-datetime>
          </ion-modal>

        </ion-item>

        <ion-item fill="outline" shape="round"  class="ion-margin-top">
          <ion-textarea rows="1" :autoGrow="true"  placeholder="RSVP Tel number"></ion-textarea>
        </ion-item>

        <ion-item fill="outline" shape="round"  class="ion-margin-top">
          <ion-textarea rows="1" :autoGrow="true"  placeholder="RSVP contact person name"></ion-textarea>
        </ion-item>

  <ion-item fill="outline" shape="round"  class="ion-margin-top">
          <ion-textarea rows="1" :autoGrow="true"  placeholder="Describe the location"></ion-textarea>
        </ion-item>


      </ion-list>

      <ion-button
          expand="block"
          shape="round"
          fill="clear"

      >Attach map location<ion-icon :icon="locationOutline"></ion-icon></ion-button>



      <!--      <maps-component v-if="addMap"></maps-component>-->
    </div>

    <div class="smooth-in" v-if="step==5">

      <h2 class="ion-text-center">Let's style things up</h2>

      <h4 class="font-weight-light">Add at most 4 photos to your registry page:</h4>
      <ion-grid>

        <ion-row>
          <ion-col size="6">
            <thumbnail-component></thumbnail-component>
          </ion-col>

          <ion-col size="6">
            <thumbnail-component></thumbnail-component>
          </ion-col>


          <ion-col size="6">
            <thumbnail-component></thumbnail-component>
          </ion-col>


          <ion-col size="6">
            <thumbnail-component></thumbnail-component>
          </ion-col>


        </ion-row>
      </ion-grid>

      <h4 class="font-weight-light">Share something nice about your union:</h4>

      <ion-item shape="round" fill="outline" class="ion-margin-top">
        <ion-textarea rows="1" :autoGrow="true" placeholder="A short beautiful story"></ion-textarea>
      </ion-item>

      <h4 class="font-weight-light">How do you want to say thank you?</h4>
      <ion-radio-group :value="thankYouvalue">

      <ion-slides :options="slideOption" :scrollbar="true">


        <ion-slide v-for="(page,index) in sampleThanks" :key="index">
          <ion-card @click="thankYouvalue=index" color="primary"  class="ion-text-left" mode="ios">
            <ion-item color="primary">
              <ion-radio color="warning" :value="index"></ion-radio>
              <ion-label>Select</ion-label>

            </ion-item>
            <ion-card-header>
              <ion-card-title>{{page.title}}


              </ion-card-title>
            </ion-card-header>
            <ion-card-content class="ion-text-left">

              <p>{{page.text}}</p>
              <ion-card-subtitle>
                {{page.subTitle}}<br>
                {{ groom_name }} & {{ bride_name }}
              </ion-card-subtitle>
            </ion-card-content>

          </ion-card>
        </ion-slide>

      </ion-slides>
      </ion-radio-group>

    </div>


  </ion-content>
  <ion-footer :translucent="true" collapse="fade" v-if="step>2">
    <ion-toolbar>
      <ion-button slot="start" fill="clear" @click="step--">
        <ion-icon :icon="caretBackOutline"></ion-icon>
        Prev.
      </ion-button>

      <ion-button @click="step++" slot="end" shape="round">
        Continue
        <ion-icon :icon="caretForwardOutline"></ion-icon>

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
  IonModal,
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
  caretForwardOutline,
  checkmarkCircle,
  checkmarkOutline,
  femaleOutline,
  maleOutline,
    locationOutline
} from "ionicons/icons";
import AlertComponent from "@/components/alertComponent";
import ThumbnailComponent from "@/components/thumbnailComponent";

export default {
  name: "weddingRegistryComponent",
  components: {
    IonAvatar,
    ThumbnailComponent,
    AlertComponent,
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
      slideOption:{
        initialSlide: 0,
        speed: 400,
        effect:"overflow"
      },
      thankYouvalue:0,
      sampleThanks: [
        {
          title:"Dear [Name],",
          text: "We are so thankful to have your love and support towards our wedding day.\n" +
              "                We wouldn’t want it any other way. Thank you for playing a big part in making our big day a reality.\n" +
              "                We truly appreciate you.\n" +
              "                All our love,",
          subTitle:""
        },
        {
          title:"Dear [Donor],",

          text: "This is a note to thank you for being there for us and supporting us.\n" +
              "                Your gift to us means more than you know. We are grateful to have family/friends\n" +
              "                like you who will do everything to celebrate our union.\n" +
              "                Thank you for reaching into your heart to share this gift with us.\n" +
              "                We love having you in our life.",
          subTitle: "Much love,"
        },
        {
          title:"Dear [Donor],",
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
      groom_name: "",
      groom_phone_number: "",
      groom_email: "",
      bride_name: "",
      bride_phone_number: "",
      bride_email: "",
      date: ""
    }
  },
  computed: {
    user() {
      return this.$store.state.user;
    },
    avatarUrl(){
      return this.userIsGroom ? "https://objectstorage.uk-london-1.oraclecloud.com/n/lrj6a9vl4is6/b/MyBucket/o/person1.png" : "https://objectstorage.uk-london-1.oraclecloud.com/n/lrj6a9vl4is6/b/MyBucket/o/avatar-2191918.png";

    }
  },
  methods: {
    setUser() {
      if (this.userIsGroom) {

        this.groom_name = this.user.first_name + " " + this.user.last_name;
        this.bride_name = "";

      } else {

        this.groom_name = "";
        this.bride_name = this.user.first_name + " " + this.user.last_name;

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
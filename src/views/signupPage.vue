<template>
  <ion-page>


    <ion-content class="ion-padding" :fullscreen="true">

      <center>

        <img style="margin-top: 40%; text-align: center" width="100"
             src="https://objectstorage.uk-london-1.oraclecloud.com/n/lrj6a9vl4is6/b/MyBucket/o/logo.png">
      </center>


      <h5 class="ion-text-center">Create Account</h5>


      <div v-if="step==1" class="smooth-in">

        <ion-item class="ion-margin-bottom nuna-select-item ion-margin-end ion-margin-start" lines="none">
          <ion-avatar slot="start">
            <flag :iso="countryCode"></flag>
          </ion-avatar>
          <ion-select
              interface="action-sheet"
              placeholder="Select your country"
              cancelText="Cancel"
              v-model="countryCode"
          >
            <ion-select-option
                v-for="country in countries"
                :key="country.code"
                :value="country.code"
            >
              <span>

              <flag :iso="country.code"></flag>
              {{ country.name }}
              </span>

            </ion-select-option>

          </ion-select>
        </ion-item>

        <ion-button mode="ios" class="ion-margin-start ion-margin-end" @click="goToStep(2)" size="large" expand="block"
                    shape="round">Continue
          <ion-icon :icon="arrowForwardOutline"/>
        </ion-button>

      </div>


      <div id="section" class="smooth-in" v-if="step==2">


        <ion-button fill="clear" class="ion-align-self-start" @click="step=step-1">
          <ion-icon
              :icon="arrowBackOutline"></ion-icon>
          Back
        </ion-button>
        <small class="ion-text-center text-muted ion-align-self-end ion-margin">Personal Info.</small>


        <ion-item lines="none" class="no-padding">
          <ion-input class="custom" v-model="firstName" type="text" placeholder="First Name"></ion-input>
        </ion-item>

        <ion-item lines="none" class="ion-margin-top">
          <ion-input class="custom" v-model="lastName" type="text" placeholder="Last Name"></ion-input>
        </ion-item>


        <ion-item lines="none" class="ion-margin-top">


          <ion-label>Birth Date:</ion-label>
          <ion-input type="date" class="custom" v-model="birthDate" placeholder="Birth Date"></ion-input>


          <!--          <ion-datetime-button datetime="datetime"></ion-datetime-button>-->
          <!--          <ion-modal-->
          <!--              :keep-contents-mounted="true">-->
          <!--            <ion-datetime presentation="date" @ionChange="dateSelected" :show-default-buttons="true" hourCycle="h12" locale="en-GB"-->
          <!--                          id="datetime">-->
          <!--              <span slot="title">Set your date of birth</span>-->
          <!--            </ion-datetime>-->
          <!--          </ion-modal>-->

        </ion-item>


        <!--        <ion-item class="ion-margin-top" fill="outline" shape="round">-->
        <!--          <ion-input v-model="idnumber" type="text" placeholder="ID Number"></ion-input>-->
        <!--        </ion-item>-->


        <ion-button mode="ios" @click="goToStep(3)" :disabled="!firstName || !lastName || !birthDate"
                    class="ion-margin-top ion-margin-end ion-margin-start" size="large" expand="block" shape="round">
          Continue
          <ion-icon :icon="arrowForwardOutline"/>
        </ion-button>


      </div>

      <div id="section" v-if="step==3" class="smooth-in">


        <ion-button
            mode="ios"
            :disabled="progress"
            fill="clear"
            class="ion-align-self-start"
            @click="step=step-1"
        >
          <ion-icon
              :icon="arrowBackOutline"
          ></ion-icon>
          Back
        </ion-button>
        <small class="ion-text-center text-muted ion-margin">Login Info</small>


        <ion-item lines="none">
          <ion-input class="custom" :disabled="progress" v-model="email" type="email" placeholder="Email"></ion-input>
        </ion-item>

        <ion-item lines="none" class="ion-margin-top">
          <ion-input class="custom" :disabled="progress" v-model="phoneNumber" type="tel"
                     placeholder="Phone Number"></ion-input>
        </ion-item>

        <ion-item lines="none" class="ion-margin-top">
          <ion-input class="custom" :disabled="progress" v-model="password" type="password"
                     placeholder="Password"></ion-input>
        </ion-item>

        <ion-item lines="none" class="ion-margin-top">
          <ion-input class="custom" :disabled="progress" v-model="passwordConfirmation" type="password"
                     placeholder="Confirm Password"></ion-input>
        </ion-item>

        <ion-button @click="signup"
                    :disabled="!email || !phoneNumber || !password || !passwordConfirmation || progress"
                    class="ion-margin-top ion-margin-start ion-margin-end" size="large"
                    mode="ios"
                    expand="block"
                    shape="round"
        >
          <template v-if="!progress">
            Finish
            <ion-icon :icon="checkmarkOutline"/>
          </template>

          <ion-spinner v-else></ion-spinner>

        </ion-button>

      </div>


      <ion-row>
        <ion-col size="8">
          <p class="text-muted"> Already have an account?</p>
        </ion-col>
        <ion-col size="4">
          <ion-button
              fill="clear"
              class="ion-align-self-start ion-no-padding ion-no-margin"
              router-link="/login"
              mode="ios"
          >Login
          </ion-button>
        </ion-col>
      </ion-row>

      <div class="ui-pattern">

      </div>
    </ion-content>
  </ion-page>

</template>

<script>

import {defineComponent} from 'vue';
import store from "@/store";


import {
  IonAvatar,
  IonButton,
  IonCol,
  IonContent,
  IonIcon,
  IonInput,
  IonItem,
  IonLabel,
  IonPage,
  IonRow,
  IonSelect,
  IonSelectOption,
  IonSpinner
} from '@ionic/vue';
import {arrowBackOutline, arrowForwardOutline, checkmarkOutline} from "ionicons/icons";
import Flag from "@/components/flag.vue";
import axios from "axios";

export default defineComponent({
  name: "signupPage",
  components: {
    IonLabel,
    IonSpinner,
    Flag,
    IonContent,
    IonPage,
    IonItem,
    IonButton,
    IonSelect,
    IonSelectOption,
    IonIcon,
    IonAvatar,
    IonInput,
    IonRow,
    IonCol
  },
  data() {
    return {
      arrowForwardOutline,
      arrowBackOutline,
      checkmarkOutline,
      step: 1,
      countryCode: "GH",
      email: "",
      phoneNumber: "",
      password: "",
      passwordConfirmation: "",
      firstName: "",
      lastName: "",
      birthDate: "",
      idnumber: "",
      progress: false,
      store
    }
  },
  computed: {
    countries() {

      // eslint-disable-next-line @typescript-eslint/no-var-requires
      const list = require("../countries.json");

      return list.sort((a, b) => a.name.localeCompare(b.name));
    }
  },
  mounted() {
    this.getCurrentCountryCode();
  },
  methods: {
    getCurrentCountryCode() {
      axios.get("http://ip-api.com/json/")
          .then(res => {

            this.countryCode = res.data.countryCode;

          });
    },
    dateSelected(dateTime) {
      this.birthDate = dateTime.detail.value;
    },
    goToStep(userStep) {
      this.step = userStep;
    },
    signup() {


      this.progress = true;
      const formData = new FormData();
      formData.append("first_name", this.firstName);
      formData.append("last_name", this.lastName);
      formData.append("phone_number", this.phoneNumber);
      formData.append("country_code", this.countryCode);
      formData.append("birth_date", this.birthDate);
      formData.append("email", this.email);
      formData.append("password", this.password);
      formData.append("password_confirmation", this.passwordConfirmation);
      axios.post("signup", formData)
          .then(res => {
            this.progress = false;
            localStorage.token = res.data.data.token;
            store.state.user = res.data.data.user;

            axios.defaults.headers.common = {
              Authorization: `Bearer ${localStorage.token}`,
            };

            this.$router.push("/tabs");
            store.commit("initUser");


          })
          .catch(error => {
            this.progress = false;

          })


    }
  }

});

</script>

<style scoped>

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

.smooth-in {
  animation: slide-in 0.3s ease-in-out 0s 1 normal forwards;
}

</style>
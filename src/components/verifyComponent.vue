<template>
  <ion-page>

    <ion-content>
      <div v-if="step==1" class="smooth-in">

        <verify-animation></verify-animation>
        <ion-card mode="ios" style="border: 1px solid lightgrey">
          <ion-card-header>
            <ion-toolbar>
              <ion-card-title>
                <ion-icon :icon="informationCircleOutline" size="large"></ion-icon>
                Verify your identity
              </ion-card-title>

            </ion-toolbar>

          </ion-card-header>
          <ion-card-content class="text-muted">
            In order to be eligible for withdrawals and access to other parts of the app you would need to verify your
            identity
            with any of the supported methods shown below.
          </ion-card-content>
        </ion-card>

        <ion-card class="no-padding" style="border: 1px solid #008080; padding-top: 15px!important;"
                  @click="step=2; type='ghana_card'">
          <ion-card-content class="no-padding">
            <ion-row>
              <ion-col size="2">
                <img src="/assets/icon/id-card.png" style="margin: 6px">

              </ion-col>
              <ion-col class="ion-padding-start" size="8">
                <h2>Ghana Card</h2>
                <small>Verify your identity with your Ghana card</small>
              </ion-col>

              <ion-col size="2">
                <ion-icon :icon="chevronForward" class="ion-margin" color="primary" size="large"></ion-icon>
              </ion-col>
            </ion-row>

          </ion-card-content>
        </ion-card>


        <ion-card class="no-padding" style="border: 1px solid #008080; padding-top: 15px!important;">
          <ion-card-content class="no-padding">
            <ion-row>
              <ion-col size="2">
                <img src="/assets/icon/id-card.png" style="margin: 6px">

              </ion-col>
              <ion-col class="ion-padding-start" size="8">
                <h3>Travel Passport</h3>
                <small>Verify your identity with your passport</small>
              </ion-col>
              <ion-col size="2">
                <ion-icon :icon="chevronForward" class="ion-margin" color="primary" size="large"></ion-icon>
              </ion-col>
            </ion-row>

          </ion-card-content>
        </ion-card>


        <ion-card class="no-padding" style="border: 1px solid #008080; padding-top: 15px!important;">
          <ion-card-content class="no-padding">
            <ion-row>
              <ion-col size="2">

                <img src="/assets/icon/id-card.png" style="margin: 6px">
              </ion-col>
              <ion-col class="ion-padding-start" size="8">
                <h3>Drivers license</h3>
                <small>Verify your identity with your license</small>
              </ion-col>
              <ion-col size="2">
                <ion-icon :icon="chevronForward" class="ion-margin" color="primary" size="large"></ion-icon>
              </ion-col>
            </ion-row>

          </ion-card-content>
        </ion-card>

      </div>

      <div v-if="step==2" class="smooth-in ion-padding">

        <center>
          <img height="60" src="/assets/icon/id-card.png" style="margin: 6px">

          <p >Verify using Ghana card</p>
          <small  class="text-muted ion-padding">
            Continue to verify your identity using to your Ghana card, provide your real first name, last name,
            Ghana card number and birth date together with a photo of your card to verify your identity.
          </small>

        </center>

        <ion-card class="no-margin" @click="startCapture"
                  style="height: 150px; border: 2px dashed lightgrey; background-color: rgba(204,204,204,0.2); text-align: center; background-size: contain; background-repeat: no-repeat; background-position: center"
                  :style="'background-image:url('+cardPreview+')'">
          <ion-card-content>

            <p v-if="!cardPreview.length">Upload card photo</p>
            <small v-if="!cardPreview.length" class="text-muted">Preview of your Ghana card would show here </small>

            <ion-button expand="block" fill="outline" mode="ios">
             {{cardPreview.length ? 'Change' : 'Upload'}}
              <ion-icon :icon="cameraOutline"></ion-icon>
            </ion-button>
          </ion-card-content>

        </ion-card>

        <input id="photo_selector" accept="image/*" capture="environment" @change="photoSelected($event)" style="display: none"
               type="file">

          <ion-item class="ion-margin-top" lines="none">
            <ion-input
                v-model="id_number"
                class="custom"
                placeholder="Ghana card number"
            ></ion-input>
          </ion-item>

          <ion-item class="ion-margin-top" lines="none">
            <ion-input
                v-model="first_name"
                class="custom"
                placeholder="First name"
            ></ion-input>
          </ion-item>


          <ion-item class="ion-margin-top" lines="none">
            <ion-input
                v-model="last_name"
                class="custom"

                placeholder="Last name"
            ></ion-input>
          </ion-item>


          <ion-item class="ion-margin-top nuna-select-item" lines="none"
                    style="margin-right: 15px; margin-left: 18px; margin-top: 30px">
            <ion-label>Birth Date:</ion-label>
            <ion-datetime-button
                datetime="datetime"
            ></ion-datetime-button>
            <ion-modal
                :keep-contents-mounted="true">
              <ion-datetime
                  id="datetime"
                  :show-default-buttons="true"
                  :value="dob"
                  hourCycle="h12"
                  locale="en-GB"
                  presentation="date"
                  @ionChange="dateSelected"
              >
                <span slot="title">Set your date of birth</span>
              </ion-datetime>
            </ion-modal>

          </ion-item>
        <ion-button
            class="ion-margin-start ion-margin-end ion-margin-top"
            expand="block"
            mode="ios"
            size="large"
            style="transition: 0.3s ease-in-out"
        >
          <template v-if="!progress">Submit</template>
          <ion-spinner v-if="progress" style="transition: 0.3s ease-in-out"></ion-spinner>
        </ion-button>

      </div>

    </ion-content>
  </ion-page>

</template>

<script>
import {
  IonContent,
  IonCard,
  IonCardContent,
  IonIcon,
  IonCardTitle,
  IonCardHeader,
  IonRow,
  IonCol,
  IonItem,
  IonInput,
  IonModal,
  IonDatetime,
  IonDatetimeButton,
  IonLabel,
  IonButton,
  IonSpinner,
  IonToolbar,
  IonPage
} from "@ionic/vue";
import {informationCircleOutline, chevronForward, cameraOutline} from "ionicons/icons";
import VerifyAnimation from "@/components/verifyAnimation";
import store from "@/store";
import moment from "moment";

export default {
  name: "verifyComponent",
  components: {
    IonPage,
    IonToolbar,
    IonSpinner,
    IonButton,
    VerifyAnimation,
    IonContent,
    IonCard,
    IonCardContent,
    IonIcon,
    IonCardTitle,
    IonCardHeader,
    IonRow,
    IonCol,
    IonItem,
    IonInput,
    IonModal,
    IonDatetime,
    IonDatetimeButton,
    IonLabel
  },
  methods: {
    photoSelected(e) {

      const photo = e.target.files[0];
      const fr = new FileReader();
      fr.readAsDataURL(photo);
      fr.onload=()=>{
        this.cardPreview = fr.result;

      }

    },
    dateSelected(date) {

      this.dob = date.detail.value;

    },
    startCapture() {
      document.getElementById("photo_selector").click();
    }
  },
  computed: {
    user() {
      return store.state.user;
    }
  },
  data() {
    return {
      cardPreview: "",
      progress: false,
      informationCircleOutline, cameraOutline,
      chevronForward,
      step: 1,
      type: "ghana_card",
      first_name: "",
      last_name: "",
      id_number: "",
      dob: "",
    }
  },
  mounted() {
    this.first_name = this.user.first_name;
    this.last_name = this.user.last_name;
    this.dob = moment(this.user.birth_date).format("Y-mM-DD");
  }
}
</script>

<style scoped>

</style>
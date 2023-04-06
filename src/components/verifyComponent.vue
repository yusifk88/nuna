<template>

    <ion-content style="max-height: 100vh; overflow: auto;">
      <div v-if="step==1" class="smooth-in ion-margin-bottom" style="margin-bottom: 5em;">

        <verify-animation></verify-animation>
        <ion-card mode="ios" style="border: 1px solid lightgrey">

          <ion-card-content class="text-muted ion-text-center">
            <h1>
              <ion-icon :icon="informationCircleOutline" size="large"></ion-icon>
              Verify your identity
            </h1>


            <small>

              In order to be eligible for withdrawals and access to other parts of the app you would need to verify your
              identity
              with any of the supported methods shown below.
            </small>

          </ion-card-content>
        </ion-card>

        <ion-card class="no-padding" style="border: 1px solid #008080; padding-top: 15px!important;"
                  @click="step=2; id_type='ghana_card'">
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


        <ion-card  @click="step=2; id_type='passport'" class="no-padding" style="border: 1px solid #008080; padding-top: 15px!important;">
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


        <ion-card @click="step=2; id_type='dv_license'" class="no-padding ion-margin-bottom" style="border: 1px solid #008080; padding-top: 15px!important;">
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

      <div v-if="step==2" class="smooth-in ion-padding" style="margin-bottom: 5em;">

        <center>
          <img height="60" src="/assets/icon/id-card.png" style="margin: 6px">

          <p v-if="id_type==='ghana_card'">Verify using Ghana card</p>
          <p v-if="id_type==='passport'">Verify using passport</p>
          <p v-if="id_type==='dv_license'">Verify using drivers license</p>

          <small class="text-muted ion-padding" v-if="id_type==='ghana_card'">
            Verify your identity using your Ghana card, provide your real first name, last name,
            Ghana card number and birth date together with a photo of your card to verify your identity.
          </small>

          <small class="text-muted ion-padding" v-if="id_type==='passport'">
            Verify your identity using your passport, provide your real first name, last name,
            passport number and birth date together with a photo of your passport to verify your identity.
          </small>



          <small class="text-muted ion-padding" v-if="id_type==='dv_license'">
            Verify your identity using your drivers license, provide your real first name, last name,
            drivers license number and birth date together with a photo of your drivers license to verify your identity.
          </small>



        </center>

        <ion-card :style="'background-image:url('+cardPreview+')'"
                  style="height: 150px; border: 2px dashed lightgrey; background-color: rgba(204,204,204,0.2); text-align: center; background-size: contain; background-repeat: no-repeat; background-position: center"
                  @click="startCapture">
          <ion-card-content>

            <p>Upload photo of identification document</p>

            <ion-button expand="block" fill="outline" mode="ios">
              {{ cardPreview.length ? 'Change' : 'Upload' }}
              <ion-icon :icon="cameraOutline"></ion-icon>
            </ion-button>
          </ion-card-content>

        </ion-card>

        <input id="photo_selector" accept="image/*" style="display: none" type="file"
               @change="photoSelected($event)">

        <ion-item class="ion-margin-top" lines="none">
          <ion-input
              v-model="id_number"
              class="custom"
              placeholder="ID Number"
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
            @click="submitRequest"
            :disabled="progress"
        >
          <template v-if="!progress">Submit</template>
          <ion-spinner v-if="progress" style="transition: 0.3s ease-in-out"></ion-spinner>
        </ion-button>

        <ion-button
            class="ion-margin-start ion-margin-end ion-margin-top"
            expand="block"
            fill="outline"
            mode="ios"
            size="large"
            style="transition: 0.3s ease-in-out"
            @click="step=1"
            :disabled="progress"

        >
          <ion-icon :icon="arrowBackOutline"></ion-icon>
          <template v-if="!progress">Change</template>
          <ion-spinner v-if="progress" style="transition: 0.3s ease-in-out"></ion-spinner>
        </ion-button>


      </div>

    </ion-content>

</template>

<script>
import {
  IonContent,
  IonCard,
  IonCardContent,
  IonIcon,
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
  toastController,
} from "@ionic/vue";
import {informationCircleOutline, chevronForward, cameraOutline, arrowBackOutline} from "ionicons/icons";
import VerifyAnimation from "@/components/verifyAnimation";
import store from "@/store";
import moment from "moment";
import axios from "axios";

export default {
  name: "verifyComponent",
  components: {
    IonSpinner,
    IonButton,
    VerifyAnimation,
    IonContent,
    IonCard,
    IonCardContent,
    IonIcon,

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
    async showSuccess(message){


      const toast = await toastController.create({
        message: message,
        duration: 2500,
        position: 'top',
        color:"success",
        mode:"ios"
      });

      await toast.present();

    },
    photoSelected(e) {

      const photo = e.target.files[0];
      this.IDFile = photo;
      const fr = new FileReader();
      fr.readAsDataURL(photo);
      fr.onload = () => {
        this.cardPreview = fr.result;

      }

    },
    dateSelected(date) {

      this.dob = date.detail.value;

    },
    startCapture() {
      document.getElementById("photo_selector").click();
    },
    submitRequest() {

      if (!this.first_name) {

        this.$store.state.ErrorPosition = "top";
        this.$store.state.errorsArr = {name: ["First name is required"]};
        this.$store.state.showErrorToast = true;
        return;

      }

      if (!this.last_name) {
        this.$store.state.ErrorPosition = "top";

        this.$store.state.errorsArr = {name: ["Last name is required"]};
        this.$store.state.showErrorToast = true;
        return;

      }

      if (!this.id_number) {

        this.$store.state.ErrorPosition = "top";
        this.$store.state.errorsArr = {name: ["ID number is required"]};
        this.$store.state.showErrorToast = true;

        return;

      }

      if (!this.IDFile) {

        this.$store.state.ErrorPosition = "top";
        this.$store.state.errorsArr = {name: ["Select a photo of your ID card"]};
        this.$store.state.showErrorToast = true;

        return;

      }

      const formData = new FormData();

      formData.append("first_name", this.first_name);
      formData.append("last_name", this.last_name);
      formData.append("id_number", this.id_number);
      formData.append("card_photo", this.IDFile);
      formData.append("birth_date", this.dob);
      formData.append("id_type", this.id_type);

      this.progress = true;

      axios.post("request-verification", formData)
          .then(res => {
            this.progress = false;
            this.showSuccess("Your request to verify your account was submitted successfully");
            this.$emit("done");

          })

          .catch(error => {
            this.progress = false;
          })


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
      arrowBackOutline,
      IDFile: null,
      step: 1,
      type: "ghana_card",
      first_name: "",
      last_name: "",
      id_number: "",
      dob: "",
      id_type:"ghana_card"
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
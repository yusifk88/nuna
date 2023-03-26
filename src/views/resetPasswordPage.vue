<template>
  <ion-page>
    <ion-content :fullscreen="true" class="ion-padding">
      <center>
        <logo-component></logo-component>
      </center>

      <h5 class="ion-text-center">Reset Password</h5>

      <div v-if="step==1" class="smooth-in">
        <p class="ion-text-center">
          <small class="text-muted">
            To reset your password we would need to verify your phone number.<br>
            Enter your phone number to receive the verification code.
          </small>
        </p>

        <ion-item lines="none">
          <ion-input v-model="phone_number" autofocus class="custom" inputmode="tel"
                     placeholder="Phone Number"></ion-input>
        </ion-item>

        <ion-button
            :disabled="!Boolean(phone_number) || progress"
            class="ion-margin-end ion-margin-start ion-margin-top"
            expand="block"
            mode="ios"
            shape="round"
            size="large"
            @click="sendVerification"
        >Verify
          <template v-if="progress">
            <ion-spinner></ion-spinner>
          </template>
        </ion-button>

      </div>


      <div v-if="step==2" class="smooth-in">

        <p class="ion-text-center ion-padding text-muted">

          Enter the code sent to <strong>{{ phone_number }}</strong> together with your new password to confirm password
          reset.

        </p>

        <ion-item lines="none">
          <ion-input v-model="code" autofocus class="custom" placeholder="Verification Code"
                     type="number"></ion-input>
        </ion-item>

        <ion-item class="ion-margin-top" lines="none">
          <ion-input v-model="password" autofocus class="custom" placeholder="New Password"
                     type="password"></ion-input>
        </ion-item>
        <ion-item class="ion-margin-top" lines="none">
          <ion-input v-model="confirmPassword" autofocus class="custom" placeholder="Repeat Password"
                     type="password"></ion-input>
        </ion-item>


        <ion-row>
          <ion-col class="ion-text-end ion-padding-top text-muted" size="6">
            Didn't get the code?
          </ion-col>
          <ion-col size="6">
            <ion-button
                expand="block"
                fill="clear"
                mode="ios"
                shape="round"
                @click="step=1"
            >Re-send verification
            </ion-button>
          </ion-col>
        </ion-row>

        <ion-button
            :disabled="!Boolean(phone_number) && !progress"
            class="ion-margin-end ion-margin-start ion-margin-top"
            expand="block"
            mode="ios"
            shape="round"
            size="large"
            @click="resetPassword"
        >Change Password
          <template v-if="progress">
            <ion-spinner></ion-spinner>
          </template>
        </ion-button>

      </div>


      <ion-row>
        <ion-col size="6">
          <ion-button
              class="ion-margin-end ion-margin-start ion-margin-top"
              fill="clear"
              mode="ios"
              router-link="/login"
              shape="round"
          >Login
          </ion-button>

        </ion-col>
        <ion-col size="6">
          <ion-button
              class="ion-margin-end ion-margin-start ion-margin-top"
              fill="clear"
              mode="ios"
              router-link="/register"
              shape="round"
          >Signup
          </ion-button>

        </ion-col>

      </ion-row>


      <div class="ui-pattern">


      </div>

    </ion-content>
  </ion-page>


</template>

<script>
import {
  IonPage,
  IonContent,
  IonItem,
  IonInput,
  IonButton,
  IonRow,
  IonCol,
  IonSpinner,
  toastController
} from "@ionic/vue";
import LogoComponent from "@/components/logo";
import axios from "axios";

export default {
  name: "resetPasswordPage",
  components: {LogoComponent, IonPage, IonContent, IonItem, IonInput, IonButton, IonRow, IonCol, IonSpinner},
  data() {
    return {
      step: 1,
      phone_number: "",
      progress: false,
      code: "",
      confirmPassword: "",
      password: ""
    }
  },
  methods: {

    async showSuccess(message) {


      const toast = await toastController.create({
        message: message,
        duration: 1500,
        position: 'top',
        color: "success",
        mode: "ios"
      });

      await toast.present();

    },
    resetPassword() {

      if (this.password !== this.confirmPassword) {

        this.$store.state.ErrorPosition = "top";
        this.$store.state.errorsArr = {name: ["Password confirmation failed, make sure your password and confirmation are the same."]};
        this.$store.state.showErrorToast = true;
        return;
      }

      this.progress = true;

      axios.post("reset-password", {
        code: this.code,
        password: this.password,
        password_confirmation: this.confirmPassword
      })
          .then(res => {

            this.progress = false;
            this.showSuccess("Password reset successfully");

            this.$router.push("/login");


          })
          .catch(error => {

            this.progress = false;

          })


    },
    sendVerification() {
      this.progress = true;
      axios.post("sendVerification", {phone_number: this.phone_number})
          .then(res => {
            this.progress = false;
            this.step = 2;
          })
          .catch(error => {
            this.progress = false;

          })

    }
  }
}
</script>

<style scoped>

</style>
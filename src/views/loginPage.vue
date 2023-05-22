<template>
  <ion-page>

    <ion-content color="light" class="ion-padding" :fullscreen="true">
      <center>

        <img style="margin-top: 40%; text-align: center"  width="100" src="https://objectstorage.uk-london-1.oraclecloud.com/n/lrj6a9vl4is6/b/MyBucket/o/logo.png">
      </center>

      <h4 class="ion-text-center" >Login</h4>

      <ion-item color="light" lines="none">
        <ion-input class="custom" v-model="email" type="text" placeholder="Phone Number or Email"></ion-input>
      </ion-item>

      <ion-item  lines="none" class="ion-margin">
        <ion-input class="custom" v-model="password" :type="passwordType" placeholder="Password"></ion-input>
        <ion-icon @click="showPassword=!showPassword" :icon="!showPassword ? eyeOutline : eyeOffOutline" slot="end"></ion-icon>
      </ion-item>


      <ion-button @click="resetPassword" mode="ios" fill="clear" class="ion-align-self-start">Forget password?</ion-button>

      <ion-button
          size="large"
          expand="block"
          :disabled="progress"
          shape="round"
          @click="login"
          mode="ios"
          class="ion-margin-start ion-margin-end"
      >
        <template v-if="!progress">
          Login
        </template>
        <ion-spinner v-else></ion-spinner>
      </ion-button>



      <ion-row>
        <ion-col size="8">
         <p> Don't have an account ?</p>
        </ion-col>
        <ion-col size="4">
          <ion-button mode="ios" router-link="/register" fill="clear" class="ion-align-self-start ion-no-margin ion-no-padding">Sign Up</ion-button>
        </ion-col>
      </ion-row>
      <div class="ui-pattern"></div>
    </ion-content>
  </ion-page>



</template>

<script lang="ts">
import {defineComponent} from 'vue';
import {eyeOutline,eyeOffOutline} from "ionicons/icons";
import {IonSpinner, IonPage, IonContent, IonInput, IonItem, IonButton,IonRow,IonCol,IonIcon} from '@ionic/vue';
import axios from "axios";
import store from "@/store";

export default defineComponent({
  name: "loginPage",
  components: {IonSpinner, IonContent, IonPage, IonInput, IonItem, IonButton,IonRow,IonCol,IonIcon},
  data() {
    return {
      email: "",
      password: "",
      progress: false,
      eyeOutline,
      eyeOffOutline,
      showPassword:false
    }
  },
  computed:{
    passwordType(){
      return this.showPassword ? "text":"password";
    }
  },
  methods: {
    resetPassword(){
      this.$router.push("/reset-password");
    },
    login() {
      this.progress = true;
      const formData = new FormData();
      formData.append("email", this.email);
      formData.append("password", this.password);
      axios.post("login", formData)
          .then(res => {
            this.progress = false;
            localStorage.token = res.data.data.token;
            store.state.user = res.data.data.user;

            axios.defaults.headers.common = {
              Authorization: `Bearer ${localStorage.token}`,
            };

            this.$router.push("/tabs");
            store.commit("initUser");


          }).catch(error => {
        this.progress = false;
      })

    }
  }

});

</script>

<style>



</style>
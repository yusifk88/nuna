<template>
  <ion-page>

    <ion-content class="ion-padding" :fullscreen="true">
      <center>

        <img style="margin-top: 40%; text-align: center"  width="100" src="https://objectstorage.uk-london-1.oraclecloud.com/n/lrj6a9vl4is6/b/MyBucket/o/logo.png">
      </center>

      <h4 class="ion-text-center" >Login</h4>

      <ion-item lines="none">
        <ion-input class="custom" v-model="email" type="text" placeholder="Phone Number or Email"></ion-input>
      </ion-item>

      <ion-item lines="none" class="ion-margin-top">
        <ion-input class="custom" v-model="password" type="password" placeholder="Password"></ion-input>
      </ion-item>


      <ion-button mode="ios" fill="clear" class="ion-align-self-start">Forget password?</ion-button>

      <ion-button
          size="large"
          expand="block"
          :disabled="progress"
          shape="round"
          @click="login"
          mode="ios"
      >
        <template v-if="!progress">
          Login
        </template>
        <ion-spinner v-else></ion-spinner>
      </ion-button>

      <p>Don't have an account ?
        <ion-button mode="ios" router-link="/register" fill="clear" class="ion-align-self-start">Sign Up</ion-button>
      </p>

    </ion-content>
  </ion-page>
</template>

<script lang="ts">
import {defineComponent} from 'vue';

import {IonSpinner, IonPage, IonContent, IonInput, IonItem, IonButton} from '@ionic/vue';
import axios from "axios";
import store from "@/store";

export default defineComponent({
  name: "loginPage",
  components: {IonSpinner, IonContent, IonPage, IonInput, IonItem, IonButton},
  data() {
    return {
      email: "",
      password: "",
      progress: false
    }
  },
  methods: {
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

<style scoped>

</style>
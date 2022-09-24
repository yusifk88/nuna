<template>
  <ion-page>

    <ion-content class="ion-padding" :fullscreen="true">

      <h1 class="ion-text-center" style="margin-top: 50%">Welcome to Nuna</h1>

      <ion-item fill="outline" shape="round">
        <ion-input v-model="email" type="text" placeholder="Phone Number or Email"></ion-input>
      </ion-item>

      <ion-item class="ion-margin-top" fill="outline" shape="round">
        <ion-input v-model="password" type="password" placeholder="Password"></ion-input>
      </ion-item>


      <ion-button fill="clear" class="ion-align-self-start">Forget password?</ion-button>

      <ion-button
          size="large"
          expand="block"
          :disabled="progress"
          shape="round"
          @click="login"
      >
        <template v-if="!progress">
          Login
        </template>
        <ion-spinner v-else></ion-spinner>
      </ion-button>

      <p>Don't have an account ?
        <ion-button router-link="/register" fill="clear" class="ion-align-self-start">Sign Up</ion-button>
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
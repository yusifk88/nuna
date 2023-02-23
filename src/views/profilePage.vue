<template>
<ion-page ref="profilePage">

  <ion-header class="ion-no-border" style="box-shadow: none !important;">
    <ion-toolbar>
      <ion-back-button slot="start"></ion-back-button>
      <ion-title>
       Your Profile Settings
      </ion-title>

    </ion-toolbar>
  </ion-header>

  <ion-content>

    <ion-list class="ion-margin-top">
      <ion-item fill="outline" class="ion-margin">
        <ion-avatar slot="start">
          <img alt="Silhouette of a person's head" src="https://ionicframework.com/docs/img/demos/avatar.svg" />
        </ion-avatar>
        <ion-label style="border: none">
          <h1>{{user.first_name}} {{user.last_name}}</h1>
        </ion-label>
      </ion-item>
    </ion-list>

    <ion-list class="ion-margin-top">
      <ion-item detail="true">
        <ion-icon :icon="personOutline" size="large" slot="start">
        </ion-icon>
        <ion-label>
          <h2>Profile</h2>
          <p>View and update your profile</p>
        </ion-label>
      </ion-item>

      <ion-item detail="true">
        <ion-icon :icon="idCardOutline" size="large" slot="start">
        </ion-icon>
        <ion-label>
          <h2>Verify your identity</h2>
          <p>Help us know you better, this is required before any withdrawals</p>
        </ion-label>
      </ion-item>


      <ion-item detail="true">
        <ion-icon :icon="informationCircleOutline" size="large" slot="start">
        </ion-icon>
        <ion-label>
          <h2>About Nuna</h2>
          <p>Find out what Nuna is about</p>
        </ion-label>
      </ion-item>

    </ion-list>

    <ion-button fill="outline" id="open-logout" color="danger" size="large" expand="block" class="ion-margin" mode="ios">Log Out</ion-button>

    <ion-modal
        ref="logoutModal"
        :breakpoints="[0, 0.23]"
        :initial-breakpoint="0.23"
        handle-behavior="cycle"
        mode="ios"
        trigger="open-logout"
    >
      <ion-header>
        <ion-toolbar>
          <ion-title>Confirm Logout</ion-title>
        </ion-toolbar>
      </ion-header>
      <ion-content class="ion-text-center">
        <h5 class="text-muted">Are you sure you want to log out of your account?</h5>
        <ion-button @click="confirmLogout" size="large" color="danger" expand="block" maode="ios">Yes, Log Out</ion-button>
      </ion-content>
    </ion-modal>


    <ion-card @click="showHelpModal=true" class="ion-margin" style="background-color: rgba(34,188,133,0.16); border-radius: 20px">
      <ion-card-content class="ion-text-center">
        <ion-row>
          <ion-col size="2">
            <svg style="fill: #22BC85 !important; height: 70px; width:70px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><title>face-agent</title><path d="M18.72,14.76C19.07,13.91 19.26,13 19.26,12C19.26,11.28 19.15,10.59 18.96,9.95C18.31,10.1 17.63,10.18 16.92,10.18C13.86,10.18 11.15,8.67 9.5,6.34C8.61,8.5 6.91,10.26 4.77,11.22C4.73,11.47 4.73,11.74 4.73,12A7.27,7.27 0 0,0 12,19.27C13.05,19.27 14.06,19.04 14.97,18.63C15.54,19.72 15.8,20.26 15.78,20.26C14.14,20.81 12.87,21.08 12,21.08C9.58,21.08 7.27,20.13 5.57,18.42C4.53,17.38 3.76,16.11 3.33,14.73H2V10.18H3.09C3.93,6.04 7.6,2.92 12,2.92C14.4,2.92 16.71,3.87 18.42,5.58C19.69,6.84 20.54,8.45 20.89,10.18H22V14.67H22V14.69L22,14.73H21.94L18.38,18L13.08,17.4V15.73H17.91L18.72,14.76M9.27,11.77C9.57,11.77 9.86,11.89 10.07,12.11C10.28,12.32 10.4,12.61 10.4,12.91C10.4,13.21 10.28,13.5 10.07,13.71C9.86,13.92 9.57,14.04 9.27,14.04C8.64,14.04 8.13,13.54 8.13,12.91C8.13,12.28 8.64,11.77 9.27,11.77M14.72,11.77C15.35,11.77 15.85,12.28 15.85,12.91C15.85,13.54 15.35,14.04 14.72,14.04C14.09,14.04 13.58,13.54 13.58,12.91A1.14,1.14 0 0,1 14.72,11.77Z" /></svg>
          </ion-col>
          <ion-col size="10" class="ion-text-center">
            <p style="color:#316552; font-size: 20px; font-weight: bolder; vert-align: middle; padding: 0; text-align: center !important; margin-top: 25px;"> How can we help you?</p>
          </ion-col>
        </ion-row>
      </ion-card-content>
    </ion-card>

    <ion-row style="border-bottom: 1px solid rgba(128,128,128,0.32)" class="ion-padding">
      <ion-col size="6" class="ion-text-center">
        <a href="https://mynunaa.com/privacy-policy" class="ion-margin">Privacy Policy ></a>
      </ion-col>

       <ion-col size="6" class="ion-text-center">
        <a href="https://mynunaa.com" class="ion-margin">Imprint ></a>
      </ion-col>
    </ion-row>

    <h5 class="ion-text-center text-muted"><svg style="height: 20px; width: 20px; margin-right: 5px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><title>copyright</title><path d="M10.08 10.86C10.13 10.53 10.24 10.24 10.38 10C10.68 9.44 11.19 9.15 11.88 9.14C12.33 9.14 12.74 9.34 13.03 9.63C13.31 9.94 13.5 10.37 13.5 10.8H15.3C15.28 10.33 15.19 9.9 15 9.5C14.85 9.12 14.62 8.78 14.32 8.5C12.87 7.16 10.18 7.35 8.95 8.87C7.66 10.54 7.63 13.46 8.94 15.13C10.15 16.62 12.8 16.83 14.24 15.5C14.55 15.25 14.8 14.94 15 14.58C15.16 14.22 15.27 13.84 15.28 13.43H13.5C13.5 13.64 13.43 13.83 13.34 14C13.25 14.19 13.13 14.34 13 14.47C12.67 14.73 12.28 14.87 11.86 14.87C11.5 14.86 11.2 14.79 10.97 14.64C10.72 14.5 10.5 14.27 10.38 14C9.88 13.1 9.96 11.85 10.08 10.86M12 2C6.5 2 2 6.5 2 12C2.53 25.27 21.5 25.26 22 12C22 6.5 17.5 2 12 2M12 20C7.59 20 4 16.41 4 12C4.44 1.39 19.56 1.39 20 12C20 16.41 16.41 20 12 20Z" /></svg>Nuna Technologies LTD {{new Date().getFullYear()}}</h5>



    <ion-modal
        mode="ios"
        ref="helpModal"
        :is-open="showHelpModal"
        :presenting-element="presentingElement"
    >
      <ion-header>
        <ion-toolbar>
          <ion-title>Help Center</ion-title>
          <ion-buttons slot="end">
            <ion-button @click="dismissHelp">Close</ion-button>
          </ion-buttons>
        </ion-toolbar>
      </ion-header>
      <ion-content class="ion-padding">
        <iframe style="width: 100%!important; height: 85vh!important; border: none !important;" src="https://tawk.to/chat/63bf3892c2f1ac1e202cf879/1gmhf9vi0"> </iframe>
      </ion-content>

    </ion-modal>
  </ion-content>
</ion-page>

</template>

<script>
import {defineComponent} from 'vue';
import {IonPage,IonContent,IonHeader,IonToolbar,IonBackButton,IonTitle,IonList,IonItem,IonLabel,IonAvatar,IonIcon,IonCard,IonCardContent,IonRow,IonCol,IonButton,IonModal,IonButtons} from "@ionic/vue";
import {logInOutline,personOutline,idCardOutline,informationCircleOutline,helpBuoyOutline} from "ionicons/icons";
export default defineComponent( {
  name: "profilePage",
  components:{IonPage,IonContent,IonHeader,IonToolbar,IonBackButton,IonTitle,IonList,IonItem,IonLabel,IonAvatar,IonIcon,IonCard,IonCardContent,IonRow,IonCol,IonButton,IonModal,IonButtons},
  computed:{
    user(){
      return this.$store.state.user;
    }
  },
  data(){
    return{
      logInOutline,
      personOutline,
      idCardOutline,
      informationCircleOutline,
      helpBuoyOutline,
      showHelpModal:false,
      presentingElement:null
    }
  },
  methods:{
    dismissHelp(){
      this.$refs.helpModal.$el.dismiss();
      this.showHelpModal=false;
    },
    confirmLogout(){

      localStorage.removeItem("token");
      this.$refs.logoutModal.$el.dismiss(null, 'cancel');

      this.$router.push("/login");

    }
  },
  mounted() {
    this.presentingElement = this.$refs.profilePage.$el;

  }
})
</script>

<style scoped>

</style>
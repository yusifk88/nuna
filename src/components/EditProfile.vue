<template>
  <ion-content class="ion-padding">

    <ion-list class="ion-padding-bottom">
      <ion-list-header>
        <ion-label>Account info.</ion-label>
        <ion-button :disabled="user.approved" @click="preventEdit=!preventEdit">
          Edit
          <ion-icon :icon="createOutline"></ion-icon>
        </ion-button>
      </ion-list-header>

      <ion-item lines="none">
        <ion-label class="text-muted" position="stacked">First Name</ion-label>

        <ion-input
            v-model="first_name"
            :disabled="preventEdit"
            class="custom"

        ></ion-input>
      </ion-item>

      <ion-item class="ion-margin-top" lines="none">
        <ion-label position="stacked">Last Name</ion-label>
        <ion-input
            v-model="last_name"
            :disabled="preventEdit"
            class="custom"

        ></ion-input>
      </ion-item>

      <ion-item class="ion-margin-top nuna-select-item" lines="none"
                style="margin-right: 15px; margin-left: 18px; margin-top: 30px">
        <ion-label>Birth Date:</ion-label>
        <ion-datetime-button
            :disabled="preventEdit"
            datetime="datetime"
        ></ion-datetime-button>
        <ion-modal
            :keep-contents-mounted="true">
          <ion-datetime
              id="datetime"
              :show-default-buttons="true"
              :value="birthDate"
              hourCycle="h12"
              locale="en-GB"
              presentation="date"
              @ionChange="dateSelected"
          >
            <span slot="title">Set your date of birth</span>
          </ion-datetime>
        </ion-modal>

      </ion-item>

      <ion-item class="ion-margin-top" lines="none">
        <ion-label position="stacked">Phone Number</ion-label>
        <ion-input
            v-model="phone_number"
            :disabled="preventEdit"
            class="custom"
            inputmode="tel"
        ></ion-input>
      </ion-item>


    </ion-list>
    <ion-button v-if="!preventEdit" :disabled="progress" class="ion-margin-start ion-margin-end"
                expand="block" mode="ios" size="large" style="transition: 0.3s ease-in-out" @click="updateProfile">
      <template v-if="!progress">Update Profile</template>
      <ion-spinner v-if="progress" style="transition: 0.3s ease-in-out"></ion-spinner>
    </ion-button>

  </ion-content>
</template>

<script>

import {
  IonContent,
  IonList,
  IonItem,
  IonInput,
  IonListHeader,
  IonLabel,
  IonDatetimeButton,
  IonDatetime,
  IonModal,
  IonButton,
  IonIcon,
  IonSpinner
} from "@ionic/vue";
import {pencilOutline, createOutline} from "ionicons/icons";
import store from "@/store";
import moment from "moment";

export default {
  name: "EditProfile",
  components: {
    IonContent,
    IonList,
    IonItem,
    IonInput,
    IonListHeader,
    IonLabel,
    IonDatetimeButton,
    IonDatetime,
    IonModal,
    IonButton,
    IonIcon,
    IonSpinner
  },
  data() {
    return {
      first_name: "",
      last_name: "",
      birthDate: "",
      phone_number: "",
      pencilOutline,
      createOutline,
      preventEdit: true,
      progress: false
    }
  },
  computed: {
    user() {
      return store.state.user;
    }
  },
  methods: {
    dateSelected(date) {

      this.birthDate = date.detail.value;

    },
    updateProfile() {
      if (!this.first_name.length > 0) {
        this.$store.state.ErrorPosition = "top";
        this.$store.state.errorsArr = {name: ["First name is required"]};
        this.$store.state.showErrorToast = true;
        return;
      }

      if (!this.last_name.length > 0) {
        this.$store.state.ErrorPosition = "top";
        this.$store.state.errorsArr = {name: ["Last name is required"]};
        this.$store.state.showErrorToast = true;
        return;

      }

      if (!this.phone_number.length > 0) {
        this.$store.state.ErrorPosition = "top";
        this.$store.state.errorsArr = {name: ["Phone number is required"]};
        this.$store.state.showErrorToast = true;
        return;

      }


      const formData = new FormData();
      formData.append("first_name", this.first_name);
      formData.append("last_name", this.last_name);
      formData.append("phone_number", this.phone_number);
      formData.append("birth_date", this.birthDate);

      this.progress = true;
      window.axios.post("/update-profile", formData)
          .then(res => {
            this.progress = false;
            this.$emit("done");

          })
          .catch(error => {
            this.progress = false;

          })


    }
  },
  mounted() {

    this.first_name = this.user.first_name;
    this.last_name = this.user.last_name;
    this.phone_number = this.user.phone_number;

    this.birthDate = moment(this.user.birth_date).format("Y-mM-DD")

  }
}
</script>

<style scoped>

</style>
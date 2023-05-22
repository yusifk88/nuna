<template>
  <ion-header color="primary">
    <ion-toolbar color="primary">
      <ion-title mode="ios">Where is the venue?</ion-title>
    </ion-toolbar>
    <ion-toolbar color="primary">

      <ion-row>
        <ion-col size="10">
          <vue-google-autocomplete

              id="map"
              classname="search-input"
              style="width: 100%; height: 50px; border: 0; background-color: #28b9b7; border-radius: 10px"
              placeholder="Enter name of place"
              v-on:placechanged="onPlaceChanged"
              :country="countryCodes"
              ref="address"
              types="establishment"
              :enableGeolocation="true"
          >
          </vue-google-autocomplete>
        </ion-col>
        <ion-col size="2">
          <ion-button @click="cancelSearch" class="no-padding">
            <ion-icon class="no-margin" size="large" :icon="closeOutline"></ion-icon>
          </ion-button>
        </ion-col>
      </ion-row>

    </ion-toolbar>
  </ion-header>
  <ion-content color="light">

  </ion-content>
</template>

<script>
import {IonButton, IonCol, IonContent, IonHeader, IonIcon, IonRow, IonTitle, IonToolbar} from "@ionic/vue";

import VueGoogleAutocomplete from "vue-google-autocomplete";
import {closeOutline} from "ionicons/icons";

export default {
  name: "GooglePlacesComponent",
  data() {
    return {
      closeOutline,
      placesAutocomplete: null,
      searchTerm: "",
      noResults: true
    }
  },
  components: {
    IonHeader,
    IonContent,
    IonToolbar,
    IonTitle,
    IonRow,
    IonCol,
    IonButton,
    IonIcon,
    VueGoogleAutocomplete
  },

  computed: {
    hasRecords() {

      const places = document.getElementsByClassName('pac-item').length;
      return places >0;

    },
    user() {

      return this.$store.state.user;
    },
    countryCodes() {
      if (this.user) {
        return [this.user.country_code.toLowerCase()]

      }


      return ['gh'];
    }
  },
  methods: {
    cancelSearch(){
      this.$emit("canceled");
    },
    onPlaceChanged(place) {
      this.$emit("placeSelected",place);
      this.$emit("canceled");
    }

  },
  mounted() {
    this.$refs.address.focus();
  }
}
</script>

<style>
.pac-container {

  width: 95% !important;
  margin-top: 20px;
  box-shadow: none;
  border: none;

}

.pac-item {

  padding: 10px;
  transition: 0.3s ease-in-out;

}

.pac-item:active {
  background-color: grey;

}

.pac-item:focus {
  background-color: grey;

}


.search-input {
  color: white;
  padding: 10px;

}

.search-input:focus {
  outline: none !important;
}

.search-input::placeholder {
  color: white;
  opacity: 0.7;
}

.maptiler-geocoder {
  width: 100% !important;
  border: none !important;
}

.maptiler-geocoder-results {
  margin-top: 10px !important;
  margin-left: 0 !important;
  margin-right: 0 !important;
  border: 0 !important;

}
</style>
<template>
  <ion-header color="primary">
    <ion-toolbar color="primary">
      <ion-title mode="ios">Where is the venue?</ion-title>
    </ion-toolbar>
    <ion-toolbar color="primary">


      <ion-searchbar
          :debounce="1000"
          :searchIcon="locationOutline"
          mode="ios"
          inputmode="search"
          ref="origin"
          show-cancel-button="always"
          show-clear-button="focus"
          @ionCancel="cancelSearch"
          @ionChange="resolvePlace($event)"
          id="placeInput"
          placeholder="Search for location...">
      </ion-searchbar>

    </ion-toolbar>
  </ion-header>
  <ion-content>


  </ion-content>
</template>

<script>
import {IonContent, IonHeader, IonTitle, IonToolbar, IonSearchbar} from "@ionic/vue";
import {locationOutline} from "ionicons/icons";

export default {
  name: "GooglePlacesComponent",
  data() {
    return {
      locationOutline,
      placesAutocomplete: null
    }
  },
  components: {
    IonHeader,
    IonContent,
    IonToolbar,
    IonTitle,
    IonSearchbar
  },
  methods: {
    cancelSearch() {
      this.$emit("canceled")
    },
    resolvePlace(e) {

      const ref = e.target.value;

      window.axios.get("https://api.locationiq.com/v1/autocomplete?key=pk.919099bf1235b89ff497014e3956f7e2&q=" + ref)
          .then(res => {
            console.log(res);
          })

    }

  },
  mounted() {


    // eslint-disable-next-line no-undef
    var geocoder = new maptiler.Geocoder({
      input: 'placeInput',
      key: '7RlnOzLa8P5hwn0Y4xw7',
      countryCode: "GH"
    });

    geocoder.on('select', function (item) {
      console.log('Selected', item);
    });

  }
}
</script>

<style>
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
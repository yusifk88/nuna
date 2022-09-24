<template>
  <ion-card mode="ios">
    <ion-card-header>
      <ion-button fill="outline"><ion-icon :icon="searchOutline"></ion-icon>Search location</ion-button>
    </ion-card-header>

    <capacitor-google-map id="map"></capacitor-google-map>

  </ion-card>

</template>

<script>
import {IonCard,IonCardHeader,IonButton,IonIcon} from "@ionic/vue";
import {searchOutline} from "ionicons/icons";
import {GoogleMap} from "@capacitor/google-maps";
import { Geolocation } from '@capacitor/geolocation';
export default {
  name: "MapsComponent",
  components:{IonCard,IonCardHeader,IonButton,IonIcon},
  data(){
    return{
      searchOutline
    }
  },
  methods:{
   async showMap(coords){
     console.log(coords);

      const key = "AIzaSyBJExB6dSJnyXPEPh0xmMx5UBX2tvMqXCk";

      const mapRef = document.getElementById('map');

      // eslint-disable-next-line @typescript-eslint/no-unused-vars
      const newMap = await GoogleMap.create({
        id: 'my-map', // Unique identifier for this map instance
        element: mapRef, // reference to the capacitor-google-map element
        apiKey: key, // Your Google Maps API Key
        config: {
          center: {
            // The initial position to be rendered by the map
            lat: coords.latitude,
            lng: coords.longitude,
          },
          zoom: 15, // The initial zoom level to be rendered by the map
        },
      });
    }
  },
  mounted() {


      const coordinates =  Geolocation.getCurrentPosition().then(position=>{
        this.showMap(position.coords);

      });

      console.log('Current position:', coordinates);

  }
}
</script>

<style scoped>
capacitor-google-map {
  display: inline-block;
  width: 100%;
  height: 400px;
}
</style>
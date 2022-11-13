<template>
  <ion-card mode="ios" class="no-margin">
    <GMapMap
        :center="center"
        :zoom="10"
        map-type-id="terrain"
        style="width: 100%; height: 300px"
    >
        <GMapMarker
            :key="index"
            v-for="(m, index) in markers"
            :position="m.position"
            :clickable="true"
            @click="center=m.position"
        />
    </GMapMap>
  </ion-card>

</template>

<script>
import {IonCard} from "@ionic/vue";

export default {
  props:{
    place:{
      type:Object
    }
  },
  name: "MapsComponent",
  components: {IonCard},
  data() {
    return {
      center: this.place,
      markers: [
        {
          position: this.place
        }
      ]
    }
  },


}
</script>

<style scoped>
capacitor-google-map {
  display: inline-block;
  width: 100%;
  height: 200px;
}
</style>
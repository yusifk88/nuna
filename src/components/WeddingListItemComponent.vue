<template>
  <ion-item>
    <ion-thumbnail slot="start">
      <img alt="wedding photo" :src="imgURL"/>

    </ion-thumbnail>

    <ion-label>
      <h1>{{ item.groom_name }} & {{ item.bride_name }}</h1>
      <h4>GHS200/GHS5,000</h4>
      <p>{{ item.date_time }}</p>
    </ion-label>
    <ion-icon color="success" v-if="item.public" :icon="globeOutline" slot="end"></ion-icon>
    <ion-icon class="text-muted" v-else :icon="cloudOfflineOutline" slot="end"></ion-icon>
  </ion-item>

</template>

<script>
import {IonIcon, IonItem, IonLabel, IonThumbnail} from "@ionic/vue";
import {globeOutline,closeCircleOutline, cloudOfflineOutline} from "ionicons/icons";

export default {
  props: {
    item: {
      type: Object
    }
  },
  components: {
    IonItem, IonLabel, IonThumbnail, IonIcon
  },
  name: "WeddingListItemComponent",
  data() {
    return {
      globeOutline,
      closeCircleOutline,
      cloudOfflineOutline
    }
  },
  computed: {
    imgURL() {
      if (this.item.photo_one) {

        return this.$store.state.baseURL + this.item.photo_one;

      } else if (this.item.photo_two) {

        return this.$store.state.baseURL + this.item.photo_two;

      } else if (this.item.photo_three) {

        return this.$store.state.baseURL + this.item.photo_three;

      } else if (this.item.photo_four) {

        return this.$store.state.baseURL + this.item.photo_four;

      } else {

        return "https://ionicframework.com/docs/img/demos/avatar.svg";

      }

    }
  }
}
</script>

<style scoped>

</style>
<template>
  <ion-item-sliding>

<!--    <ion-item-options side="start">-->

<!--      <ion-item-option v-if="!item.public" color="success">-->
<!--        <ion-icon :icon="globeOutline"></ion-icon>-->
<!--      </ion-item-option>-->

<!--      <ion-item-option v-else color="danger">-->
<!--        <ion-icon :icon="cloudOfflineOutline"></ion-icon>-->
<!--      </ion-item-option>-->


<!--      <ion-item-option>-->
<!--        Share <ion-icon :icon="shareOutline" style="font-size: 20px" ></ion-icon>-->

<!--      </ion-item-option>-->


<!--    </ion-item-options>-->

    <ion-item botton :detail="true" color="light" lines="none" style="margin: 5px">
      <ion-thumbnail slot="start">
        <img style="border-radius: 10px!important;" alt="wedding photo" :src="imgURL"/>

      </ion-thumbnail>

      <ion-label>
        <h1>{{ item.groom_name }} & {{ item.bride_name }}</h1>
        <h4>{{user.currency}}{{item.contributions_sum_amount}}/{{user.currency}}{{item.items_sum_target_amount}}</h4>
        <p class="text-muted">{{ weddingDate() }}</p>
      </ion-label>
      <ion-icon v-show="false" color="success" v-if="item.public" :icon="globeOutline" slot="end"></ion-icon>
      <ion-icon v-show="false" class="text-muted" v-else :icon="cloudOfflineOutline" slot="end"></ion-icon>
    </ion-item>

  </ion-item-sliding>

</template>

<script>
import {IonIcon, IonItem, IonItemSliding, IonLabel, IonThumbnail} from "@ionic/vue";
import {closeCircleOutline, cloudOfflineOutline, copyOutline, globeOutline,shareOutline} from "ionicons/icons";
import moment from "moment/moment";

export default {
  props: {
    item: {
      type: Object
    }
  },
  components: {
    IonItem, IonLabel, IonThumbnail, IonIcon, IonItemSliding
  },
  name: "WeddingListItemComponent",
  data() {
    return {
      globeOutline,
      closeCircleOutline,
      cloudOfflineOutline,
      copyOutline,
      shareOutline
    }
  },
  computed: {
    user(){
      return this.$store.state.user;
    },
    imgURL() {
      if (this.item.photo_one) {

        return  this.item.photo_one;

      } else if (this.item.photo_two) {

        return this.item.photo_two;

      } else if (this.item.photo_three) {

        return this.item.photo_three;

      } else if (this.item.photo_four) {

        return  this.item.photo_four;

      } else {

        return "https://ionicframework.com/docs/img/demos/avatar.svg";

      }

    }
  },

  methods:{
    weddingDate() {

      if (this.item) {


        return moment(this.item.created_at).format("Do MMMM, Y h:mm a");

      }

      return "";
    }
  }
}
</script>

<style scoped>

</style>
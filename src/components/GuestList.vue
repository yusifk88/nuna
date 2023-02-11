<template>

  <loading-component v-if="loading"></loading-component>
  <span v-else class="ion-padding-bottom">

  <no-record-component :show-button="false" title="No Guests Yet"
                       description="No one has indicated that they would be attending yet"
                       v-if="!items.length"></no-record-component>
  <ion-list style="margin-bottom: 60px" v-else>

    <ion-item v-for="(item,index) in items" :key="index">
      <ion-avatar class="ion-margin">

          <img src="https://ionicframework.com/docs/demos/api/avatar/avatar.svg" alt="Guest avatar"/>
      </ion-avatar>

      <ion-label>
        <h2>{{ item.name }}</h2>
        <p v-if="item.phone_number">{{ item.phone_number }}</p>
        <p v-if="item.email">{{ item.email }}</p>
      </ion-label>

      <small class="text-muted">{{ item.human_date }}</small>
    </ion-item>

  </ion-list>
      </span>

</template>

<script>
import axios from "axios";
import LoadingComponent from "@/components/loadingComponent";
import NoRecordComponent from "@/components/NoRecordComponent";
import {IonList, IonItem, IonLabel, IonAvatar} from "@ionic/vue";
import store from "@/store";

export default {
  props: {
    weddingID: {
      default: null
    }
  },
  name: "GuestList",
  components: {LoadingComponent, IonList, IonItem, IonLabel, NoRecordComponent, IonAvatar},
  data() {
    return {
      loading: false
    }
  },
  computed:{
    items(){
      return store.state.guestList;
    }
  },
  methods: {
    getGuests() {
      this.loading = true;
      const URL = this.weddingID ? "/guests-list?wedding_id=" + this.weddingID : "/guests-list";
      axios.get(URL)
          .then(res => {
            this.loading = false;
            store.state.guestList = res.data.data;
          })

    }
  },
  mounted() {
    this.getGuests();
  }
}
</script>

<style scoped>

</style>
<template>
  <p class="ion-margin-start" v-if="items.length">Contribution List</p>
  <list-loading-component v-if="loading" :count="8" :show-header=false></list-loading-component>
  <ion-list v-if="items.length && !loading" class="no-margin">

    <ion-item color="light" lines="none" style="margin: 5px" v-for="(item,index) in items" :key="index">

      <ion-icon class="gift-icon" :icon="giftOutline"></ion-icon>

      <ion-label>
        <h2>{{user.currency}}{{ item.amount }}</h2>
        <p>From {{ item.name }}</p>
      </ion-label>
      <small class="text-muted">{{ item.human_date }}</small>
    </ion-item>

  </ion-list>
  <no-record-component
      :show-button="wedding && wedding.items_sum_target_amount <=0"
      title="No gifts yet"
      description="No one has sent you a gift yet, Good luck 🤞."
      button-text="Add cash target"
      @buttonTapped="$emit('createNew')"
      :button-icon="addOutline"
      :show-icon="true"
      v-else-if="!items.length && !loading"
  ></no-record-component>
</template>

<script>
import axios from "axios";
import store from "@/store";
import {IonList, IonItem, IonLabel, IonIcon} from "@ionic/vue";
import {giftOutline,addOutline} from "ionicons/icons";
import ListLoadingComponent from "@/components/ListLoadingComponent";
import NoRecordComponent from "@/components/NoRecordComponent";

export default {
  name: "contributionList",
  props: {
    wedding: {
      type: Object,
    }
  },
  components: {NoRecordComponent, ListLoadingComponent, IonList, IonItem, IonLabel, IonIcon},

  data() {
    return {
      loading: false,
      giftOutline,
      addOutline
    }
  },
  computed: {
    items() {
      return store.state.contributionList;
    },
    user(){
      return this.$store.state.user;
    }
  },
  methods: {
    getContributions() {
      this.loading = true;
      const URL = this.wedding ? "/contributions/?wedding_id=" + this.wedding.id : "/contributions/";
      axios.get(URL)
          .then(res => {

            store.state.contributionList = res.data.data;

            this.loading = false;

          })
          .catch(error => {
            this.loading = false;


          });
    }
  },
  mounted() {
    this.getContributions();
  }
}
</script>

<style scoped>
.gift-icon {
  padding: 10px;
  border-radius: 20%;
  background-color: #2DD36F4A;
  margin: 5px;
  margin-left: 0 !important;
  color: #2dd36f;

}

</style>
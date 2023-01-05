<template>

  <loading-component v-if="loading"></loading-component>
  <span v-else>

  <no-record-component :show-button="false" title="No Activities Yet"
                       description="You do not have activities on your wedding page yet"
                       v-if="!items.length"></no-record-component>
  <ion-list class="no-margin" v-else>

    <ion-item  v-for="(item,index) in items" :key="index">
      <ion-icon v-if="item.type=='gift'" class="gift-icon" :icon="giftOutline"></ion-icon>
      <ion-icon v-if="item.type=='wish'" class="wish-icon" :icon="heartOutline"></ion-icon>
      <ion-icon v-if="item.type=='attendance'" class="attendance-icon" :icon="personAddOutline"></ion-icon>


      <ion-label>
        <h2>{{ item.title }}</h2>
        <p>{{ item.description }}</p>
        <p>{{item.human_date}}</p>
      </ion-label>
    </ion-item>

  </ion-list>
      </span>

</template>

<script>
import {IonIcon, IonItem, IonLabel, IonList} from "@ionic/vue";
import {giftOutline, heartOutline, personAddOutline} from "ionicons/icons";
import NoRecordComponent from "@/components/NoRecordComponent";
import LoadingComponent from "@/components/loadingComponent";
import axios from "axios";

export default {
  name: "dashbordRecentAcitivitiesComponent",
  components: {LoadingComponent, NoRecordComponent, IonList, IonItem, IonLabel, IonIcon},
  data() {
    return {
      giftOutline,
      heartOutline,
      personAddOutline,
      items: [],
      loading: false
    }
  },
  methods: {

    getActitvties() {
      this.loading = true;
      axios.get("/activities")
          .then(res => {
            console.log(res.data);
            this.items = res.data.data;
            this.loading = false;
          })
          .catch(() => {
            this.loading = false;
          })

    }
  },
  mounted() {

    this.getActitvties();
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

.wish-icon {
  padding: 10px;
  border-radius: 20%;
  background-color: #9C2DD342;
  margin: 5px;
  margin-left: 0 !important;
  color: #9c2dd3;

}

.attendance-icon {
  padding: 10px;
  border-radius: 20%;
  background-color: #FFD20051;
  margin: 5px;
  margin-left: 0 !important;
  color: #FFD200FF;

}


</style>
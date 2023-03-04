<template>
  <ion-page :fullscreen="true">
    <ion-header class="ion-no-border">
      <ion-toolbar>
        <ion-back-button slot="start"></ion-back-button>
        <ion-title>Notifications</ion-title>
      </ion-toolbar>
    </ion-header>
    <ion-content>
      <ion-refresher @ionRefresh="getNotifications($event)" slot="fixed">
        <ion-refresher-content></ion-refresher-content>
      </ion-refresher>

      <list-loading-component  :show-header="false" :count="5" v-if="loading"></list-loading-component>

      <span v-else>

  <no-record-component v-if="!items.length" :show-button="false"
                       description="You do not have activities on your wedding page yet"
                       title="No Activities Yet"></no-record-component>

  <ion-list v-else class="no-margin">

    <ion-item v-for="(item,index) in items" :key="index">
      <ion-icon v-if="item.type=='gift'" :icon="giftOutline" class="gift-icon"></ion-icon>
      <ion-icon v-if="item.type=='wish'" :icon="heartOutline" class="wish-icon"></ion-icon>
      <ion-icon v-if="item.type=='attendance'" :icon="personAddOutline" class="attendance-icon"></ion-icon>
      <ion-label>
        <h2>{{ item.title }}</h2>
        <p>{{ item.description }}</p>
        <p>{{ item.human_date }}</p>
      </ion-label>
    </ion-item>

  </ion-list>
      </span>


    </ion-content>


  </ion-page>

</template>

<script>
import noRecordComponent from "@/components/NoRecordComponent";
import loadingComponent from "@/components/loadingComponent";
import listLoadingComponent from "@/components/ListLoadingComponent";
import {
  IonPage,
  IonHeader,
  IonToolbar,
  IonTitle,
  IonBackButton,
  IonContent,
  IonList,
  IonItem,
  IonIcon,
  IonLabel,
    IonRefresher,
    IonRefresherContent
} from "@ionic/vue";
import {giftOutline, heartOutline, personAddOutline} from "ionicons/icons";

export default {
  name: "NotificationsPage",
  components: {
    IonPage,
    IonHeader,
    IonToolbar,
    IonTitle,
    IonBackButton,
    IonContent,
    IonList,
    IonItem,
    IonIcon,
    IonLabel,
    listLoadingComponent,
    noRecordComponent,
    IonRefresher,
    IonRefresherContent
  },
  data() {
    return {
      items: [],
      loading: false,
      giftOutline, heartOutline, personAddOutline
    }
  },
  methods: {
    getNotifications(e) {
      this.loading = true;
      window.axios.get("/notifications")
          .then(res => {
            this.items = res.data.data.notifications.data;
            this.loading=false;
            if (e) {
              e.target.complete();
            }

          })

    }
  },
  mounted() {
    this.getNotifications();
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
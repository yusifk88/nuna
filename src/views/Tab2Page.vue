<template>
  <ion-page>
    <ion-header mode="ios">
      <ion-toolbar mode="ios">
        <ion-title>My Registries</ion-title>
      </ion-toolbar>
    </ion-header>
    <ion-content :fullscreen="true" class="ion-padding-bottom">

      <ion-refresher @ionRefresh="getRegostries($event)" slot="fixed">
        <ion-refresher-content></ion-refresher-content>
      </ion-refresher>

      <ion-header collapse="condense">
        <ion-toolbar>
          <ion-title size="large">My Registries</ion-title>
        </ion-toolbar>
      </ion-header>
      <list-loading-component :show-header="false" :count="5" v-if="loading"></list-loading-component>

      <span v-else>

      <no-record-component
          title="You have not created any registries yet"
          description="Your registries would show here. You can create your first registry by taping on the create registry button."
          button-text="Create your first registry"
          @buttonTapped="NoRecordButtonTapped"
          :show-icon="true"
          v-if="!items.length"
      ></no-record-component>

      <ion-list v-else>
        <wedding-list-item-component
            v-for="item in items" :key="item.id" :item="item"
            @click="$router.push({path:'/event/wedding/'+item.id})"
        ></wedding-list-item-component>
      </ion-list>



      </span>

      <ion-fab mode="ios" v-if="items && items.length" @click="$router.push({path:'/new/wedding'})" id="open-modal" vertical="bottom" class="ion-margin"
               horizontal="end" slot="fixed">
        <ion-fab-button mode="ios">
          <ion-icon :icon="addOutline"></ion-icon>
        </ion-fab-button>
      </ion-fab>


    </ion-content>
  </ion-page>
</template>

<script>
import {defineComponent} from 'vue';
import {
  IonContent,
  IonFab,
  IonFabButton,
  IonHeader,
  IonIcon,
  IonList,
  IonPage,
  IonRefresher,
  IonRefresherContent,
  IonTitle,
  IonToolbar
} from '@ionic/vue';
import {addOutline} from "ionicons/icons";

import NoRecordComponent from "@/components/NoRecordComponent";
import axios from "axios";
import WeddingListItemComponent from "@/components/WeddingListItemComponent";
import ListLoadingComponent from "@/components/ListLoadingComponent";

export default defineComponent({
  name: 'Tab2Page',
  components: {
    ListLoadingComponent,
    WeddingListItemComponent,
    IonList,
    NoRecordComponent,
    IonHeader,
    IonToolbar,
    IonTitle,
    IonContent,
    IonPage,
    IonRefresher,
    IonRefresherContent,
    IonFab,
    IonFabButton,
    IonIcon,



  },

  data() {

    return {
      items: [],
      addOutline,
      loading: false
    }

  },

  methods: {
    getRegostries(e) {

      this.loading = true;

      axios.get("/weddings")
          .then(res => {
            this.items = res.data.data;
            this.loading = false;
            if (e) {
              e.target.complete();
            }

          })

    }
    ,

    NoRecordButtonTapped() {
      this.$router.push({
        path: "/new/wedding"
      });

    }
  }
  ,
  mounted() {
    this.getRegostries();
  }
})

</script>

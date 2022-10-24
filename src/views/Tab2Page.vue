<template>
  <ion-page>
    <ion-header>
      <ion-toolbar>
        <ion-title>Your Registries</ion-title>
      </ion-toolbar>
    </ion-header>
    <ion-content :fullscreen="true" class="ion-padding-bottom">

      <ion-refresher @ionRefresh="getRegostries($event)" slot="fixed">
        <ion-refresher-content></ion-refresher-content>
      </ion-refresher>

      <ion-header collapse="condense">
        <ion-toolbar>
          <ion-title size="large">Your Registries</ion-title>
        </ion-toolbar>
      </ion-header>

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
        ></wedding-list-item-component>
      </ion-list>


      <ion-fab id="open-modal" vertical="bottom" class="ion-margin" horizontal="end" slot="fixed">
        <ion-fab-button>
          <ion-icon :icon="addOutline"></ion-icon>
        </ion-fab-button>
      </ion-fab>

      <ion-modal
          :initial-breakpoint="0.4"
          :breakpoints="[0.4, 0.5, 0.75]"
          handle-behavior="cycle"
          mode="ios"
          ref="modal"
          trigger="open-modal"
      >
        <ion-content>

          <ion-header>
            <ion-toolbar>
              <ion-title>Create a registry</ion-title>
            </ion-toolbar>
          </ion-header>

          <get-started-component class="ion-margin"></get-started-component>
        </ion-content>

      </ion-modal>

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
  IonModal,
  IonPage,
  IonRefresher,
  IonRefresherContent,
  IonTitle,
  IonToolbar,
} from '@ionic/vue';
import {addOutline} from "ionicons/icons";

import NoRecordComponent from "@/components/NoRecordComponent";
import axios from "axios";
import WeddingListItemComponent from "@/components/WeddingListItemComponent";
import GetStartedComponent from "@/components/getStartedComponent";

export default defineComponent({
  name: 'Tab2Page',
  components: {
    GetStartedComponent,
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
    IonModal

  },

  data() {

    return {
      items: [],
      addOutline
    }

  },

  methods: {
    getRegostries(e) {

      this.$store.state.mainLoadingText = "Hung on...";
      this.$store.state.mainLoadingDescription = "We are getting your registries...";
      this.$store.state.mainLoading = true;

      axios.get("/weddings")
          .then(res => {
            this.items = res.data.data;
            this.$store.state.mainLoading = false;
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

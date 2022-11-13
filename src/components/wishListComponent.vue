<template>
  <ion-content :fullscreen="true" class="no-padding">

    <list-loading-component :count="5" :show-header="false" v-if="loading"></list-loading-component>
    <span v-else>

    <no-record-component
        show-icon
        :button-icon="addOutline"
        button-text="Add Item" title="You have not added items yet"
        description="Add items to your wish list so your love ones can help you out"
        @buttonTapped="newItem=true"
        class="ion-margin-top"
        v-if="!items.length"
    ></no-record-component>

      <ion-list>
     <wish-list-item
         v-for="item in items"
         :key="item.id"
         :item="item"
     ></wish-list-item>

      </ion-list>


    <ion-modal
        :initial-breakpoint="initState"
        :breakpoints="[0, 0.25,0.3, 0.5,0.6, 0.75,1]"
        mode="ios"
        :is-open="newItem"
        :swipeToClose="true"
        @willDismiss="newItem=false;"
        ref="itemModal"
    >
      <new-wish-list-item
          @itemSaved="itemWasCreated"
          :wedding-i-d="weddingID"
          @stepUp="stepUp"

          @canceled="canDismiss=true;newItem=false"></new-wish-list-item>

    </ion-modal>
    </span>


    <ion-fab slot="fixed" vertical="bottom" horizontal="end" v-if="items && items.length">
      <ion-fab-button @click="newItem=true">
        <ion-icon :icon="addOutline"></ion-icon>
      </ion-fab-button>
    </ion-fab>

  </ion-content>
</template>

<script>

import {IonContent, IonFab, IonFabButton, IonIcon, IonList, IonModal,} from "@ionic/vue";
import {addOutline} from "ionicons/icons";
import NoRecordComponent from "@/components/NoRecordComponent";
import NewWishListItem from "@/components/newWishListItem";
import ListLoadingComponent from "@/components/ListLoadingComponent";
import WishListItem from "@/components/WishListItem";
import axios from "axios";

export default {
  props: {
    weddingID: {
      type: Number
    }
  },
  name: "wishListComponent",
  components: {
    WishListItem,
    ListLoadingComponent,
    NewWishListItem,
    NoRecordComponent,
    IonContent,
    IonModal,
    IonList,
    IonFab,
    IonFabButton,
    IonIcon
  },
  data() {
    return {
      initState: 0.3,
      addOutline,
      newItem: false,
      presentingElement: undefined,
      canDismiss: false,
      loading: false,
      items: []
    }
  },
  methods: {
    itemWasCreated() {

      this.getItems();
      this.newItem = false;

    },
    getItems() {
      this.loading = true;
      axios.get("/wishlist/" + this.weddingID)
          .then(res => {

            this.items = res.data.data;

            this.loading = false;

          })
          .catch(error => {
            this.loading = false;


          });
    },
    stepUp(state) {

      this.$refs.itemModal.$el.setCurrentBreakpoint(state)
    }
  },
  mounted() {
    this.getItems();
  }
}
</script>

<style scoped>

</style>
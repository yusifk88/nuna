<template>
  <ion-header>
    <ion-toolbar>
      <ion-button @click="step=1;$emit('stepUp',0.25)" v-if="step>1" slot="start" size="small" fill="clear"
                  color="primary">Change
      </ion-button>

      <ion-title>Add item to wishlist</ion-title>
      <ion-button @click="$emit('canceled')" slot="end" size="small" fill="clear" color="medium">Cancel</ion-button>
    </ion-toolbar>

  </ion-header>
  <ion-content>
    <div v-if="step==1" class="smooth-in">


      <ion-row>
        <ion-col size="6">

          <ion-card @click="step=3; $emit('stepUp',1)" color="tertiary" mode="ios">
            <ion-card-content class="ion-text-center">

              <ion-icon size="large" :icon="addOutline"></ion-icon>

              <h1> Add Item</h1>
            </ion-card-content>
          </ion-card>


        </ion-col>

        <ion-col size="6">
          <ion-card @click="step=2; $emit('stepUp',0.6)" color="success" mode="ios">
            <ion-card-content class="ion-text-center">

              <sup>
                <ion-icon size="small" :icon="addOutline"></ion-icon>
              </sup>
              <ion-icon size="large" :icon="cashOutline"></ion-icon>

              <h1> Add Cash</h1>
            </ion-card-content>
          </ion-card>
        </ion-col>


      </ion-row>

    </div>


    <div v-if="step==2" class="smooth-in ion-padding ion-text-center">
      <sup>
        <ion-icon size="small" :icon="addOutline"></ion-icon>
      </sup>
      <ion-icon size="large" :icon="cashOutline"></ion-icon>
      <h1>Add Cash</h1>
      <p class="text-muted ion-padding">Add cash to your wishlist so your loved ones can help you by contributing</p>
      <ion-list class="ion-margin-bottom">

        <ion-item shape="round" fill="outline" class="ion-margin-bottom">
          <ion-label>
            GHS
          </ion-label>
          <ion-input :disabled="saving" v-model="cash.amount" inputmode="decimal"
                     placeholder="Target Amount"></ion-input>
        </ion-item>

      </ion-list>

      <ion-button
          :expand="saving ? '' : 'block'"
          style="transition: 0.3s ease-in-out"
          size="large"
          shape="round"
          color="primary"
          class="ion-margin-top"
          :disabled="!cash.amount || saving"
          @click="saveCash"
      >
        <span v-if="!saving">Add to Wishlist</span>
        <ion-spinner name="dots" v-else></ion-spinner>
      </ion-button>

    </div>


    <div
        v-if="step==3"
        class="smooth-in ion-padding ion-margin ion-text-center"
    >

      <ion-icon size="large" :icon="addOutline"></ion-icon>

      <h1> Add Item</h1>
      <p class="text-muted ion-padding">Add an item to your wishlist so your loved ones can help you buy it</p>


      <ion-row>
        <ion-col size="2">

        </ion-col>

        <ion-col size="8">
          <thumbnail-component @photoSelected="photoSelected" style="height: 200px"></thumbnail-component>

        </ion-col>
        <ion-col size="2">

        </ion-col>

      </ion-row>


      <ion-list>

        <ion-item shape="round" fill="outline" class="ion-margin-top">
          <ion-label>
            GHS
          </ion-label>
          <ion-input :disabled="saving" v-model="item.amount" inputmode="decimal" placeholder="Price"></ion-input>
        </ion-item>

        <ion-item shape="round" fill="outline" class="ion-margin-top">
          <ion-input :disabled="saving" v-model="item.name" inputmode="text" placeholder="Name*"></ion-input>
        </ion-item>

        <ion-item shape="round" fill="outline" class="ion-margin-top">
          <ion-textarea :disabled="saving" v-model="item.description" rows="2" :autoGrow="true"
                        placeholder="Description"></ion-textarea>
        </ion-item>

      </ion-list>
      <ion-button
          :expand="saving ? '' : 'block'"
          style="transition: 0.3s ease-in-out"
          size="large"
          shape="round"
          color="primary"
          class="ion-margin-top ion-margin-bottom"
          :disabled="(!item.amount && item.name) || saving"
          @click="saveItem"
      >
        <span v-if="!saving">Add to Wishlist</span>
        <ion-spinner name="dots" v-else></ion-spinner>
      </ion-button>

    </div>

  </ion-content>
</template>

<script>

import {
  IonButton,
  IonCard,
  IonCardContent,
  IonCol,
  IonContent,
  IonHeader,
  IonIcon,
  IonInput,
  IonItem,
  IonLabel,
  IonList,
  IonRow,
  IonSpinner,
  IonTextarea,
  IonTitle,
  IonToolbar
} from "@ionic/vue";
import {addOutline, cashOutline} from "ionicons/icons";
import ThumbnailComponent from "@/components/thumbnailComponent";
import axios from "axios";

export default {

  props: {

    weddingID: {
      type: Number
    }

  },
  components: {
    IonSpinner,
    IonTextarea,
    ThumbnailComponent,
    IonList,
    IonHeader,
    IonContent,
    IonToolbar,
    IonTitle,
    IonButton,
    IonRow,
    IonCol,
    IonCard,
    IonCardContent,
    IonIcon,
    IonItem,
    IonLabel,
    IonInput
  },
  name: "newWishListItem",
  data() {
    return {
      cashOutline,
      addOutline,
      step: 1,
      photo: null,
      cash: {
        amount: 0,
        type: "cash",
        name: "cash",
        description: ""
      },
      item: {
        amount: 0,
        type: "item",
        name: "",
        description: ""
      },
      saving: false
    }
  },
  methods: {

    photoSelected(file) {

      this.photo = file.file;


    },

    saveCash() {
      this.saving = true;
      const formData = new FormData();
      formData.append("name", this.cash.name);
      formData.append("amount", this.cash.amount);
      formData.append("description", this.cash.description);
      formData.append("type", "cash");

      axios.post("/wishlist/" + this.weddingID, formData)
          .then(res => {

            this.$emit("itemSaved");

            this.saving = false;

          })
          .catch(error => {

            this.saving = false;


          })
    },

    saveItem() {
      this.saving = true;
      const formData = new FormData();
      formData.append("name", this.item.name);
      formData.append("amount", this.item.amount);
      formData.append("description", this.item.description);
      formData.append("type", "item");
      formData.append("photo", this.photo);

      axios.post("/wishlist/" + this.weddingID, formData)
          .then(res => {
            this.saving = false;

            this.$emit("itemSaved");

          })
          .catch(error => {

            this.saving = false;


          })
    }


  }
}
</script>

<style scoped>
@keyframes slide-in {
  0% {
    opacity: 0;
    transform: translateX(250px);
  }

  100% {
    opacity: 1;
    transform: translateX(0);
  }
}

.font-weight-light {
  font-weight: lighter;
}


.smooth-in {
  animation: slide-in 0.3s ease-in-out 0s 1 normal forwards;
}

</style>
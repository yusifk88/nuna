<template>

  <ion-button id="deleteDialog" mode="ios" class="ion-margin" color="danger" fill="outline" expand="block" shape="round"
              size="large">Delete
  </ion-button>
  <ion-modal
      ref="Deletemodal"
      :breakpoints="[0, 0.3, 0.5]"
      :initial-breakpoint="0.3"
      handle-behavior="cycle"
      mode="ios"
      trigger="deleteDialog"
  >
    <ion-card-content>
      <h1 class="ion-text-center font-weight-light" style="color: red">Deleting a wedding registry will delete your
        contributions and any other record related to the wedding page.</h1>
      <ion-button @click="deleteWedding" :disabled="deleting" color="danger" shape="round" mode="ios" fill="solid"
                  expand="block" class="ion-margin" size="large">
        Yes, Delete
        <ion-spinner v-if="deleting"></ion-spinner>
      </ion-button>
    </ion-card-content>
  </ion-modal>
</template>

<script>
import {IonButton, IonCardContent, IonModal, IonSpinner} from "@ionic/vue";
import {defineComponent} from 'vue'
import axios from "axios";
import store from "@/store";

export default defineComponent({
  props: {
    weddingID: {
      type: Number
    }
  },
  name: "weddingControlsComponent",
  components: {IonModal, IonButton, IonCardContent, IonSpinner},
  data() {
    return {
      deleting: false
    }
  },
  methods: {
    deleteWedding() {

      this.deleting = true;

      const URL = "/weddings/" + this.weddingID;

      axios.delete(URL)
          .then(() => {
            this.deleting = false;
            this.$emit("done");

            this.$refs.Deletemodal.$el.dismiss(null, 'cancel');

            this.$router.push("/")

            store.commit("initUser");


          })
          .catch(() => {
            this.deleting = false;
          })

    }
  }
})
</script>

<style scoped>

</style>
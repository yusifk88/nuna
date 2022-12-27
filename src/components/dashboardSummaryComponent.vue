<template>
  <ion-row>
    <ion-col size="6">

      <ion-card
          mode="ios"
          class="no-margin"
          color="primary"
          style="background-image: url('/assets/patternpad.png'); background-size: contain; background-blend-mode: darken;"

      >
        <ion-card-header>
          <ion-card-subtitle>
           Total Guests
          </ion-card-subtitle>
        </ion-card-header>
        <ion-card-content>

          <ion-row>
            <ion-col size="8">

              <h1 class="font-weight-bold">300</h1>
            </ion-col>
            <ion-col size="4">
              <ion-icon size="large" :icon="peopleOutline"></ion-icon>
            </ion-col>
          </ion-row>

        </ion-card-content>
      </ion-card>
    </ion-col>
    <ion-col size="6">

      <ion-card
          mode="ios"
          class="no-margin"
          color="success"
          style="background-image: url('/assets/patternpad.png'); background-size: contain; background-blend-mode: darken;"

      >
        <ion-card-header>
          <ion-card-subtitle>
            Contributors
          </ion-card-subtitle>
        </ion-card-header>
        <ion-card-content>

          <ion-row>
            <ion-col size="8">

              <h1 class="font-weight-bold">30</h1>
            </ion-col>
            <ion-col size="4">
              <ion-icon size="large" :icon="peopleOutline"></ion-icon>
            </ion-col>
          </ion-row>

        </ion-card-content>
      </ion-card>

    </ion-col>
  </ion-row>

</template>

<script>
import {IonCard, IonCardContent, IonCardHeader, IonCardSubtitle, IonCol, IonRow,IonIcon} from "@ionic/vue";
import {peopleOutline,cashOutline,cartOutline} from "ionicons/icons";

export default {
  name: "dashboardSummaryComponent",
  components: {IonRow, IonCol, IonCard, IonCardSubtitle, IonCardHeader, IonCardContent,IonIcon},
  data() {
    return {
      peopleOutline,
      cashOutline,
      cartOutline
    }
  }
}
</script>

<style scoped>

.green-gradient{

  background: #56ab2f;  /* fallback for old browsers */
  background: -webkit-linear-gradient(to right, #a8e063, #56ab2f);  /* Chrome 10-25, Safari 5.1-6 */
  background: linear-gradient(to right, #a8e063, #56ab2f); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */



}


</style>
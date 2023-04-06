<template>
  <ion-row>
    <ion-col size="6">

      <ion-card
          mode="ios"
          class="no-margin"
          style="background-color: rgba(0,128,128,0.2); border: 2px solid #008080FF;"
          @click="$emit('guestTapped')"

      >

        <ion-card-content class="ion-text-center">



              <h1 class="font-weight-bold" style="color: teal">{{dashboard ? dashboard.guest : 0}} <ion-icon size="small" :icon="peopleOutline"></ion-icon></h1>
              <small class="text-muted">Total Guests</small>



        </ion-card-content>
      </ion-card>
    </ion-col>
    <ion-col size="6">

      <ion-card
          @click="$emit('contributionTapped')"
          mode="ios"
          class="no-margin"
          style="background-color: rgba(45,211,111,0.19); color: #2dd36f; border: 2px solid #2dd36f;"

      >

        <ion-card-content class="ion-text-center">



          <h1 class="font-weight-bold">{{dashboard ? dashboard.contributions : 0}} <ion-icon size="small" :icon="peopleOutline"></ion-icon></h1>

          <small class="text-muted">Contributions</small>


        </ion-card-content>
      </ion-card>

    </ion-col>
  </ion-row>

</template>

<script>
import {IonCard, IonCardContent, IonCol, IonRow,IonIcon} from "@ionic/vue";
import {peopleOutline,cashOutline,cartOutline} from "ionicons/icons";

export default {
  name: "dashboardSummaryComponent",
  components: {IonRow, IonCol, IonCard, IonCardContent,IonIcon},
  props:{
    dashboard:{
      type:Object
    }
  },
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
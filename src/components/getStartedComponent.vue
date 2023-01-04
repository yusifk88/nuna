<template>
<ion-row>
  <ion-col size="12" class="no-padding">

    <no-record-component
        title="You have no registries yet"
        description="Your account is currently empty, create your first wedding registry page."
        button-text="Create registry"
        :button-icon="arrowForwardOutline"
        show-icon
        @buttonTapped="NoRecordButtonTapped"
    ></no-record-component>

  </ion-col>

</ion-row>
</template>

<script>
import {addCircleOutline,arrowForwardOutline} from "ionicons/icons";
import {IonRow,IonCol} from "@ionic/vue";
import NoRecordComponent from "@/components/NoRecordComponent";

export default {
  name: "getStartedComponent",
  components:{NoRecordComponent, IonRow,IonCol},
  data(){
    return{
      addCircleOutline,
      arrowForwardOutline

    }
  },
  methods:{
    NoRecordButtonTapped() {
      this.$router.push({
        path: "/new/wedding"
      });

    }
  }
}
</script>

<style>
.no-padding{
  padding: 0!important;
}
.no-margin{
  margin: 2px!important;
}

</style>
<template>
<ion-content :fullscreen="true" class="no-padding">

  <no-record-component show-icon :button-icon="addOutline" button-text="Add Item" title="You have not added items yet" description="Add items to your wish list so your love ones can help you out "></no-record-component>
</ion-content>
</template>

<script>
import {IonContent} from "@ionic/vue";
import {addOutline} from "ionicons/icons";
import NoRecordComponent from "@/components/NoRecordComponent";

export default {
  name: "wishListComponent",
  components:{NoRecordComponent, IonContent},
  data(){
    return{
      addOutline
    }
  }
}
</script>

<style scoped>

</style>
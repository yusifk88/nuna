<template>
  <ion-list :animated="true" >
    <ion-list-header v-if="ShowHeader">
      <ion-skeleton-text :animated="true" style="width: 80px"></ion-skeleton-text>
    </ion-list-header>
    <ion-item v-for="i in count" :key="i">
      <ion-thumbnail slot="start">
        <ion-skeleton-text :animated="true"></ion-skeleton-text>
      </ion-thumbnail>
      <ion-label>
        <h3>
          <ion-skeleton-text :animated="true" style="width: 80%;"></ion-skeleton-text>
        </h3>
        <p>
          <ion-skeleton-text :animated="true" style="width: 60%;"></ion-skeleton-text>
        </p>
        <p>
          <ion-skeleton-text :animated="true" style="width: 30%;"></ion-skeleton-text>
        </p>
      </ion-label>
    </ion-item>
  </ion-list>

</template>

<script>
import {IonItem, IonLabel, IonList, IonListHeader, IonSkeletonText, IonThumbnail} from "@ionic/vue";

export default {
  props:{
    count:{
      type:Number,
      default:1
    },
    ShowHeader:{
      type:Boolean,
      default:true
    }
  },
  name: "ListLoadingComponent",
  components: {
    IonLabel,
    IonListHeader,
    IonThumbnail,
    IonItem,
    IonList,
    IonSkeletonText
  }
}
</script>

<style scoped>

</style>
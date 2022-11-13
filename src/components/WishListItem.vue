<template>
  <ion-item>
    <ion-thumbnail slot="start">
      <img :alt="'photo of '+item.name"
           :src="item.type!='cash' ? $store.state.baseURL+item.img_url : 'https://objectstorage.uk-london-1.oraclecloud.com/n/lrj6a9vl4is6/b/MyBucket/o/icons8-money-transfer-96.png'"/>
    </ion-thumbnail>
    <ion-label>
      <h1>GHS{{ item.amount_contributed }}/GHS{{ item.target_amount }}</h1>
      <h2>{{ item.name }}</h2>
      <p>{{ item.description }}</p>
    </ion-label>
  </ion-item>

</template>

<script>
import {IonItem,IonThumbnail,IonLabel} from "@ionic/vue";

export default {
  props:{
    item:{
      type:Object
    }
  },
  name: "WishListItem",
  components:{IonItem,IonThumbnail,IonLabel}
}
</script>

<style scoped>

</style>
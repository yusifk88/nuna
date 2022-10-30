<template>
  <ion-list class="no-margin">

    <ion-item :detail="true" v-for="(item,index) in items" :key="index">
      <ion-icon v-if="item.type=='gift'" class="gift-icon" :icon="giftOutline"></ion-icon>
      <ion-icon v-if="item.type=='wish'" class="wish-icon" :icon="heartOutline"></ion-icon>
      <ion-icon v-if="item.type=='attendance'" class="attendance-icon" :icon="personAddOutline"></ion-icon>


      <ion-label>
        <h2>{{ item.title }}</h2>
        <p>{{ item.description }}</p>
      </ion-label>
    </ion-item>

  </ion-list>
</template>

<script>
import {IonIcon, IonItem, IonLabel, IonList} from "@ionic/vue";
import {giftOutline,heartOutline,personAddOutline} from "ionicons/icons";

export default {
  name: "dashbordRecentAcitivitiesComponent",
  components: {IonList, IonItem, IonLabel, IonIcon},
  data() {
    return {
      giftOutline,
      heartOutline,
      personAddOutline,
      items: [
        {
          title: "Yusif Contributed",
          description: "Yusif has contributed GHS2,000 to your electric stove wish",
          type: "gift"
        },
        {
          title: "Rosemary's Wish",
          description: "I wish you an everlasting union and a happy home",
          type: "wish"
        },
        {
          title: "Issac would be present",
          description: "Issac has indicated that they would be attending your wedding",
          type: "attendance"
        },


      ]
    }
  }
}
</script>

<style scoped>


.gift-icon {
  padding: 10px;
  border-radius: 20%;
  background-color: #2DD36F4A;
  margin: 5px;
  margin-left: 0 !important;
  color:#2dd36f;

}

.wish-icon {
  padding: 10px;
  border-radius: 20%;
  background-color: #9C2DD342;
  margin: 5px;
  margin-left: 0 !important;
  color: #9c2dd3;

}
.attendance-icon {
  padding: 10px;
  border-radius: 20%;
  background-color: #FFD20051;
  margin: 5px;
  margin-left: 0 !important;
  color: #FFD200FF;

}


</style>
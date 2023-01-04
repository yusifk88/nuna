<template>
  <ion-page>
    <ion-tabs>
      <ion-router-outlet v-if="!$store.state.initApp" ></ion-router-outlet>

      <ion-tab-bar :translucent="true" slot="bottom" v-if="!$store.state.initApp">

        <ion-tab-button tab="tab1" href="/tabs/tab1">
          <ion-icon :icon="homeOutline" />
          <ion-label>Home</ion-label>
        </ion-tab-button>
          
        <ion-tab-button tab="tab2" href="/tabs/tab2">
          <ion-icon :icon="listOutline" />
          <ion-label>Registries</ion-label>
        </ion-tab-button>
        
<!--        <ion-tab-button tab="tab3" href="/tabs/tab3">-->
<!--          <ion-icon :icon="readerOutline" />-->
<!--          <ion-label>Feeds</ion-label>-->
<!--        </ion-tab-button>-->

      </ion-tab-bar>
    </ion-tabs>
  </ion-page>
</template>

<script lang="ts">
import { defineComponent } from 'vue';
import { IonTabBar, IonTabButton, IonTabs, IonLabel, IonIcon, IonPage, IonRouterOutlet } from '@ionic/vue';
import { square,homeOutline,listOutline,readerOutline } from 'ionicons/icons';

export default defineComponent({
  name: 'TabsPage',
  components: { IonLabel, IonTabs, IonTabBar, IonTabButton, IonIcon, IonPage, IonRouterOutlet },
  setup() {
    return {
      listOutline,
      square, 
      homeOutline,
      readerOutline

    }
  }

});
</script>

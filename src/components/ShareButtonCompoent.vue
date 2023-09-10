<template>

  <ion-button @click="startShare" expand="full" fill="solid" color="warning" size="large" shape="round" mode="ios">Share Now!</ion-button>

</template>
<script lang="ts">
import {defineComponent} from 'vue'
import {IonButton} from "@ionic/vue";
import {Share} from "@capacitor/share";
import {Device} from "@capacitor/device";
import {star} from "ionicons/icons";

export default defineComponent({
  name: "ShareButtonCompoent",
  components: {IonButton},
  methods:{
    star() {
      return star
    },

    async startShare() {

      const info = await Device.getInfo();

      let link = "https://mynunaa.com";

      if (info) {

        if (info.platform === "android") {

          link = "https://play.google.com/store/apps/details?id=com.nuna.app";

        }

        if (info.platform === "ios") {

          link = "https://apps.apple.com/gh/app/nuna-digital-wedding-page-app/id6449852115";

        }

      }

      this.shareApp(link);


    },

    async shareApp(link: string) {

      await Share.share({
        title: "Show Nuna with a friend",
        text: "Hi, download Nuna to create and share your digital wedding page. With Nuna you can track your guest and receive gifts from friends and family ",
        url: link,
        dialogTitle: 'Share Nuna with friend',
      });

    },
  }
})
</script>


<style scoped>

</style>
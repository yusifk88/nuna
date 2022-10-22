<template>
  <ion-thumbnail @click="selectPhoto">
    <ion-icon color="white" style="position: absolute; margin: 20px; font-size: 20px; color: #ffffff !important;" :icon="addCircleOutline"></ion-icon>
    <img alt="Silhouette of mountains"
         :src="preview"/>
  </ion-thumbnail>

  <input @change="selectedPhoto($event)" style="display: none" :id="'selector'+uuid" type="file" accept="image/*">
</template>

<script>
import {IonThumbnail,IonIcon} from "@ionic/vue";
import {addCircleOutline} from "ionicons/icons";
export default {
  props:["uuid"],
  name: "thumbnailComponent",
  components:{IonThumbnail,IonIcon},
  data(){
    return{
      addCircleOutline,
      preview:"https://objectstorage.uk-london-1.oraclecloud.com/n/lrj6a9vl4is6/b/MyBucket/o/istockphoto-1147544807-612x612.jpeg"
    }
  },
  methods:{
    selectedPhoto(e){

      const files =e.target.files[0];

      const fr = new FileReader();
      fr.readAsDataURL(files);
      fr.onload=()=>{
        this.preview = fr.result;

        this.$emit("photoSelected",{file:files,preview:this.preview});

      }
    },
    selectPhoto(){
      const selector = "selector"+this.uuid;

      document.getElementById(selector).click();

    }

  }
}
</script>

<style scoped>
ion-thumbnail {
  --size: 100%;
  --border-radius: 14px;
}
</style>
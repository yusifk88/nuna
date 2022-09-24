<template>
  <ion-thumbnail @click="selectPhoto">
    <ion-icon color="white" style="position: absolute; margin: 20px; font-size: 20px; color: #ffffff !important;" :icon="addCircleOutline"></ion-icon>
    <img alt="Silhouette of mountains"
         src="https://objectstorage.uk-london-1.oraclecloud.com/n/lrj6a9vl4is6/b/MyBucket/o/istockphoto-1147544807-612x612.jpeg"/>
  </ion-thumbnail>
</template>

<script>
import {IonThumbnail,IonIcon} from "@ionic/vue";
import {addCircleOutline} from "ionicons/icons";
import {ImagePicker} from "@awesome-cordova-plugins/image-picker";
export default {
  name: "thumbnailComponent",
  components:{IonThumbnail,IonIcon},
  data(){
    return{
      addCircleOutline
    }
  },
  methods:{
    selectPhoto(){

      ImagePicker.getPictures({
        allow_video:false,
        maximumImagesCount:1,
        title:"Select a wedding photo",
      }).then(res=>{

        console.log(res);

      });

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
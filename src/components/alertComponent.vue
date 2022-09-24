<template>
  <div :class="color" class="ion-text-left alert">
    <h2>{{title}}</h2>
   <p v-html="description"></p>
  </div>
</template>

<script>
export default {
  props:{
    title:{type:String},
    description:{type:String},
    color:{
      type:String,
      default:"alert-primary"
    }
  },
  name: "alertComponent"
}
</script>

<style scoped>
.alert-primary{

  padding: 10px;
  background-color: rgba(47, 177, 175, 0.25);
  color: #2fb1af;
}

</style>
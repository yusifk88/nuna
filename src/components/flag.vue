<template>
  <span style="margin-left: 30px; margin-top: 13px" :class="' fi fi-'+iso.toLowerCase()"></span>
</template>

<script>
export default {
  props:["iso"],
  // eslint-disable-next-line vue/multi-word-component-names
  name: "flag"
}
</script>

<style scoped>

</style>
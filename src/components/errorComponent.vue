<template>
  <ion-toast
      :is-open="$store.state.showErrorToast"
      :message="errorMessage"
      :duration="5000"
      @didDismiss="hideToast"
      :position="$store.state.ErrorPosition"
      color="danger"
      :icon="warningOutline"

  ></ion-toast>
</template>

<script>
import {IonToast} from "@ionic/vue";
import {warningOutline} from "ionicons/icons";

export default {
  name: "errorComponent",
  components: {IonToast},
  data() {
    return {
      warningOutline

    }
  },
  computed: {
    errorMessage() {
      if (this.$store.state.errorsArr) {
        const keys = Object.keys(this.$store.state.errorsArr);
        let message = "";
        if (keys.length) {

          keys.forEach(key => {

            if (!message) {
              message = this.$store.state.errorsArr[key][0] + '\n';

            } else {
              message += this.$store.state.errorsArr[key][0] + '\n';
            }
          })
        } else {
          message = "Something went wrong, could not process request";
        }

        return message;
      }
      return "Something went wrong";

    }
  },
  methods: {
    hideToast() {
      this.$store.state.showErrorToast = false;
    }
  }
}
</script>

<style scoped>

</style>
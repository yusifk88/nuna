<template>
  <ion-content class="no-padding">

    <small v-if="wedding && wedding.items_sum_target_amount >0 " class="text-muted">All Time</small>
    <h3 v-if="wedding && wedding.items_sum_target_amount >0">
      {{user.currency}}{{ !wedding ? 0 : wedding.contributions_sum_amount }}/{{user.currency}}{{
        !wedding ? 0 : wedding.items_sum_target_amount
      }}</h3>
    <ion-progress-bar v-if="wedding && wedding.items_sum_target_amount >0" color="success" :value="percent"
                      style="height: 10px; border-radius: 5px"></ion-progress-bar>


    <!--    <ion-segment-->
    <!--        mode="ios"-->
    <!--        color="success"-->
    <!--        :value="defaultSegment"-->
    <!--        :scrollable="true"-->
    <!--        class="no-margin ion-margin-top"-->
    <!--        style="margin-top: 30px !important;"-->
    <!--    >-->

    <!--      <ion-segment-button @click="defaultSegment='1d'" value="1d">-->
    <!--        1D-->
    <!--      </ion-segment-button>-->

    <!--      <ion-segment-button @click="defaultSegment='1m'" value="1m">-->
    <!--        1M-->
    <!--      </ion-segment-button>-->

    <!--      <ion-segment-button @click="defaultSegment='6m'" value="6m">-->
    <!--        6M-->
    <!--      </ion-segment-button>-->

    <!--      <ion-segment-button @click="defaultSegment='max'" value="max">-->
    <!--        MAX-->
    <!--      </ion-segment-button>-->
    <!--    </ion-segment>-->

    <!--    <ion-card class="no-margin no-padding">-->

    <!--      <ion-card-header>-->
    <!--        <ion-card-title>GHS6,000.00</ion-card-title>-->
    <!--        <ion-card-subtitle class="text-muted">{{ filterName }}(32 Contributions)</ion-card-subtitle>-->
    <!--      </ion-card-header>-->

    <!--      <apexchart class="no-margin" type="bar" height="160" :options="chartOptions" :series="series"></apexchart>-->

    <!--    </ion-card>-->


  <contribution-list @createNew="newItem=true" :wedding="wedding"></contribution-list>


    <ion-modal
        :initial-breakpoint="initState"
        :breakpoints="[0,0.5]"
        mode="ios"
        :is-open="newItem"
        :swipeToClose="true"
        @willDismiss="newItem=false;"
        ref="itemModal"
    >
      <new-wish-list-item
          @itemSaved="itemWasCreated"
          :wedding-i-d="weddingID"
          @stepUp="stepUp"
          @canceled="newItem=false"></new-wish-list-item>

    </ion-modal>

  </ion-content>

</template>

<script>
import {addOutline} from "ionicons/icons";

import NewWishListItem from "@/components/newWishListItem";
import {IonContent, IonModal, IonProgressBar} from "@ionic/vue";

import {giftOutline} from "ionicons/icons";

import ContributionList from "@/components/contributionList";


export default {
  props: {
    wedding: {
      type: Object
    },
    weddingID: {
      type: Number
    }
  },
  name: "CashTargetComponent",
  data() {
    return {
      addOutline,
      initState: 0.5,
      newItem: false,
      defaultSegment: '1d',
      giftOutline,
      loading:false,
      items: [],
      series: [{
        name: "Contribution",
        data: [2000, 3000, 1000, 400, 20, 5000, 7000]
      }],
      chartOptions: {

        grid: {
          show: false
        },
        theme: {
          mode: 'light',
          palette: 'palette5',
          monochrome: {
            enabled: false,
            color: '#255aee',
            shadeTo: 'light',
            shadeIntensity: 0.65
          },
        },
        chart: {
          toolbar: {
            show: false
          },
          type: 'area',
          zoom: {
            enabled: false
          }
        },
        dataLabels: {
          enabled: false
        },
        stroke: {
          curve: 'smooth'
        },

        labels: ["7AM", "9AM", "10AM", "11AM", "1PM", "2PM", "3PM"],
        xaxis: {
          type: 'text',

        },
        yaxis: {
          show: false,

        },
        legend: {
          show: false
        }
      },


    }
  },
  computed: {
    user(){
      return this.$store.state.user;
    },
    percent() {

      if (!this.wedding) {
        return 0;

      }
      if (this.wedding.contributions_sum_amount <= 0) {
        return 0;
      }

      return this.wedding.contributions_sum_amount / this.wedding.items_sum_target_amount;

    },


    filterName() {
      if (this.defaultSegment == "1d") {
        return "1 Day"

      }

      if (this.defaultSegment == "1m") {
        return "1 Month"

      }

      if (this.defaultSegment == "6m") {
        return "6 Months"

      }

      if (this.defaultSegment == "max") {
        return "All time"

      }

      return "All time"


    }
  },
  methods: {

    stepUp(state) {

      this.$refs.itemModal.$el.setCurrentBreakpoint(state)
    },
    itemWasCreated(item) {

      this.newItem = false;
      this.$emit("cashAdded");
    }
  },

  components: {
    ContributionList,
    IonContent,
    IonProgressBar,
    IonModal,
    NewWishListItem

  },
}
</script>

<style scoped>



ion-card {

  background-color: #CCCCCC17;

}

</style>
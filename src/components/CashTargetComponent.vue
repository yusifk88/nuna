<template>
  <ion-content class="no-padding">

    <small class="text-muted">ALl Time</small>
    <h3>GHS6,000.00/GHS10,000.00</h3>
    <ion-progress-bar color="success" value="0.8" style="height: 10px; border-radius: 5px"></ion-progress-bar>


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

    <h2>Contributions</h2>

    <ion-list class="no-margin">

      <ion-item v-for="(item,index) in items" :key="index">

        <ion-icon class="gift-icon" :icon="giftOutline"></ion-icon>

        <ion-label>
          <h2>GHS{{ item.amount }}</h2>
          <p>From {{ item.name }}</p>
        </ion-label>
        <small class="text-muted">{{item.create_at}}</small>
      </ion-item>

    </ion-list>

  </ion-content>

</template>

<script>
import {
  IonCard,
  IonCardHeader,
  IonCardSubtitle,
  IonCardTitle,
  IonContent,
  IonSegment,
  IonSegmentButton,
    IonList,
    IonItem,
    IonLabel,
    IonIcon,
    IonProgressBar
} from "@ionic/vue";

import {giftOutline} from "ionicons/icons";


export default {
  props: {
    weddingID: {
      type: Number
    }
  },
  name: "CashTargetComponent",
  data() {
    return {
      defaultSegment: '1d',
      giftOutline,
      items: [
        {
          name: "Yusif Katulie",
          type: "gift",
          amount: 200,
          create_at: "1m ago"
        },
        {
          name: "Romary Kwofie",
          type: "gift",
          amount: 400,
          create_at: "5h ago"
        }
        ,
        {
          name: "Collins",
          type: "gift",
          amount: 1000,
          create_at: "2d ago"
        }

      ],
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
  components: {
    IonContent,
    IonSegment,
    IonSegmentButton,
    IonCard,
    IonCardHeader,
    IonCardSubtitle,
    IonCardTitle,
    IonList,
    IonItem,
    IonLabel,
    IonIcon,
    IonProgressBar

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

ion-card {

  background-color: #CCCCCC17;

}

</style>
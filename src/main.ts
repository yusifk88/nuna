import {createApp} from 'vue'
import App from './App.vue'
import router from './router';
import axios from "axios";

import {IonicVue} from '@ionic/vue';

/* Core CSS required for Ionic components to work properly */
import '@ionic/vue/css/core.css';
import "/node_modules/flag-icons/css/flag-icons.min.css";
/* Basic CSS for apps built with Ionic */
import '@ionic/vue/css/normalize.css';
import '@ionic/vue/css/structure.css';
import '@ionic/vue/css/typography.css';

/* Optional CSS utils that can be commented out */
import '@ionic/vue/css/padding.css';
import '@ionic/vue/css/float-elements.css';
import '@ionic/vue/css/text-alignment.css';
import '@ionic/vue/css/text-transformation.css';
import '@ionic/vue/css/flex-utils.css';
import '@ionic/vue/css/display.css';
import VueApexCharts from "vue3-apexcharts";

import VueGoogleMaps from '@fawmi/vue-google-maps'
import OneSignal from 'onesignal-cordova-plugin';

/* Theme variables */
import './theme/variables.css';
// eslint-disable-next-line @typescript-eslint/ban-ts-comment
// @ts-ignore
import store from './store';

// eslint-disable-next-line @typescript-eslint/ban-ts-comment
// @ts-ignore

const app = createApp(App)
    .use(store)
    .use(IonicVue)
    .use(VueApexCharts)
    .use(VueGoogleMaps, {
        load: {
            key: 'AIzaSyDlKd1XANeleo81umo7SdNW2cn5w32f8iM',
        },
        autobindAllEvents: true
    })
    .use(router);


function OneSignalInit(): void {
    // Uncomment to set OneSignal device logging to VERBOSE
    OneSignal.setLogLevel(6, 0);

    // NOTE: Update the setAppId value below with your OneSignal AppId.
    OneSignal.setAppId("c45edfd9-b1eb-4a14-a715-31ed1de6d715");

    OneSignal.setNotificationOpenedHandler(function (jsonData) {

        console.log('notificationOpenedCallback: ' + JSON.stringify(jsonData));

    });


    if (store.state.user && store.state.user.email.length > 0) {

        // eslint-disable-next-line @typescript-eslint/no-var-requires
        const {v4: uuidv4} = require('uuid');

        const UUID = uuidv4();

        OneSignal.setEmail(store.state.user.email);
        OneSignal.setSMSNumber(store.state.user.phone_number);

        OneSignal.setExternalUserId(UUID);

        console.log(UUID);


    }


    OneSignal.getDeviceState(deviceState => {

        if (deviceState.subscribed) {

            axios.post("/set-user-push-id", {user_id: deviceState.userId})

        }

    });


    // OneSignal.addSubscriptionObserver(state => {
    //
    //     console.log(state);
    //
    // });

    // Prompts the user for notification permissions.
    //    * Since this shows a generic native prompt, we recommend instead using an In-App Message to prompt for notification permission (See step 7) to better communicate to your users what notifications they will get.
    OneSignal.promptForPushNotificationsWithUserResponse(function (accepted) {
        console.log(accepted);
    });


}

document.addEventListener("deviceready", OneSignalInit, false);


router.isReady().then(() => {


    // eslint-disable-next-line @typescript-eslint/ban-ts-comment
    // @ts-ignore
    // OneSignal.addSubscriptionObserver().subscribe((state) => {
    //
    //     if (!state.from.subscribed && state.to.subscribed) {
    //         console.log("Subscribed for OneSignal push notifications! :: ID "+state.to.userId);
    //     }
    //     window.alert(JSON.stringify(state));
    // });

    // eslint-disable-next-line @typescript-eslint/ban-ts-comment
    // @ts-ignore
    window.axios = axios;
    // eslint-disable-next-line @typescript-eslint/ban-ts-comment
    // @ts-ignore
    window.axios.defaults.baseURL = store.state.baseURL + "/api/";
    // eslint-disable-next-line @typescript-eslint/ban-ts-comment
    // @ts-ignore
    window.axios.defaults.headers.common = {
        "X-Requested-With": "XMLHttpRequest",
        "Content-Type": "application/json",
        "Authorization": "Bearer " + localStorage.token
    };
// eslint-disable-next-line @typescript-eslint/ban-ts-comment
    // @ts-ignore
    window.axios.defaults.headers.get["Accept"] = "application/json";
    // eslint-disable-next-line @typescript-eslint/ban-ts-comment
    // @ts-ignore
    window.axios.defaults.headers.post["Accept"] = "application/json";
    // eslint-disable-next-line @typescript-eslint/ban-ts-comment
    // @ts-ignore
    window.axios.defaults.headers.post["Content-Type"] = "application/json";
    axios.interceptors.response.use(
        function (response) {


            return response;
        },
        function (error) {

            if (error.response.status !== 401) {

                store.state.errorsArr = error.response.data.errors;
                store.state.showErrorToast = true;
            }

            return Promise.reject(error);
        }
    );


    app.mount('#app');

    store.commit("initUser");


});
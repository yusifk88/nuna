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

import VueGoogleMaps from '@fawmi/vue-google-maps'

/* Theme variables */
import './theme/variables.css';
// eslint-disable-next-line @typescript-eslint/ban-ts-comment
// @ts-ignore
import Vuelidate from 'vuelidate'

import store from './store';

// eslint-disable-next-line @typescript-eslint/ban-ts-comment
// @ts-ignore

const app = createApp(App)
    .use(store)
    .use(IonicVue)
    .use(VueGoogleMaps, {
        load: {
            key: 'AIzaSyDlKd1XANeleo81umo7SdNW2cn5w32f8iM',
        },
        autobindAllEvents: true
    })
    .use(router);

router.isReady().then(() => {

    // eslint-disable-next-line @typescript-eslint/ban-ts-comment
    // @ts-ignore
    window.axios = axios;
    // eslint-disable-next-line @typescript-eslint/ban-ts-comment
    // @ts-ignore
    window.axios.defaults.baseURL = "http://127.0.0.1:8000/api/";
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

            store.state.errorsArr = error.response.data.errors;
            store.state.showErrorToast = true;

            return Promise.reject(error);
        }
    );


    app.mount('#app');

    store.commit("initUser");

});
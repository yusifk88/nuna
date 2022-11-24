import {createStore} from 'vuex'
import axios from "axios";
import router from "@/router";

export default createStore({
    state: {
        showErrorToast: false,
        errorMessage: "Something went wrong",
        errorsArr: [],
        user: null,
        weddings:[],
        initApp: false,
        ErrorPosition:"bottom",
        headerTransparent:false,
        mainLoading:false,
        mainLoadingText:"Please wait",
        mainLoadingDescription:"",
        baseURL:"http://127.0.0.1:8000"
    },
    mutations: {
        initUser(state) {
            state.initApp = true;

            axios.get("/user")
                .then(res => {
                    state.user = res.data;
                    state.initApp = false;

                })
                .catch(error => {
                    if (error.response.status == 401) {
                        router.push("/login");
                    }
                    state.initApp = false;


                })


        }

    },
    actions: {},
    modules: {}
})

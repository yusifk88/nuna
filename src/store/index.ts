import {createStore} from 'vuex'
import axios from "axios";
import router from "@/router";

export default createStore({
    state: {
        networkConnected:true,
        showStart: false,
        showErrorToast: false,
        errorMessage: "Something went wrong",
        errorsArr: [],
        guestList:[],
        contributionList:[],
        user: {
            email:"",
            phone_number:""

        },
        weddings: [],
        initApp: false,
        ErrorPosition: "bottom",
        headerTransparent: false,
        mainLoading: false,
        mainLoadingText: "Please wait",
        mainLoadingDescription: "",
        baseURLALT: "http://127.0.0.1:8000",
        baseURL: "https://mynunaa.com"
    },
    mutations: {
        initUser(state) {
            if (!localStorage.getItem("showstart")) {
                state.showStart = true;
            }
            state.initApp = true;

            axios.get("/user")
                .then(res => {
                    state.user = res.data;
                    state.initApp = false;

                })
                .catch(error => {
                    if (error.response.status == 401) {
                        state.mainLoading = false;
                        router.push("/login");
                    }
                    state.initApp = false;


                })


        }  ,
        initUserSilent(state) {
            if (!localStorage.getItem("showstart")) {
                state.showStart = true;
            }

            axios.get("/user")
                .then(res => {
                    state.user = res.data;

                })
                .catch(error => {
                    if (error.response.status == 401) {
                        state.mainLoading = false;
                        router.push("/login");
                    }
                    state.initApp = false;


                })


        }

    },
    actions: {},
    modules: {}
})

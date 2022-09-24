import {createStore} from 'vuex'
import axios from "axios";
import router from "@/router";

export default createStore({
    state: {
        showErrorToast: false,
        errorMessage: "Something went wrong",
        errorsArr: [],
        user: null,
        initApp: false
    },
    mutations: {
        initUser(state) {
            state.initApp = true;

            axios.get("/user")
                .then(res => {
                    state.user = res.data;
                    state.initApp = false;
                    console.log(state.user)

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

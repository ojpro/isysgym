import Vuex from 'vuex'
import {axios} from "../services/axios/config";

const store = new Vuex.Store({
    state: {
        // State to check if the app already installed
        installed: JSON.parse(localStorage.getItem('installed'))
    },
    mutations: {
        // Set the installation state
        setInstallState: (state, payload) => localStorage.setItem('installed',payload)
    },
    actions: {
        fetchInstallState: ({commit}) => {
            // Fetch Installation State from the Backend
            axios.get('/install').then(({data}) => {
                // If there is response that's mean that the app not installed yet
                commit('setInstallState', data);

            }).catch(({response}) => {
                // other ways if is it a 403 that's mean the app already installed.
                if (response.status === 403) {
                    commit('setInstallState', true)
                }
            })
        }
    },
    getters: {
        isInstalled: (state) => state.installed
    }
})

export default store
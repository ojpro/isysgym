import Vuex from 'vuex'
import {axios} from "../services/axios/config";
import localforage from 'localforage'

const store = new Vuex.Store({
    state: {
        // State to check if the app already installed
        installed: await localforage.getItem('installed') || false
    },
    mutations: {
        // Set the installation state
        setInstallState(state, payload) {
            localforage.setItem('installed', payload).then(data => {
                state.installed = payload
            })
        }
    },
    actions: {
        fetchInstallState: ({commit}) => {
            // Fetch Installation State from the Backend
            axios.get('/install').then(_ => {
                // If there is response that's mean that the app not installed yet
                commit('setInstallState', false);

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
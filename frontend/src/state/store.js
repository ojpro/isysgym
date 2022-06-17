import localforage from 'localforage'
import Vuex from 'vuex'
import {axios} from "../services/axios/config";

const store = new Vuex.Store({
    state: {
        //TODO: stop using the localforage for sensitive data
        // State to check if the app already installed
        installed: await localforage.getItem('installed') || false,
        // Toggle Dashboard sidebar menu
        openSidebar: true,
        // GYM data
        gym_id: await localforage.getItem('gym_id'),
        // Save User ID
        userId: await localforage.getItem('user_id'),
    },
    mutations: {
        // Set the installation state
        setInstallState(state, payload) {
            localforage.setItem('installed', payload).then(data => {
                state.installed = payload
            })
        },

        // Toggle Sidebar
        toggleSidebar(state) {
            state.openSidebar = !state.openSidebar
        },

        // set app data
        setGymID(state, payload) {
            localforage.setItem('gym_id', payload).then(data => {
                state.gym_id = payload
            })
        },
        // set User ID
        setUserID(state, payload) {
            localforage.setItem('user_id', payload).then(data => {
                state.userId = payload
            })
        },
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
        },

        toggleSidebar: ({commit}) => {
            commit('toggleSidebar')
        },

        setGymId: (({commit},data) => {
            commit('setGymID',data)
        }),

        setUserID: (({commit},id) => {
            commit('setUserID', id)
        })
    },
    getters: {
        isInstalled: (state) => state.installed
    }
})

export default store
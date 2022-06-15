// axios configuration

import Axios from 'axios'

const axios = Axios.create({
    baseURL: import.meta.env.VITE_BASE_URL,
    responseType: 'json',
    //TODO: show a loader when starting a request
    timeout: 100000
})

export {axios}
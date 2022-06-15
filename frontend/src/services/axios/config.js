// axios configuration

import Axios from 'axios'

const axios = Axios.create({
    baseURL: 'http://gym.test/api',
    responseType: 'json',
    //TODO: show a loader when starting a request
    timeout: 100000
})

export {axios}
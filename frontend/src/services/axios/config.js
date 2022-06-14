// axios configuration

import Axios from 'axios'

const axios = Axios.create({
    baseURL: 'http://gym.test/api',
    responseType: 'json',
    timeout: 10000
})

export {axios}
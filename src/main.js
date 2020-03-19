// import Vue from 'vue'
// import App from './App.vue'

// new Vue({
//   el: '#app',
//   render: h => h(App)
// })


import Vue from 'vue';
import VueMeta from 'vue-meta'
import App from './App.vue';
import { router } from "./router";
Vue.use(VueMeta);

new Vue({
  el: '#app',
  render: h => h(App),
  router,
  data: {
    // server_url: window.location.origin
    server_url: 'http://localhost'
  }
});

console.log('v1.2',window.location.origin);

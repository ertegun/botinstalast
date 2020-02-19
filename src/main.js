// import Vue from 'vue'
// import App from './App.vue'

// new Vue({
//   el: '#app',
//   render: h => h(App)
// })


import Vue from 'vue';
import App from './App.vue';
import { router } from "./router";

new Vue({
  el: '#app',
  render: h => h(App),
  router
});
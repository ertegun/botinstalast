import Vue from "vue";
import VueRouter from "vue-router";

import Home from "./components/Home";
import About from "./components/About";
import Contact from "./components/Contact";
import Post from "./components/Post";

Vue.use(VueRouter);

const routes = [
  { path: "/", component: Home },
  { path: "/about", component: About },
  { path: "/contact", component: Contact },
  { path: "/post/:mid", component: Post }
];

export const router = new VueRouter({
  mode: "history",
  routes
});
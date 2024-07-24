import { createApp, ref } from "vue";
import App from "./App.vue";
import Dashboard from "./Dashboard.vue";

import { createVuetify } from "vuetify";
import * as components from "vuetify/components";
import * as directives from "vuetify/directives";
// import App from "./App.vue";
import "vuetify/styles";
import "bootstrap/dist/css/bootstrap.min.css";
import "bootstrap/dist/js/bootstrap.bundle.min.js";
import { createRouter, createWebHashHistory } from "vue-router";
import VueApexCharts from "vue3-apexcharts";
import ApexCharts from "apexcharts";
import User from "./pages/User.vue";
import UserDetail from "./pages/UserDetail.vue";

// Add this when into a TypeScript codebase
declare module "@vue/runtime-core" {
  interface ComponentCustomProperties {
    $apexcharts: typeof ApexCharts;
  }
}

export const ctx = ref({
  drawer: false,
  rail: true,
  items: [
    {
      title: "Foo",
      value: "foo",
      prependIcon: "mdi-home",
    },
    {
      title: "Bar",
      value: "bar",
      prependIcon: "mdi-home",
    },
    {
      title: "Fizz",
      value: "fizz",
      prependIcon: "mdi-home",
    },
    {
      title: "Buzz",
      value: "buzz",
      prependIcon: "mdi-home",
    },
  ],
});

const routes = [
  { path: "/", component: Dashboard },
  { path: "/user", component: User },
  { path: "/user/:id", component: UserDetail },

  // { path: '/about', component: AboutView },
];

const router = createRouter({
  history: createWebHashHistory(),
  routes,
});

const vuetify = createVuetify({
  components,
  directives,
});

const app = createApp(App);

app.config.globalProperties.$apexcharts = ApexCharts;

app.use(router).use(vuetify).use(VueApexCharts).mount("#app");

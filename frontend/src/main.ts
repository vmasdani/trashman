import { createApp, ref } from "vue";
// import "./style.css";
import App from "./App.vue";
import { createVuetify } from "vuetify";
// import { aliases, mdi } from "vuetify/iconsets/mdi";

import "bootstrap/dist/css/bootstrap.min.css";
import "bootstrap/dist/js/bootstrap.bundle.min.js";

import * as components from "vuetify/components";
import * as directives from "vuetify/directives";

export const ctx = ref({
  drawer: false,
  items: [
    {
      title: "Foo",
      value: "foo",
    },
    {
      title: "Bar",
      value: "bar",
    },
    {
      title: "Fizz",
      value: "fizz",
    },
    {
      title: "Buzz",
      value: "buzz",
    },
  ],
});

const vuetify = createVuetify({
  components,
  directives,
  
});

createApp(App).use(vuetify).mount("#app");

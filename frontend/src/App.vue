<template>
  <v-card>
    <v-layout>
      <Navbar />

      <MainComponent />
    </v-layout>
  </v-card>
</template>

<script setup>
import { ref, watch } from "vue";
import Navbar from "./Navbar.vue";
import MainComponent from "./MainComponent.vue";

const items = [
  {
    title: "Foo",
    value: "foo",
    prependIcon: 'mdi-home'
  },
  {
    title: "Bar",
    value: "bar",
    prependIcon: 'mdi-home'
  },
  {
    title: "Fizz",
    value: "fizz",
    prependIcon: 'mdi-home'
  },
  {
    title: "Buzz",
    value: "buzz",
    prependIcon: 'mdi-home'
  },
];

const drawer = ref(false);
const group = ref(null);

watch(group, () => {
  drawer.value = false;
});
</script>

<script>
export default {
  data: () => ({
    drawer: false,
    group: null,
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
  }),

  watch: {
    group() {
      this.drawer = false;
    },
  },
};
</script>

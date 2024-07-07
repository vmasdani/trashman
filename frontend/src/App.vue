<template>
  <v-card>
    <v-layout>
      <Navbar />

      <MainComponent />
    </v-layout>
  </v-card>
</template>

<script setup lang="ts">
import Navbar from "./Navbar.vue";
import MainComponent from "./MainComponent.vue";
</script>

<script lang="ts">
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

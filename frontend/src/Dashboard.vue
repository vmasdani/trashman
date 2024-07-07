<script setup lang="ts">
import GenericApexRadial from "./components/GenericApexRadial.vue";
</script>
<template>
  <div class="p-3" style="background-color: lightgray; min-height: 100vh">
    <div class="d-flex flex-wrap w-100">
      <div
        class="d-flex flex-wrap p-3 m-2 bg-light shadow shadow-md rounded rounded-lg flex-grow-1"
        style="min-height: 15vh"
      >
        <GenericApexRadial text="PET" :percentage="50" :color="`#ffa500`" />
        <GenericApexRadial text="HDPE" :percentage="56" :color="`#ee82ee`" />
        <GenericApexRadial text="PVC" :percentage="78" :color="`#0000ff`" />
        <GenericApexRadial text="LDPE" :percentage="41" :color="`#6a5acd`" />
        <GenericApexRadial text="PP" :percentage="33" :color="`#3cb371`" />
        <GenericApexRadial text="PS" :percentage="29" :color="`#787878`" />
        <GenericApexRadial text="Others" :percentage="12" :color="`#ffd347`" />
      </div>
    </div>

    <div class="d-flex flex-wrap w-100">
      <div
        class="p-3 m-2 rounded shadow shadow-md rounded-lg flex-grow-1 text-light"
        style="min-height: 15vh; min-width: 30vh; background-color: green"
      >
        <div>
          <h4>{{ Intl.NumberFormat("en-US").format(1728000) }}</h4>
        </div>
        <div><strong>Kgs Extracted</strong></div>
      </div>
      <div
        class="p-3 m-2 rounded shadow shadow-md rounded-lg flex-grow-1 text-light"
        style="min-height: 15vh; min-width: 30vh; background-color: gray"
      >
        <div>
          <h4>{{ Intl.NumberFormat("en-US").format(1728000) }}</h4>
        </div>
        <div><strong>Bottles Prevented</strong></div>
      </div>
      <div
        class="p-3 m-2 rounded shadow shadow-md rounded-lg flex-grow-1 text-light"
        style="min-height: 15vh; min-width: 30vh; background-color: blueviolet"
      >
        <div>
          <h4>{{ Intl.NumberFormat("en-US").format(1728000) }}</h4>
        </div>
        <div><strong>People Impacted</strong></div>
      </div>
    </div>
  </div>
</template>

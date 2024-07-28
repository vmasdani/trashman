<script setup lang="ts">
import { ref } from "vue";
import { useRoute, useRouter } from "vue-router";
import { fetchMaterial,  } from "../fetchers";

const route = useRoute();
const router = useRouter();
const user = ref({} as any);

const handleSave = async () => {
  try {
    await fetch(`${import.meta.env.VITE_APP_BASE_URL}/api/materials`, {
      method: "post",
      headers: { "content-type": "application/json" },
      body: JSON.stringify(user.value),
    });

    router.push("/material");
  } catch (e) {
    console.error(e);
  }
};

const handleFetchMaterial = async () => {
  const d = await fetchMaterial({ id: parseInt(route?.params?.id as string) });

  if (d) {
    user.value = d;
  }
};

const init = () => {
  if (!isNaN(parseInt(route?.params?.id as string))) {
    handleFetchMaterial();
  }
};

init();
</script>

<template>
  <div class="m-3 container">
    <div class="d-flex">
      <h3>User Detail: {{ route.params?.id }}</h3>
      <button
        class="btn btn-sm btn-primary"
        @click="
          () => {
            handleSave();
          }
        "
      >
        <v-icon icon="mdi-content-save" /> Save
      </button>
    </div>
    <hr class="border border-dark" />

    <div><strong>Name</strong></div>
    <div>
      <input
        class="form-control form-control-sm"
        placeholder="Name..."
        :value="user?.name"
        @blur="(e) => {
          user.name = (e.target as HTMLInputElement).value
        }"
      />
    </div>
  </div>
</template>

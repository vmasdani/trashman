<script setup lang="ts">
import { ref } from "vue";
import { useRoute, useRouter } from "vue-router";

const route = useRoute();
const router = useRouter();
const user = ref({} as any);

const handleSave = async () => {
  try {
    const resp = await fetch(`${import.meta.env.VITE_APP_BASE_URL}/api/users`, {
      method: "post",
      headers: { "content-type": "application/json" },
      body: JSON.stringify(user.value),
    });

    router.push("/user");
  } catch (e) {
    console.error(e);
  }
};
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

    <div><strong>MP</strong></div>
    <div>
      <input class="form-control form-control-sm" placeholder="Name..." />
    </div>
    <div><strong>Name</strong></div>
    <div>
      <input
        class="form-control form-control-sm"
        placeholder="Name..."
        @blur="(e) => {
          user.name = (e.target as HTMLInputElement).value
        }"
      />
    </div>
    <div><strong>Email</strong></div>
    <div>
      <input
        class="form-control form-control-sm"
        placeholder="Name..."
        @blur="(e) => {
          user.email = (e.target as HTMLInputElement).value
        }"
      />
    </div>
    <div><strong>Phone</strong></div>
    <div>
      <input
        class="form-control form-control-sm"
        placeholder="Name..."
        @blur="(e) => {
          user.phone = (e.target as HTMLInputElement).value
        }"
      />
    </div>
    <div><strong>Role</strong></div>
    <div>
      <input class="form-control form-control-sm" placeholder="Name..." />
    </div>
    <div><strong>Gender</strong></div>
    <div>
      <input class="form-control form-control-sm" placeholder="Name..." />
    </div>
    <div><strong>Country</strong></div>
    <div>
      <input class="form-control form-control-sm" placeholder="Name..." />
    </div>
    <div><strong>Province</strong></div>
    <div>
      <input class="form-control form-control-sm" placeholder="Name..." />
    </div>
    <div><strong>Regency</strong></div>
    <div>
      <input class="form-control form-control-sm" placeholder="Name..." />
    </div>
    <div><strong>District</strong></div>
    <div>
      <input class="form-control form-control-sm" placeholder="Name..." />
    </div>
    <div><strong>Address</strong></div>
    <div>
      <textarea
        class="form-control form-control-sm"
        placeholder="Name..."
        @blur="(e) => {
          user.address = (e.target as HTMLInputElement).value
        }"
      />
    </div>
    <div><strong>Latitude</strong></div>
    <div>
      <input
        class="form-control form-control-sm"
        placeholder="Name..."
        @blur="(e) => {
          user.latitude = isNaN(parseFloat((e.target as HTMLInputElement).value))
            ? undefined
            : parseFloat((e.target as HTMLInputElement).value) 
        }"
      />
    </div>
    <div><strong>Longitude</strong></div>
    <div>
      <input
        class="form-control form-control-sm"
        placeholder="Name..."
        @blur="(e) => {
          user.longitude = isNaN(parseFloat((e.target as HTMLInputElement).value))
            ? undefined
            : parseFloat((e.target as HTMLInputElement).value)
        }"
      />
    </div>
    <div><strong>Member Type</strong></div>
    <div>
      <input class="form-control form-control-sm" placeholder="Name..." />
    </div>
    <div><strong>Family ID</strong></div>
    <div>
      <input class="form-control form-control-sm" placeholder="Name..." />
    </div>
  </div>
</template>

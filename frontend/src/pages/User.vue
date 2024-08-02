<script setup lang="ts">
import { ref } from "vue";
import { fetchUsers } from "../fetchers";

const users = ref([] as any[]);

const handleFetchUsers = async () => {
  const d = await fetchUsers();
  users.value = d;
};

handleFetchUsers();

const handleDelete = async (id: any) => {
  if (!window.confirm("Confirm delete?")) {
    return;
  }

  try {
     await fetch(
      `${import.meta.env.VITE_APP_BASE_URL}/api/users/${id}`,
      { method: "delete" }
    );

    window.location.reload();
  } catch (e) {
    alert("Delete failed.");
    return;
  }
};
</script>

<template>
  <div class="m-3">
    <div><h3>Users</h3></div>
    <hr class="border border-dark" />
    <div class="d-flex my-2 justify-content-end">
      <div>
        <input class="form-control form-control-sm" placeholder="Search..." />
      </div>
      <div>
        <a href="/#/user/new"
          ><button class="btn btn-sm btn-primary">
            <v-icon icon="mdi-plus"></v-icon> Add
          </button></a
        >
      </div>
    </div>
    <div
      class="overflow-auto border border-dark shadow shadow-md rounded rounded-md"
      style="height: 75vh; resize: vertical"
    >
      <table class="table table-sm" style="border-collapse: separate">
        <tr>
          <th
            style="position: sticky; top: 0"
            class="bg-dark text-light"
            v-for="h in [
              '#',
              'MP',
              'Name',
              'Email',
              'Telp',
              'Gender',
              'Address',
              'Member Type',
              'Created Date',
              'Actions',
            ]"
          >
            {{ h }}
          </th>
        </tr>
        <tr v-for="(u, i) in users">
          <td class="border border-dark">{{ i + 1 }}</td>
          <td class="border border-dark"></td>
          <td class="border border-dark">{{ u?.name ?? "" }}</td>
          <td class="border border-dark">{{ u?.email ?? "" }}</td>
          <td class="border border-dark">{{ u?.phone ?? "" }}</td>
          <td class="border border-dark"></td>
          <td class="border border-dark">{{ u?.address }}</td>
          <td class="border border-dark"></td>
          <td class="border border-dark">
            {{
              Intl.DateTimeFormat("en-US", {
                dateStyle: "medium",
                timeStyle: "short",
              }).format(new Date(u?.created_at ?? new Date())) ?? ""
            }}
          </td>
          <td class="border border-dark">
            <div class="d-flex">
              <a :href="`/#/user/${u?.id}`">
                <button class="btn btn-sm btn-primary">
                  <v-icon icon="mdi-pencil" />
                </button>
              </a>
              <button
                class="btn btn-sm btn-danger"
                @click="
                  () => {
                    handleDelete(u?.id);
                  }
                "
              >
                <v-icon icon="mdi-delete" />
              </button>
            </div>
          </td>
        </tr>
      </table>
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref } from "vue";
import { fetchMaterials } from "../fetchers";
// import { fetchUsers } from "../fetchers";

const materials = ref([] as any[]);
const search = ref("");
const handleFetchUsers = async () => {
  const d = await fetchMaterials();
  materials.value = d;
};

const handleDelete = async (id: any) => {
  if (!window.confirm("Confirm delete?")) {
    return;
  }

  try {
    await fetch(`${import.meta.env.VITE_APP_BASE_URL}/api/materials/${id}`, {
      method: "delete",
    });

    window.location.reload();
  } catch (e) {
    alert("Delete failed.");
    return;
  }
};

handleFetchUsers();
</script>

<template>
  <div class="m-3">
    <div><h3>Materials</h3></div>
    <hr class="border border-dark" />
    <div class="d-flex my-2 justify-content-end">
      <div>
        <input
          class="form-control form-control-sm"
          placeholder="Search..."
          @input="e=>{
          search= (e.target as HTMLInputElement).value
        }"
        />
      </div>
      <div>
        <a href="/#/material/new"
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
            v-for="h in ['#', 'Name', 'Actions']"
          >
            {{ h }}
          </th>
        </tr>
        <tr
          v-for="(m, i) in materials.filter((m) =>
            search !== ''
              ? m?.name
                  ?.toLowerCase()
                  .trim()
                  ?.includes(search.toLowerCase().trim())
              : true
          )"
        >
          <td class="border border-dark">{{ i + 1 }}</td>
          <td class="border border-dark">{{ m?.name ?? "" }}</td>
          <td class="border border-dark">
            <div class="d-flex">
              <a :href="`/#/material/${m?.id}`">
                <button class="btn btn-sm btn-primary">
                  <v-icon icon="mdi-pencil" />
                </button>
              </a>
              <button
                class="btn btn-sm btn-danger"
                @click="
                  () => {
                    handleDelete(m?.id);
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

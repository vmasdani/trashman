<script setup lang="ts">
import { ref } from "vue";
import { fetchPartners } from "../fetchers";
import { legalEntities } from "../helpers";

const partners = ref([] as any[]);

const handleFetchPartners = async () => {
  const d = await fetchPartners();
  partners.value = d;
};

const handleDelete = async (id: any) => {
  if (!window.confirm("Confirm delete?")) {
    return;
  }

  try {
    const resp = await fetch(
      `${import.meta.env.VITE_APP_BASE_URL}/api/partners/${id}`,
      { method: "delete" }
    );

    window.location.reload();
  } catch (e) {
    alert("Delete failed.");
    return;
  }
};

handleFetchPartners();
</script>

<template>
  <div class="m-3">
    <div><h3>Partners</h3></div>
    <hr class="border border-dark" />
    <div class="d-flex my-2 justify-content-end">
      <div>
        <input class="form-control form-control-sm" placeholder="Search..." />
      </div>
      <div>
        <a href="/#/partner/new"
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
              'Name',
              'Legal Entity',
              'Email',
              'PIC',
              'Address',
              'Members',
              'Action',
            ]"
          >
            {{ h }}
          </th>
        </tr>
        <tr v-for="(p, i) in partners">
          <td class="border border-dark">{{ i + 1 }}</td>
          <td class="border border-dark">{{ p?.name ?? "" }}</td>
          <td class="border border-dark">
            {{ legalEntities.find((l) => l.value == p?.legal_entity)?.label }}
          </td>
          <td class="border border-dark">{{ p?.email ?? "" }}</td>
          <td class="border border-dark">{{ p?.pic }}</td>
          <td class="border border-dark">
            {{ p?.provinsi }}, {{ p?.kabupaten }}, {{ p?.kecamatan }},
            {{ p?.kelurahan }}
          </td>
          <td class="border border-dark">
            {{ p?.partner_members?.length ?? 0 }}
          </td>

          <td class="border border-dark">
            <div class="d-flex">
              <a :href="`/#/partner/${p?.id}`">
                <button class="btn btn-sm btn-primary">
                  <v-icon icon="mdi-pencil" />
                </button>
              </a>
              <button
                class="btn btn-sm btn-danger"
                @click="
                  () => {
                    handleDelete(p?.id);
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

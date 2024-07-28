<script setup lang="ts">
import { ref } from "vue";
import { fetchPartners,  } from "../fetchers";

const partners = ref([] as any[]);

const handleFetchPartners = async () => {
  const d = await fetchPartners();
  partners.value = d;
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
              'Action'
            ]"
          >
            {{ h }}
          </th>
        </tr>
        <tr v-for="(p, i) in partners">
          <td class="border border-dark">{{ i + 1 }}</td>
          <td class="border border-dark">{{ p?.name ?? "" }}</td>
          <td class="border border-dark"></td>
          <td class="border border-dark">{{ p?.email ?? "" }}</td>
          <td class="border border-dark">{{ p?.pic }}</td>
          <td class="border border-dark">{{ p?.address }}</td>
          <td class="border border-dark"></td>

          <td class="border border-dark">
            
            <div class="d-flex">
              <a :href="`/#/partner/${p?.id}`">
                <button class="btn btn-sm btn-primary">
                  <v-icon icon="mdi-pencil" />
                </button>
              </a>
              <button class="btn btn-sm btn-danger">
                <v-icon icon="mdi-delete" />
              </button>
            </div>
          </td>
        </tr>
      </table>
    </div>
  </div>
</template>

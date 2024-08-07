<script setup lang="ts">
import { ref } from "vue";
import { fetchTransactions } from "../fetchers";
import { transactionTypes } from "../helpers";
// import { fetchUsers } from "../fetchers";

const materials = ref([] as any[]);

const handleFetchTransactions = async () => {
  const d = await fetchTransactions();
  materials.value = d;
};

handleFetchTransactions();
</script>

<template>
  <div class="m-3">
    <div><h3>Transaction Sales</h3></div>
    <hr class="border border-dark" />
    <div class="d-flex my-2 justify-content-end">
      <div>
        <input class="form-control form-control-sm" placeholder="Search..." />
      </div>
      <div>
        <a href="?type=sales#transaction/new"
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
              // 'Type',
              'Nota',
              'Date',
              'Supplier',
              'Buyer',
              'Items',
              'Actions',
            ]"
          >
            {{ h }}
          </th>
        </tr>
        <tr
          v-for="(m, i) in materials?.filter((m) =>
            m?.type !== null && m?.type !== undefined ? m?.type === 1 : true
          )"
        >
          <td class="border border-dark">{{ i + 1 }}</td>
          <!-- <td class="border border-dark">
            {{
              transactionTypes.find((t) => `${t.value}` === `${m?.type}`)?.label
            }}
          </td> -->
          <td class="border border-dark">{{ m?.nota ?? "" }}</td>
          <td class="border border-dark">
            {{
              Intl.DateTimeFormat("en-US", {
                dateStyle: "medium",
                timeStyle: "short",
              }).format(new Date(m?.created_at ?? new Date())) ?? ""
            }}
          </td>
          <td class="border border-dark"></td>
          <td class="border border-dark"></td>
          <td class="border border-dark">{{ m?.transaction_items?.length }}</td>

          <td class="border border-dark">
            <div class="d-flex">
              <a :href="`/#/transaction/${m?.id}`">
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

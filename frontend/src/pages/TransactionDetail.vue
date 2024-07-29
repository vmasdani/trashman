<script setup lang="ts">
import { ref } from "vue";
import { useRoute, useRouter } from "vue-router";
import { fetchMaterials, fetchTransaction } from "../fetchers";
import { transactionTypes } from "../helpers";

const route = useRoute();
const router = useRouter();
const transaction = ref({} as any);
const materials = ref([] as any[]);
const handleSave = async () => {
  try {
    await fetch(`${import.meta.env.VITE_APP_BASE_URL}/api/transactions`, {
      method: "post",
      headers: { "content-type": "application/json" },
      body: JSON.stringify(transaction.value),
    });

    router.push("/transaction");
  } catch (e) {
    console.error(e);
  }
};

const handleFetchTransaction = async () => {
  const d = await fetchTransaction({
    id: parseInt(route?.params?.id as string),
  });

  if (d) {
    transaction.value = d;
  }
};
const handleFetchMaterials = async () => {
  const d = await fetchMaterials();

  if (d) {
    materials.value = d;
  }
};

const init = () => {
  if (!isNaN(parseInt(route?.params?.id as string))) {
    handleFetchTransaction();
  }
  handleFetchMaterials();

};
const windowx = window;

init();
</script>

<template>
  <div class="m-3 container">
    <div class="d-flex">
      <h3>Transaction Detail: {{ route.params?.id }}</h3>
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

    <div><strong>Type</strong></div>
    <div>
      <v-autocomplete
        label="Type"
        :items="transactionTypes"
        density="compact"
        :item-title="(t:any)=>`${t?.label}`"
        @update:modelValue="(t: any)=>{
          transaction.type=t
        }"
        :modelValue="
          transactionTypes.find((t) => `${t.value}` === `${transaction?.type}`)
        "
      ></v-autocomplete>
    </div>

    <div><strong>Nota</strong></div>
    <div>
      <input
        class="form-control form-control-sm"
        placeholder="Nota..."
        :value="transaction?.nota"
        @blur="(e) => {
          transaction.nota = (e.target as HTMLInputElement).value
        }"
      />
    </div>

    <div><strong>Date</strong></div>
    <div>
      <input
        class="form-control form-control-sm"
        placeholder="Date..."
        type="date"
      />
    </div>

    <div><strong>Supplier</strong></div>
    <div>
      <input class="form-control form-control-sm" placeholder="Supplier..." />
    </div>

    <div><strong>Buyer</strong></div>
    <div>
      <input class="form-control form-control-sm" placeholder="Buyer..." />
    </div>

    <div class="d-flex my-2">
      <div><strong>Items</strong></div>
      <div class="mx-2">
        <button
          class="btn btn-sm btn-primary px-1 py-0"
          @click="
            () => {
              if (!transaction.transaction_items) {
                transaction.transaction_items = [];
              }

              transaction.transaction_items = [
                ...transaction.transaction_items,
                {},
              ];
            }
          "
        >
          <v-icon icon="mdi-plus" /> Add
        </button>
      </div>
    </div>

    <div
      class="overflow-auto border border-dark"
      style="resize: vertical; height: 50vh"
    >
      <table class="table table-sm" style="border-collapse: separate">
        <tr>
          <th v-for="h in ['#', 'Material', 'Qty']" class="bg-dark text-light">
            {{ h }}
          </th>
        </tr>

        <tr v-for="(i, i_) in transaction?.transaction_items ?? []">
          <td class="border border-dark">{{ i_ + 1 }}</td>
          <td class="border border-dark">
            <v-autocomplete
              label="Material"
              :items="materials.map((m) => ({ label: m?.name, value: m }))"
              density="compact"
              :item-title="(m:any)=>`${m?.label}`"
              @update:modelValue="(m: any)=>{
                windowx.console.log(m)
                i.material_id=m?.id
              }"
              :modelValue="
                materials
                  .map((m) => ({ label: m?.name, value: m }))
                  .find((m) => `${m.value?.id}` === `${i?.material_id}`)
              "
            ></v-autocomplete>
          </td>
          <td class="border border-dark">
            <input
              class="form-control form-control-sm"
              style="max-width: 75px"
              placeholder="Qty..."
              :value="i?.qty"
              @blur="e=>{
              const text = (e.target as HTMLInputElement).value

              i.qty = isNaN(parseFloat(text))?0:parseFloat(text)
            }"
            />
          </td>
        </tr>
      </table>
    </div>
  </div>
</template>

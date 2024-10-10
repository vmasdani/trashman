<script setup lang="ts">
import { ref } from "vue";
import { useRoute, useRouter } from "vue-router";
import { fetchMaterials, fetchPartners, fetchTransaction } from "../fetchers";
import { transactionTypes } from "../helpers";

const route = useRoute();
const router = useRouter();
const transaction = ref({} as any);
const urlParams = new URLSearchParams(window.location.search);
const materials = ref([] as any[]);
const partners = ref([] as any[]);
const imageToUpload = ref(null as string | null);
console.log(urlParams.get("type"));

if (urlParams.get("type") === "sales") {
  transaction.value.type = 1;
} else if (urlParams.get("type") === "purchase") {
  transaction.value.type = 0;
}
const baseUrl = import.meta.env.VITE_APP_BASE_URL;
const handleSave = async () => {
  try {
    await fetch(`${import.meta.env.VITE_APP_BASE_URL}/api/transactions`, {
      method: "post",
      headers: { "content-type": "application/json" },
      body: JSON.stringify(transaction.value),
    });

    // Save photo if exists
    if (imageToUpload.value) {
      await fetch(
        `${import.meta.env.VITE_APP_BASE_URL}/api/transactions/${
          transaction.value?.id
        }/photo`,
        {
          method: "post",
          headers: { "content-type": "application/json" },
          body: JSON.stringify({
            image: imageToUpload.value.split("base64,")?.[1],
          }),
        }
      );
    }

    if (transaction.value.type === 1) {
      router.push("/sales");
    }

    if (transaction.value.type === 0) {
      router.push("/purchase");
    }
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

const handleFetchPartners = async () => {
  const d = await fetchPartners();
  partners.value = d;
};

const init = () => {
  if (!isNaN(parseInt(route?.params?.id as string))) {
    handleFetchTransaction();
  }
  handleFetchMaterials();
  handleFetchPartners();
};
const windowx = window;

const handleFileInput = async (e: any) => {
  const file = (e.target as HTMLInputElement).files?.[0];
  // const file = ()

  if (file) {
    const reader = new FileReader();

    reader.readAsDataURL(file);

    reader.onload = (e) => {
      // window.alert(e.target?.result);
      if (e.target?.result) {
        imageToUpload.value = e.target?.result as string;
      }
    };

    reader.onerror = (e) => {
      console.error(e);
    };
  }
};

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
      <v-autocomplete
        class="form-control form-control-sm"
        title="Supplier..."
        density="comfortable"
        :items="partners.map((p) => ({ label: `${p?.name}`, value: p }))"
        :modelValue="
          partners
            .map((p) => ({ label: `${p?.name}`, value: p }))
            .find((p) => p.value?.id === transaction?.supplier_id)
        "
        :item-title="(p:any) => p?.label"
        @update:modelValue="
          async (p: any) => {
            transaction.supplier_id = p?.id;
          }
        "
      />
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

    <div>
      <strong>Photo </strong>
    </div>

    <div v-if="transaction?.id">
      <input type="file" @input="handleFileInput" />

      <div><strong>Current image:</strong></div>
      <img
        :src="`${baseUrl}/api/transactions/${transaction?.id}/photo`"
        style="width: 300"
      />
    </div>

    <div v-if="imageToUpload">
      <img :src="`${imageToUpload}`" style="width: 300" />
    </div>
  </div>
</template>

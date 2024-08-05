<script setup lang="ts">
import { LMap, LTileLayer } from "@vue-leaflet/vue-leaflet";
// import GenericApexRadial from "./components/GenericApexRadial.vue";

import "leaflet/dist/leaflet.css";
import { ref } from "vue";
import {
  fetchMaterials,
  fetchPartners,
  fetchProvinsis,
  fetchUsers,
} from "./fetchers";

const provinsis = ref([] as any[]);
const partners = ref([] as any[]);
const users = ref([] as any[]);
const materials = ref([] as any[]);

const handleFetchProvinsis = async () => {
  const d = await fetchProvinsis();

  if (d) {
    provinsis.value = d;
  }
};
const handleFetchPartners = async () => {
  const d = await fetchPartners();
  partners.value = d;
};
const handleFetchUsers = async () => {
  const d = await fetchUsers();
  users.value = d;
};
const handleFetchMaterials = async () => {
  const d = await fetchMaterials();
  materials.value = d;
};
handleFetchUsers();
handleFetchPartners();
handleFetchProvinsis();
handleFetchMaterials();

const zoom = ref(4);
</script>
<template>
  <div class="p-3" style="background-color: lightgray; min-height: 100vh">
    <div class="d-flex flex-wrap">
      <div class="rounded rounded-md shadow shadow-md bg-light">
        <div class="d-flex mx-2 bg-light">
          <div class="flex-grow-1">
            <v-autocomplete
              label="Provinsi..."
              density="comfortable"
              :items="provinsis.map((p) => ({ label: `${p?.nama}`, value: p }))"
              :item-title="(p:any) => p?.label"
              @update:modelValue="
                async () => {
                  // user.provinsi = p?.nama;
                  // kabupatens = await fetchKabupatens({ id: p?.id });
                }
              "
            />
          </div>

          <div class="flex-grow-1 mx-2">
            <v-autocomplete
              label="Member..."
              density="comfortable"
              :items="users.map((p) => ({ label: `${p?.name}`, value: p }))"
              :item-title="(p:any) => p?.label"
              @update:modelValue="
                async () => {
                  // user.provinsi = p?.nama;
                  // kabupatens = await fetchKabupatens({ id: p?.id });
                }
              "
            />
          </div>

          <div class="flex-grow-1 mx-2">
            <v-autocomplete
              label="Partner..."
              density="comfortable"
              :items="partners.map((p) => ({ label: `${p?.name}`, value: p }))"
              :item-title="(p:any) => p?.label"
              @update:modelValue="
                async () => {
                  // user.provinsi = p?.nama;
                  // kabupatens = await fetchKabupatens({ id: p?.id });
                }
              "
            />
          </div>
        </div>

        <div style="height: 45vh; width: 60vw">
          <LMap
            :use-global-leaflet="false"
            ref="map"
            v-model:zoom="zoom"
            :center="[-3, 115]"
          >
            <LTileLayer
              url="https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png"
              layer-type="base"
              name="OpenStreetMap"
            ></LTileLayer>
          </LMap>
        </div>
      </div>

      <div
        class="d-flex flex-column justify-content-center flex-grow-1 rounded rounded-md shadow bg-light mx-2 px-2"
      >
        <div class="d-flex my-4 w-100 justify-content-center">
          <strong>Member</strong>
        </div>

        <div>
          <v-autocomplete
              label="Partner..."
              density="comfortable"
              :items="partners.map((p) => ({ label: `${p?.name}`, value: p }))"
              :item-title="(p:any) => p?.label"
              @update:modelValue="
                async () => {
                  // user.provinsi = p?.nama;
                  // kabupatens = await fetchKabupatens({ id: p?.id });
                }
              "
            />
        </div>

        <div>
          <v-autocomplete
            density="comfortable"
            label="Status"
            :items="[
              'California',
              'Colorado',
              'Florida',
              'Georgia',
              'Texas',
              'Wyoming',
            ]"
          ></v-autocomplete>
        </div>

        <div class="d-flex w-100 justify-content-center"><h2>213</h2></div>
      </div>
    </div>

    <div class="d-flex flex-wrap my-3">
      <div
        class="p-3 mr-3 rounded rounded-md flex-grow-1 shadow shadow-md bg-light"
      >
        <div>
          <div>
            <h4>Purchased</h4>
          </div>

          <div><h2>23 Kg</h2></div>
        </div>
      </div>

      <div
        class="p-3 mx-3 rounded rounded-md flex-grow-1 shadow shadow-md bg-light"
      >
        <div>
          <div>
            <h4>Sales</h4>
          </div>

          <div><h2>23 Kg</h2></div>
        </div>
      </div>

      <div
        class="p-3 ml-3 rounded rounded-md flex-grow-1 shadow shadow-md bg-light"
      >
        <div>
          <div>
            <h4>Active Location</h4>
          </div>

          <div><h2>313</h2></div>
        </div>
      </div>
    </div>

    <div class="rounded rounded-md shadow shadow-md bg-light py-2">
      <div class="d-flex align-items-center mx-2 bg-light">
        <div class="flex-grow-1 mx-2">
          <v-autocomplete
              label="Material..."
              density="comfortable"
              :items="materials.map((p) => ({ label: `${p?.name}`, value: p }))"
              :item-title="(p:any) => p?.label"
              @update:modelValue="
                async () => {
                  // user.provinsi = p?.nama;
                  // kabupatens = await fetchKabupatens({ id: p?.id });
                }
              "
            />
        </div>
        <div class="flex-grow-1 mx-2">
          <v-autocomplete
              label="Year..."
              density="comfortable"
              :items="materials.map((p) => ({ label: `${p?.name}`, value: p }))"
              :item-title="(p:any) => p?.label"
              @update:modelValue="
                async () => {
                  // user.provinsi = p?.nama;
                  // kabupatens = await fetchKabupatens({ id: p?.id });
                }
              "
            />
        </div>
        <div class="flex-grow-1 mx-2">
          <v-autocomplete
              label="Provinsi..."
              density="comfortable"
              :items="provinsis.map((p) => ({ label: `${p?.nama}`, value: p }))"
              :item-title="(p:any) => p?.label"
              @update:modelValue="
                async () => {
                  // user.provinsi = p?.nama;
                  // kabupatens = await fetchKabupatens({ id: p?.id });
                }
              "
            />
        </div>
        <div class="flex-grow-1 mx-2">
          <v-autocomplete
              label="Partner..."
              density="comfortable"
              :items="partners.map((p) => ({ label: `${p?.name}`, value: p }))"
              :item-title="(p:any) => p?.label"
              @update:modelValue="
                async () => {
                  // user.provinsi = p?.nama;
                  // kabupatens = await fetchKabupatens({ id: p?.id });
                }
              "
            />
        </div>
        <div class="mx-2">
          <button class="btn btn-sm btn-success">
            <v-icon icon="mdi-download-box" /> Excel
          </button>
        </div>
      </div>

      <div class="px-3 border border-secondary rounded rounded-md mx-3">
        <table class="table table-sm table-bordered my-2 rounded rounded-md">
          <tr style="background-color: grey">
            <th
              class="border border-secondary text-light"
              v-for="h in [
                '#',
                'Month',
                'Year',

                'New Member',
                'Active Member',
                'Material',
                'Total',
              ]"
            >
              {{ h }}
            </th>
          </tr>
          <tr
            v-for="(d, i) in [
              {
                month: 'Jan',
                year: 2024,
                newMember: 50,
                activeMember: 100,
                material: 100,
                total: 100,
              },
              {
                month: 'Feb',
                year: 2024,
                newMember: 50,
                activeMember: 150,
                material: 100,
                total: 100,
              },
              {
                month: 'Mar',
                year: 2024,
                newMember: 50,
                activeMember: 200,
                material: 100,
                total: 100,
              },
              {
                month: 'Apr',
                year: 2024,
                newMember: 200,
                activeMember: 400,
                material: 100,
                total: 100,
              },
            ]"
          >
            <td class="border border-secondary">{{ i + 1 }}</td>
            <td class="border border-secondary">{{ d?.month }}</td>
            <td class="border border-secondary">{{ d?.year }}</td>

            <td class="border border-secondary">{{ d?.activeMember }}</td>
            <td class="border border-secondary">{{ d?.material }}</td>
            <td class="border border-secondary">{{ d?.total }}</td>
            <td class="border border-secondary">{{ i + 1 }}</td>
          </tr>
        </table>
      </div>
    </div>
  </div>
</template>

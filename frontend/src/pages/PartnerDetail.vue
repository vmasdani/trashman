<script setup lang="ts">
import { ref } from "vue";
import { useRoute, useRouter } from "vue-router";
import {
  fetchKabupatens,
  fetchKecamatans,
  fetchKelurahans,
  fetchPartner,
  fetchProvinsis,
  fetchUsers,
} from "../fetchers";
import { legalEntities } from "../helpers";

const route = useRoute();
const router = useRouter();
const user = ref({} as any);
const provinsis = ref([] as any[]);
const kabupatens = ref([] as any[]);
const kecamatans = ref([] as any[]);
const kelurahans = ref([] as any[]);
const members = ref([] as any[]);

const selectedProvinsiId = ref(null as number | null);
const selectedKabupatenId = ref(null as number | null);
const selectedKecamatanId = ref(null as number | null);
const selectedKelurahanId = ref(null as number | null);

const handleSave = async () => {
  try {
    await fetch(`${import.meta.env.VITE_APP_BASE_URL}/api/partners`, {
      method: "post",
      headers: { "content-type": "application/json" },
      body: JSON.stringify(user.value),
    });

    router.push("/partner");
  } catch (e) {
    console.error(e);
  }
};

const handleFetchPartner = async () => {
  const d = await fetchPartner({ id: parseInt(route?.params?.id as string) });

  if (d) {
    user.value = d;
  }
};

const handleFetchProvinsis = async () => {
  const d = await fetchProvinsis();

  if (d) {
    provinsis.value = d;
  }
};
const handleFetchMembers = async () => {
  const d = await fetchUsers();

  if (d) {
    members.value = d;
  }
};

const init = () => {
  if (!isNaN(parseInt(route?.params?.id as string))) {
    handleFetchPartner();
  }

  handleFetchProvinsis();
  handleFetchMembers();
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
    <!-- <div><strong>Country</strong></div>
    <div>
      <input class="form-control form-control-sm" placeholder="Name..." />
    </div> -->
    <div><strong>Provinsi</strong></div>
    <div>
      <v-autocomplete
        v-if="!user?.provinsi && provinsis.length > 0"
        class="form-control form-control-sm"
        title="Provinsi..."
        density="comfortable"
        :items="provinsis.map((p) => ({ label: `${p?.nama}`, value: p }))"
        :item-title="(p:any) => p?.label"
        @update:modelValue="
          async (p: any) => {
            user.provinsi = p?.nama;

            kabupatens = await fetchKabupatens({ id: p?.id });
          }
        "
      />
      <div v-else>
        <div class="d-flex">
          <div>
            {{ user?.provinsi }}
          </div>
          <div
            class="mx-2"
            style="cursor: pointer"
            @click="
              () => {
                user.provinsi = null;
                user.kabupaten = null;
                user.kecamatan = null;
                user.kelurahan = null;
              }
            "
          >
            <v-icon icon="mdi-close-thick" />
          </div>
        </div>
      </div>
    </div>
    <div><strong>Kabupaten</strong></div>
    <div>
      <v-autocomplete
        v-if="!user?.kabupaten"
        class="form-control form-control-sm"
        title="Kabupaten..."
        density="comfortable"
        :items="kabupatens.map((p) => ({ label: `${p?.nama}`, value: p }))"
        :item-title="(p:any) => p?.label"
        @update:modelValue="
          async (p: any) => {
            user.kabupaten = p?.nama;

            kecamatans = await fetchKecamatans({ id: p?.id });
          }
        "
      />
      <div v-else>
        <div class="d-flex">
          <div>
            {{ user?.kabupaten }}
          </div>
          <div
            class="mx-2"
            style="cursor: pointer"
            @click="
              () => {
                // user.provinsi = null;
                user.kabupaten = null;
                user.kecamatan = null;
                user.kelurahan = null;
              }
            "
          >
            <v-icon icon="mdi-close-thick" />
          </div>
        </div>
      </div>
    </div>
    <div><strong>Kecamatan</strong></div>
    <div>
      <v-autocomplete
        v-if="!user?.kecamatan"
        class="form-control form-control-sm"
        title="Kecamatan..."
        density="comfortable"
        :items="kecamatans.map((p) => ({ label: `${p?.nama}`, value: p }))"
        :item-title="(p:any) => p?.label"
        @update:modelValue="
          async (p: any) => {
            user.kecamatan = p?.nama;

            kelurahans = await fetchKelurahans({ id: p?.id });
          }
        "
      />
      <div v-else>
        <div class="d-flex">
          <div>
            {{ user?.kecamatan }}
          </div>
          <div
            class="mx-2"
            style="cursor: pointer"
            @click="
              () => {
                // user.provinsi = null;
                // user.kabupaten = null;
                user.kecamatan = null;
                user.kelurahan = null;
              }
            "
          >
            <v-icon icon="mdi-close-thick" />
          </div>
        </div>
      </div>
    </div>
    <div><strong>Kelurahan</strong></div>
    <div>
      <v-autocomplete
        v-if="!user?.kelurahan"
        class="form-control form-control-sm"
        title="Kelurahan..."
        density="comfortable"
        :items="kelurahans.map((p) => ({ label: `${p?.nama}`, value: p }))"
        :item-title="(p:any) => p?.label"
        @update:modelValue="
          async (p: any) => {
            user.kelurahan = p?.nama;
          }
        "
      />
      <div v-else>
        <div class="d-flex">
          <div>
            {{ user?.kelurahan }}
          </div>
          <div
            class="mx-2"
            style="cursor: pointer"
            @click="
              () => {
                // user.provinsi = null;
                // user.kabupaten = null;
                // user.kecamatan = null;
                user.kelurahan = null;
              }
            "
          >
            <v-icon icon="mdi-close-thick" />
          </div>
        </div>
      </div>
    </div>
    <div><strong>Legal Entity</strong></div>
    <div>
      <v-autocomplete
        class="form-control form-control-sm"
        title="Legal Entity..."
        density="comfortable"
        :items="legalEntities"
        :item-title="(p:any) => p?.label"
        :modelValue="
          legalEntities.find((l) => `${l?.value}` === `${user?.legal_entity}`)
        "
        @update:modelValue="
          async (p: any) => {
            user.legal_entity = p;
          }
        "
      />
    </div>
    <div><strong>Email</strong></div>
    <div>
      <input
        class="form-control form-control-sm"
        placeholder="Name..."
        :value="user?.email"
        @blur="(e) => {
          user.email = (e.target as HTMLInputElement).value
        }"
      />
    </div>
    <div><strong>PIC</strong></div>
    <div>
      <input
        class="form-control form-control-sm"
        placeholder="Name..."
        :value="user?.pic"
        @blur="(e) => {
          user.pic = (e.target as HTMLInputElement).value
        }"
      />
    </div>

    <div class="d-flex my-2">
      <div><strong>Members</strong></div>
      <div class="mx-2">
        <button
          class="btn btn-sm btn-primary px-1 py-0"
          @click="
            () => {
              if (!user.partner_members) {
                user.partner_members = [];
              }

              user.partner_members = [...user.partner_members, {}];
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
          <th v-for="h in ['#', 'Member']" class="bg-dark text-light">
            {{ h }}
          </th>
        </tr>

        <tr v-for="(m, i_) in user?.partner_members ?? []">
          <td class="border border-dark">{{ i_ + 1 }}</td>
          <td class="border border-dark">
            <v-autocomplete
              class="form-control form-control-sm"
              title="Member..."
              density="comfortable"
              :items="members?.map((m) => ({ label: `${m?.name}`, value: m }))"
              :item-title="(p:any) => p?.label"
              :modelValue="
                members
                  ?.map((m) => ({ label: `${m?.name}`, value: m }))
                  .find((mx) => `${mx.value?.id}` === `${m?.member_id}`)
              "
              @update:modelValue="
                async (p: any) => {
                  m.member_id = p.id;
                }
              "
            />
          </td>
        </tr>
      </table>
    </div>
  </div>
</template>

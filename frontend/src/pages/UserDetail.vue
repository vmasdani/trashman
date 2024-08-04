<script setup lang="ts">
import { ref } from "vue";
import { useRoute, useRouter } from "vue-router";
import {
  fetchKabupatens,
  fetchKecamatans,
  fetchKelurahans,
  fetchProvinsis,
  fetchUser,
} from "../fetchers";
import { genders, memberTypes, roles } from "../helpers";

const route = useRoute();
const router = useRouter();
const user = ref({} as any);

const provinsis = ref([] as any[]);
const kabupatens = ref([] as any[]);
const kecamatans = ref([] as any[]);
const kelurahans = ref([] as any[]);

const handleSave = async () => {
  try {
    await fetch(`${import.meta.env.VITE_APP_BASE_URL}/api/users`, {
      method: "post",
      headers: { "content-type": "application/json" },
      body: JSON.stringify(user.value),
    });

    router.push("/user");
  } catch (e) {
    console.error(e);
  }
};

const handleFetchUser = async () => {
  const d = await fetchUser({ id: parseInt(route?.params?.id as string) });

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

const init = () => {
  if (!isNaN(parseInt(route?.params?.id as string))) {
    handleFetchUser();
    handleFetchProvinsis();
  }
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

    <div><strong>MP</strong></div>
    <div>
      <input
        class="form-control form-control-sm"
        placeholder="Name..."
        :value="user?.mp"
        @blur="(e) => {
          user.mp = (e.target as HTMLInputElement).value
        }"
      />
    </div>
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
    <div><strong>Phone</strong></div>
    <div>
      <input
        class="form-control form-control-sm"
        placeholder="Name..."
        :value="user?.phone"
        @blur="(e) => {
          user.phone = (e.target as HTMLInputElement).value
        }"
      />
    </div>
    <div><strong>Role</strong></div>
    <div>
      <v-autocomplete
        class="form-control form-control-sm"
        title="Member..."
        density="comfortable"
        :items="roles"
        :item-title="(p:any) => p?.label"
        :modelValue="roles.find((r) => `${r.value}` === `${user?.role}`)"
        @update:modelValue="
          async (p: any) => {
            user.role = p;
          }
        "
      />
    </div>
    <div><strong>Gender</strong></div>
    <div>
      <v-autocomplete
        class="form-control form-control-sm"
        title="Member..."
        density="comfortable"
        :items="genders"
        :item-title="(p:any) => p?.label"
        :modelValue="genders.find((r) => `${r.value}` === `${user?.gender}`)"
        @update:modelValue="
          async (p: any) => {
            user.gender = p;
          }
        "
      />
    </div>
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

    <div><strong>Address</strong></div>
    <div>
      <textarea
        class="form-control form-control-sm"
        placeholder="Name..."
        :value="user?.address"
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
        :value="user?.latitude"
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
        :value="user?.longitude"
        @blur="(e) => {
          user.longitude = isNaN(parseFloat((e.target as HTMLInputElement).value))
            ? undefined
            : parseFloat((e.target as HTMLInputElement).value)
        }"
      />
    </div>
    <div><strong>Member Type</strong></div>
    <div>
      <v-autocomplete
        class="form-control form-control-sm"
        title="Member Type..."
        density="comfortable"
        :items="memberTypes"
        :item-title="(p:any) => p?.label"
        :modelValue="
            memberTypes.find((r) => `${r.value}` === `${user?.member_type}`)
          "
        @update:modelValue="
          async (p: any) => {
            user.member_type = p;
          }
        "
      />
    </div>
    <template v-if="user?.member_type === 0">
      <div><strong>Family ID</strong></div>
      <div>
        <input
          class="form-control form-control-sm"
          placeholder="Name..."
          :value="user?.family_id"
        
          @blur="(e) => {
          user.family_id =(e.target as HTMLInputElement).value
        }"
        />
      </div>
    </template>
  </div>
</template>

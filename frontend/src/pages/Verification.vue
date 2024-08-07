<script setup lang="ts">
import { ref } from "vue";
import { fetchUsers } from "../fetchers";
import { genders, memberTypes } from "../helpers";

const users = ref([] as any[]);
const search = ref("");

const handleFetchUsers = async () => {
  const d = await fetchUsers();
  users.value = d;
};

handleFetchUsers();

const handleVerify = async (u: any) => {
  if (
    !window.confirm(`${u?.verified_date ? `Undo ` : ``}Verify user ${u?.name}?`)
  ) {
    return;
  }

  try {
    await fetch(`${import.meta.env.VITE_APP_BASE_URL}/api/users`, {
      method: "post",
      headers: { "content-type": "application/json" },
      body: JSON.stringify({
        ...u,
        verified_date: u.verified_date
          ? null
          : new Date(
              new Date().getTime() - new Date().getTimezoneOffset() * 60000
            )
              .toISOString()
              .split("T")?.[0],
      }),
    });

    handleFetchUsers();
  } catch (e) {
    console.error(e);
  }
};
</script>

<template>
  <div class="m-3">
    <div><h3>Users</h3></div>
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
              'Verified',
            ]"
          >
            {{ h }}
          </th>
        </tr>
        <tr
          v-for="(u, i) in users.filter((m) =>
            search !== ''
              ? m?.name
                  ?.toLowerCase()
                  .trim()
                  ?.includes(search.toLowerCase().trim())
              : true
          )"
        >
          <td class="border border-dark">{{ i + 1 }}</td>
          <td class="border border-dark">{{ u?.mp }}</td>
          <td class="border border-dark">{{ u?.name ?? "" }}</td>
          <td class="border border-dark">{{ u?.email ?? "" }}</td>
          <td class="border border-dark">{{ u?.phone ?? "" }}</td>
          <td class="border border-dark">
            {{ genders.find((g) => g.value === u?.gender)?.label }}
          </td>
          <td class="border border-dark">{{ u?.address }}</td>
          <td class="border border-dark">
            {{ memberTypes.find((t) => t.value === u?.member_type)?.label }}
          </td>
          <td class="border border-dark">
            {{
              Intl.DateTimeFormat("en-US", {
                dateStyle: "medium",
                timeStyle: "short",
              }).format(new Date(u?.created_at ?? new Date())) ?? ""
            }}
          </td>
          <td
            style="cursor: pointer"
            @click="
              () => {
                handleVerify(u);
              }
            "
            :class="`border border-dark ${
              u?.verified_date ? `bg-success` : `bg-danger`
            }`"
          >
            {{
              u?.verified_date
                ? Intl.DateTimeFormat("en-US", { dateStyle: "medium" }).format(
                    new Date(u?.verified_date ?? "")
                  )
                : ""
            }}
            (Click to change)
          </td>
        </tr>
      </table>
    </div>
  </div>
</template>

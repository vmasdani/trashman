<script setup lang="ts">
import { ref } from "vue";
import { ctx } from "./main";

const expandedMenu = ref([] as string[]);

const menus = [
  {
    icon: "mdi-view-dashboard",
    name: "Dashboard",
    children: [
      {
        name: "Dashboard",
        value: "",
      },
    ],
  },
  {
    icon: "mdi-cog",
    name: "Master Data",
    children: [
      {
        name: "Material",
        value: "material",
      },

      {
        name: "Member",
        value: "user",
      },
      {
        name: "Partner",
        value: "partner",
      },
    ],
  },
  {
    icon: "mdi-swap-horizontal",
    name: "Transaction",
    children: [
      {
        name: "Transaction",
        value: "transaction",
      },
      // {
      //   name: "Sales",
      // },
    ],
  },
  {
    icon: "mdi-account",
    name: "Verification",
    children: [],
  },
];
</script>
<template>
  <!-- <v-app-bar color="primary" prominent>
    <v-app-bar-nav-icon
      variant="text"
      @click.stop="ctx.drawer = !ctx.drawer"
    ></v-app-bar-nav-icon>

    <v-toolbar-title>My files</v-toolbar-title>

    <v-spacer></v-spacer>

    <template v-if="$vuetify.display.mdAndUp">
      <v-btn icon="mdi-magnify" variant="text"></v-btn>

      <v-btn icon="mdi-filter" variant="text"></v-btn>
    </template>

    <v-btn icon="mdi-dots-vertical" variant="text"></v-btn>
  </v-app-bar> -->

  <v-navigation-drawer
    style="color: green"
    :v-model="true"
    :rail="ctx.rail"
    permanent
    @click="ctx.rail = false"
  >
    <v-list-item title="Logo & Nama Perusahaan" nav></v-list-item>
    <v-list-item
      prepend-avatar="https://randomuser.me/api/portraits/men/85.jpg"
      title="John Doe"
      nav
    >
      <template v-slot:append>
        <v-btn
          icon="mdi-chevron-left"
          variant="text"
          @click.stop="ctx.rail = !ctx.rail"
        ></v-btn>
      </template>
    </v-list-item>

    <v-divider></v-divider>

    <v-list density="compact" nav>
      <template v-for="m in menus">
        <v-list-item
          :prepend-icon="m.icon"
          :title="m.name"
          :value="m.name"
          @click="
            (_: any) => {
              const foundExpanded = expandedMenu.find((mx) => mx === m.name);

              if (!foundExpanded) {
                expandedMenu = [...expandedMenu, m.name];
              } else {
                expandedMenu = expandedMenu.filter((mx) => mx !== m.name);
              }
            }
          "
        ></v-list-item>

        <template
          v-if="expandedMenu.find((mx) => mx === m.name)"
          v-for="c in m.children"
        >
          <v-list-item
            :title="c.name"
            :value="c.name"
            :href="`/#/${(c as any)?.value}`"
          ></v-list-item>
        </template>
      </template>

      <!-- <v-list-item
        prepend-icon="mdi-bell"
        title="Notification"
        value="notification"
        href="/#/notification"
      ></v-list-item>

      <v-list-item
        prepend-icon="mdi-cog"
        title="Setting"
        value="setting"
        href="/#/setting"
      ></v-list-item>

      <v-list-item
        prepend-icon="mdi-chat"
        title="Chat"
        value="chat"
        href="/#/chat"
      ></v-list-item>

      <v-list-item
        prepend-icon="mdi-email"
        title="Message"
        value="message"
        href="/#/message"
      ></v-list-item>

      <v-list-item
        prepend-icon="mdi-bookmark-outline"
        title="Bookmark"
        value="bookmark"
        href="/#/bookmark"
      ></v-list-item>

      <v-list-item
        prepend-icon="mdi-file-document-outline"
        title="Report"
        value="report"
        href="/#/report"
      ></v-list-item> -->
    </v-list>
  </v-navigation-drawer>
</template>

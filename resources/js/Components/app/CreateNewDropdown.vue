<script setup lang="ts">
// Imports
import { Menu, MenuButton, MenuItems, MenuItem } from "@headlessui/vue";
import { ChevronDownIcon } from "@heroicons/vue/20/solid";
import CreateFolderModal from "./CreateFolderModal.vue";
import { ref } from "vue";

// Uses
const createFolderModal = ref(false);

// Props $ Emit

// Computed

// Methods
const ShowCreateFolderModal = () => {
  createFolderModal.value = true;
};

// Hooks
</script>

<template>
  <Menu as="div" class="relative inline-block text-left">
    <MenuButton
      class="inline-flex items-center justify-center rounded-md bg-black px-4 py-2 text-sm font-medium text-white hover:bg-black focus:outline-none focus-visible:ring-2 focus-visible:ring-white/75 whitespace-nowrap"
    >
      Create New
    </MenuButton>

    <transition
      enter-active-class="transition duration-100 ease-out"
      enter-from-class="transform scale-95 opacity-0"
      enter-to-class="transform scale-100 opacity-100"
      leave-active-class="transition duration-75 ease-in"
      leave-from-class="transform scale-100 opacity-100"
      leave-to-class="transform scale-95 opacity-0"
    >
      <MenuItems
        class="absolute left-0 mt-2 w-40 origin-top-right divide-y divide-gray-100 rounded-md bg-white shadow-lg ring-1 ring-black/5 focus:outline-none"
      >
        <div class="px-1 py-1">
          <MenuItem v-slot="{ active }">
            <a
              class="text-gray-700 block px-4 py-2 text-sm"
              href="#"
              @click.prevent="ShowCreateFolderModal"
              >New Folder</a
            >
          </MenuItem>
        </div>
        <div class="px-1 py-1">
          <MenuItem v-slot="{ active }">
            <a class="text-gray-700 block px-4 py-2 text-sm" href=""
              >Upload Folder</a
            >
          </MenuItem>
          <MenuItem v-slot="{ active }">
            <a class="text-gray-700 block px-4 py-2 text-sm" href=""
              >Upload Files</a
            >
          </MenuItem>
        </div>
      </MenuItems>
    </transition>
  </Menu>
  <CreateFolderModal v-model="createFolderModal" />
</template>

<style scoped></style>

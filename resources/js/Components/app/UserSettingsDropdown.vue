<script setup lang="ts">
// Imports
import { ChevronDownIcon } from "@heroicons/vue/20/solid";
import ResponsiveNavLink from "../ResponsiveNavLink.vue";
import { Menu, MenuButton, MenuItems, MenuItem } from "@headlessui/vue";
// import ArchiveIcon from './archive-icon.vue'
// import DuplicateIcon from './duplicate-icon.vue'
// import MoveIcon from './move-icon.vue'
// import EditIcon from './edit-icon.vue'
// import DeleteIcon from './delete-icon.vue'

// Uses

// Refs

// Props $ Emit

// Computed

// Methods

// Hooks
</script>

<template>
  <Menu as="div" class="relative inline-block text-left">
    <div>
      <MenuButton
        class="inline-flex items-center justify-center rounded-md bg-black px-4 py-2 text-sm font-medium text-white hover:bg-black focus:outline-none focus-visible:ring-2 focus-visible:ring-white/75 whitespace-nowrap"
      >
        {{ $page.props.auth.user.name }}
        <ChevronDownIcon
          class="ml-2 h-5 w-5 text-violet-200 hover:text-violet-100"
          aria-hidden="true"
        />
      </MenuButton>
    </div>

    <transition
      enter-active-class="transition duration-100 ease-out"
      enter-from-class="transform scale-95 opacity-0"
      enter-to-class="transform scale-100 opacity-100"
      leave-active-class="transition duration-75 ease-in"
      leave-from-class="transform scale-100 opacity-100"
      leave-to-class="transform scale-95 opacity-0"
    >
      <MenuItems
        class="absolute right-0 mt-2 w-40 origin-top-right divide-y divide-gray-100 rounded-md bg-white shadow-lg ring-1 ring-black/5 focus:outline-none"
      >
        <div class="px-1 py-1">
          <MenuItem v-slot="{ active }">
            <ResponsiveNavLink
              :href="route('profile.edit')"
              :class="[
                active ? 'bg-gray-100 text-gray-900' : 'text-gray-700',
                'block px-4 py-2 text-sm',
              ]"
            >
              Profile
            </ResponsiveNavLink>
          </MenuItem>
          <MenuItem v-slot="{ active }">
            <ResponsiveNavLink
              :href="route('logout')"
              method="post"
              as="button"
              :class="[
                active ? 'bg-gray-100 text-gray-900' : 'text-gray-700',
                'block px-4 py-2 text-sm',
              ]"
            >
              Log out
            </ResponsiveNavLink>
          </MenuItem>
        </div>
      </MenuItems>
    </transition>
  </Menu>
</template>

<style scoped></style>

<template>
  <div class="min-w-[200px]">
    <Link
      :href="route('myFiles')"
      class="h-[80px] px-3 flex items-center gap-3"
    >
      <ApplicationLogo class="block h-9 w-auto fill-current text-gray-800" />
      LaraStorage
    </Link>
    <div class="px-3">
      <CreateNewDropdown />
      <div class="py-3">
        <NavLink :href="route('myFiles')" :active="$page.url === '/my-files'">
          My files
        </NavLink>
        <NavLink href="/">Shared with me</NavLink>
        <NavLink href="/">Shared by me</NavLink>
        <NavLink href="/">Trash</NavLink>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import ApplicationLogo from "../ApplicationLogo.vue";
import NavLink from "../NavLink.vue";
import CreateNewDropdown from "./CreateNewDropdown.vue";
import { Link } from "@inertiajs/vue3";
</script>

<style scoped></style>

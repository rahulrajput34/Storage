<script lang="ts" setup>
// Imports
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

// Uses

// Refs

// Props $ Emit
// This data is coming from the database
// location: inside the controller we gave the inertia over there
const { files } = defineProps({
  files: Object,
});

// Computed

// Methods

// Hooks
</script>

<template>
  <AuthenticatedLayout>
    <table class="min-w-full">
      <thead class="bg-gray-100 border-b">
        <tr>
          <th
            class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
          >
            Name
          </th>
          <th
            class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
          >
            Owner
          </th>
          <th
            class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
          >
            Last Modified
          </th>
          <th
            class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
          >
            Size
          </th>
        </tr>
      </thead>
      <tbody>
        <tr
          v-for="file in files.data"
          :key="file.id"
          class="bg-white border-b transition duration-300 ease-in-out hover:bg-gray-100"
        >
          <td
            class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-medium text-gray-900"
          >
            {{ file.name }}
          </td>
          <td
            class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500"
          >
            {{ file.owner }}
          </td>
          <td
            class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500"
          >
            {{ file.updated_at }}
          </td>
          <td
            class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500"
          >
            {{ file.size }}
          </td>
        </tr>
      </tbody>
    </table>
  </AuthenticatedLayout>
</template>

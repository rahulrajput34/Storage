<script lang="ts" setup>
// Imports
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { router } from "@inertiajs/vue3";
import { Link } from "@inertiajs/vue3";

// Uses

// Refs

// Props $ Emit
// This data is coming from the database
// location: inside the controller we gave the inertia over there
const { files } = defineProps({
  files: Object,
  folder: Object,
  ancestors: Array,
});

// Computed

// Methods
function openFolder(file) {
  if (!file.is_folder) {
    return;
  }
  router.visit(route("myFiles", { folder: file.path }));
}

// Hooks
</script>

<template>
  <AuthenticatedLayout>
    <nav class="flex items-center justify-between p-4 mb-6 bg-white shadow">
      <ol class="flex items-center space-x-2 md:space-x-4">
        <li
          v-for="ans in ancestors.data"
          :key="ans.id"
          class="flex items-center"
        >
          <Link
            v-if="!ans.parent_id"
            :href="route('myFiles')"
            class="flex items-center text-sm font-medium text-black hover:text-gray-700"
          >
            <svg
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 20 20"
              fill="currentColor"
              class="w-5 h-5 mr-1"
            >
              <path
                fill-rule="evenodd"
                d="M9.293 2.293a1 1 0 011.414 0l7 7A1 1 0 0117 11h-1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-3a1 1 0 00-1-1H9a1 1 0 00-1 1v3a1 1 0 01-1 1H5a1 1 0 01-1-1v-6H3a1 1 0 01-.707-1.707l7-7Z"
                clip-rule="evenodd"
              />
            </svg>
            My Files
          </Link>
          <div v-else class="flex items-center">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 24 24"
              fill="currentColor"
              class="w-5 h-5 mx-1 text-black"
            >
              <path
                fill-rule="evenodd"
                d="M16.28 11.47a.75.75 0 0 1 0 1.06l-7.5 7.5a.75.75 0 0 1-1.06-1.06L14.69 12 7.72 5.03a.75.75 0 0 1 1.06-1.06l7.5 7.5Z"
                clip-rule="evenodd"
              />
            </svg>
            <Link
              :href="route('myFiles', { folder: ans.path })"
              class="flex items-center text-sm font-medium text-black hover:text-gray-700"
            >
              {{ ans.name }}
            </Link>
          </div>
        </li>
      </ol>
    </nav>
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
          @click="openFolder(file)"
          class="bg-white border-b transition duration-300 ease-in-out hover:bg-gray-100 cursor-pointer"
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
    <div
      v-if="!files.data.length"
      class="py-8 text-center text-sm text-gray-400"
    >
      There is no data in this folder
    </div>
  </AuthenticatedLayout>
</template>

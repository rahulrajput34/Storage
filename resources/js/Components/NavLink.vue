<script setup lang="ts">
import { computed } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps<{
    href: string;
    active?: boolean;
}>();

const classes = computed(() =>
    props.active
        ? 'flex items-center px-5 py-2 border-b-2 border-gray-600 text-sm font-medium leading-5 text-black bg-gray-200 focus:outline-none focus:border-gray-800 transition duration-150 ease-in-out'
        : 'flex items-center px-5 py-2 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-800 hover:text-black hover:border-gray-400 focus:outline-none focus:text-black focus:border-gray-400 transition duration-150 ease-in-out',
);
</script>

<template>
    <Link :href="href" :class="classes">
        <slot />
    </Link>
</template>

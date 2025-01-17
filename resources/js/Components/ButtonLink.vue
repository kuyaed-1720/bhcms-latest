<script setup>
import { computed } from "vue";
import { Link } from "@inertiajs/vue3";

const props = defineProps({
    href: String,
    active: Boolean,
});

const classes = computed(() => {
    return props.active
        ? "inline-flex items-center px-1 pt-1 border-b-2 border-indigo-400 dark:border-indigo-600 text-sm font-medium leading-5 text-gray-900 dark:text-gray-100 focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out"
        : "inline-flex items-center px-4 py-2 dark:bg-gray-800 bg-gray-200 border border-transparent rounded-md font-semibold text-xs dark:text-white text-gray-800 uppercase tracking-widest hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-50 transition ease-in-out duration-150";
});
</script>

<template>
    <Link :href="href" :class="classes">
        <slot />
    </Link>
</template>

<template>
    <nav class="flex items-center justify-between py-3" aria-label="Pagination">
        <div class="hidden sm:block">
            <p class="text-sm text-gray-700">
                Showing
                {{ ' ' }}
                <span class="font-medium">{{ paginator.from }}</span>
                {{ ' ' }}
                to
                {{ ' ' }}
                <span class="font-medium">{{ paginator.to }}</span>
            </p>
        </div>
        <div class="flex flex-1 justify-between sm:justify-end">
            <Link v-show="paginator.prev_page_url" :href="paginator.prev_page_url" class="relative inline-flex items-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus-visible:outline-offset-0">Previous</Link>
            <Link v-show="paginator.next_page_url" :href="paginator.next_page_url" class="ml-2 relative inline-flex items-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus-visible:outline-offset-0">Next</Link>
        </div>
    </nav>
</template>

<script setup>
import {computed} from "vue";
import {Link} from "@inertiajs/vue3";

const props = defineProps(['paginator']);

const items = computed(() => props.paginator.data);
</script>

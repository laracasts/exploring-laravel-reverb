<template>
    <Head title="Your Podcasts"/>

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Your Podcasts</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <ul role="list" class="divide-y divide-gray-100">
                    <li v-for="podcast in podcasts.data" class="flex justify-between gap-x-6 py-5">
                        <div class="flex min-w-0 gap-x-4">
                            <div class="min-w-0 flex-auto">
                                <p class="text-sm font-semibold leading-6 text-gray-900">{{ podcast.name }}</p>
                                <p class="mt-1 truncate text-xs leading-5 text-gray-500">{{ podcast.description }}</p>
                                <form v-if="podcast.status !== 3" @submit.prevent="() => publishPodcast(podcast)" class="mt-2">
                                    <SecondaryButton type="submit" :disabled="podcast.status !== 1">{{ podcast.status === 1 ? 'Publish' : 'Publishing…' }}</SecondaryButton>
                                </form>
                            </div>
                        </div>
                        <div class="hidden shrink-0 sm:flex sm:items-center">
                            <span class="block size-4 rounded-full" :class="{
                                'bg-red-500': podcast.status === 1,
                                'bg-yellow-500 animate-pulse': podcast.status === 2,
                                'bg-green-500': podcast.status === 3,
                            }"></span>
                        </div>
                    </li>
                </ul>

                <SimplePagination :paginator="podcasts" />
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, router} from '@inertiajs/vue3';
import SecondaryButton from "@/Components/SecondaryButton.vue";
import SimplePagination from "@/Components/SimplePagination.vue";

const props = defineProps(['podcasts']);

const publishPodcast = (podcast) => {
    router.put(route('podcasts.publish', podcast.id), {}, {
        preserveScroll: true,
        preserveState: false,
    });
};
</script>

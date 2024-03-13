<template>
    <!-- Notification panel, dynamically insert this into the live region when it needs to be displayed -->
    <transition enter-active-class="transform ease-out duration-300 transition"
                enter-from-class="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"
                enter-to-class="translate-y-0 opacity-100 sm:translate-x-0"
                leave-active-class="transition ease-in duration-100" leave-from-class="opacity-100"
                leave-to-class="opacity-0">
        <li v-if="show"
            class="pointer-events-auto w-full max-w-sm overflow-hidden rounded-lg bg-blue-100 shadow-lg ring-1 ring-black ring-opacity-5">
            <div class="p-4">
                <div class="flex items-center">
                    <div class="flex w-0 flex-1 justify-between">
                        <p class="w-0 flex-1 text-sm font-medium text-gray-700">
                            <slot></slot>
                        </p>
                    </div>
                    <div class="ml-4 flex flex-shrink-0">
                        <button type="button" @click="show = false"
                                class="inline-flex rounded-md bg-blue-50 text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                            <span class="sr-only">Close</span>
                            <XMarkIcon class="h-5 w-5" aria-hidden="true"/>
                        </button>
                    </div>
                </div>
            </div>
        </li>
    </transition>
</template>

<script setup>
import {ref, watchEffect} from 'vue'
import {XMarkIcon} from '@heroicons/vue/20/solid'

const show = defineModel('show');

watchEffect(async (onCleanup) => {
    if (!show.value) {
        return;
    }

    const timeout = setTimeout(() => {
        show.value = false
    }, 5000);
    onCleanup(() => clearTimeout(timeout));
});
</script>

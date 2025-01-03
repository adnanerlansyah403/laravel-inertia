<!-- resources/js/Components/Pagination.vue -->
<template>
    <nav v-if="links?.length > 1" class="flex justify-center my-4">
        <ul class="inline-flex items-center space-x-1">
            <li v-for="(link, index) in links" :key="index">
                <span v-if="link.url === null" class="px-3 py-1 text-gray-500 cursor-not-allowed" v-html="link?.label" />
                <Link
                    v-else
                    as="button"
                    :href="link.url"
                    :class="[
                        'px-3 py-1 border rounded-md',
                        link.active
                        ? 'bg-indigo-600 text-white border-indigo-600'
                        : 'bg-white text-gray-700 border-gray-300 hover:bg-gray-100',
                    ]"
                    v-html="link?.label"
                />
            </li>
        </ul>
    </nav>
</template>

<script setup>
import { defineProps } from 'vue'

defineProps({
  links: {
    type: Array,
    required: true,
  },
})
</script>

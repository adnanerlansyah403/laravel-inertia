<template>
    <div v-if="show" class="fixed inset-0 z-50 flex items-center justify-center bg-gray-900 bg-opacity-50">
        <div class="bg-white rounded-lg shadow-lg max-w-lg w-full p-6 relative">
            <!-- Close Button -->
            <button
                @click="$emit('close')"
                class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 focus:outline-none"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <!-- Modal Content -->
            <slot></slot>
        </div>
    </div>
</template>

<script setup>

defineProps({
    show: {
        type: Boolean,
        required: true
    }
})

</script>

<style scoped>

</style>

<template>
    <div
        v-if="show"
        class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50"
    >
        <div class="bg-white rounded-lg shadow-lg p-6">
            <h3 class="text-xl font-semibold mb-2">{{ title }}</h3>
            <p class="text-gray-700 mb-4">{{ message }}</p>
            <div class="flex space-x-4">
                <button
                    type="button"
                    @click="$emit('cancel')"
                    class="bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-200"
                >
                    Batal
                </button>
                <button
                    type="button"
                    @click="$emit('confirm')"
                    class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-500"
                >
                    Konfirmasi
                </button>
            </div>
        </div>
    </div>
</template>

<script setup>

const props = defineProps({
    show: Boolean,
    title: String,
    message: String
})

const emit = defineEmits(['cancel', 'confirm'])

</script>

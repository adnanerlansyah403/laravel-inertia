<template>
    <div
        v-if="show"
        class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50"
    >
        <!-- Backdrop klik untuk menutup -->
        <div
            class="absolute inset-0"
            @click="handleBackdropClick"
        ></div>

        <div
            class="bg-white rounded-lg shadow-lg p-6 z-10"
            @animationend="handleAnimationEnd"
        >
            <h3 class="text-xl font-semibold mb-2">{{ title }}</h3>
            <p class="text-gray-700 mb-4">{{ message }}</p>
            <div class="flex space-x-4">
                <button
                    type="button"
                    @click="handleCancel"
                    class="bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-200"
                >
                    Batal
                </button>
                <button
                    type="button"
                    @click="handleConfirm"
                    class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-500"
                >
                    Konfirmasi
                </button>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';

const props = defineProps({
    show: Boolean,    // Kontrol visibilitas modal
    title: String,    // Judul modal
    message: String   // Pesan modal
});

const emit = defineEmits(['cancel', 'confirm', 'closed']); // Menambahkan event 'closed'

const handleBackdropClick = () => {
    // Emisi event cancel jika backdrop diklik
    emit('cancel');
};

const handleCancel = () => {
    // Menangani tombol batal
    emit('cancel');
};

const handleConfirm = () => {
    // Menangani tombol konfirmasi
    emit('confirm');
};

const handleAnimationEnd = () => {
    // Emisi event saat animasi selesai (untuk efek transisi modal)
    emit('closed');
};
</script>

<style>
/* Tambahkan animasi untuk modal */
.bg-white {
    animation: fadeIn 0.3s ease-out;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: scale(0.95);
    }
    to {
        opacity: 1;
        transform: scale(1);
    }
}
</style>

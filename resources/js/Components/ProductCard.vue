<template>
    <div class="border border-gray-300 rounded-lg p-4 mb-4">
      <div class="mb-4">
        <img
          class="w-full h-auto rounded-md"
          :src="product?.image_url"
          :alt="product?.name"
        />
      </div>
      <div>
        <h3 class="text-lg font-semibold">{{ product?.name }}</h3>
        <p class="text-gray-700">{{ formatPrice(product?.price) }}</p>
        <div class="flex items-center gap-2 mt-2">
            <button
              @click="addToCart"
              class="bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-500"
            >
              Tambah ke Keranjang
            </button>
            <button
                type="button"
                @click="showDeleteConfirmation"
                class="border border-red-600 text-red-600 py-2 px-4 rounded hover:bg-red-600 hover:text-white"
            >
                Hapus Produk
            </button>
        </div>
      </div>

      <!-- Modal Confirmation -->
      <ConfirmationDialog
        :show="showModal"
        title="Konfirmasi Hapus"
        message="Apakah Anda yakin ingin menghapus produk ini?"
        @cancel="showModal = false"
        @confirm="deleteProduct"
      />
    </div>
</template>

<script setup>
import ConfirmationDialog from '@/Components/ConfirmationDialog.vue';
import { ref } from 'vue';


const props = defineProps({
    product: {
        type: Object,
        required: true,
        default: null
    }
})

const showModal = ref(false); // State to control the modal visibility

const emit = defineEmits(['add-to-cart'])

const formatPrice = (price) => {
    return new Intl.NumberFormat("id-ID", {
        style: "currency",
        currency: "IDR",
    }).format(price);
}

// Show the confirmation dialog when deleting
const showDeleteConfirmation = () => {
    showModal.value = true;
}

const addToCard = () => {
    emit('add-to-cart', props.product.value)
}

const deleteProduct = () => {
    showModal.value = false;
}

</script>

<style scoped>

</style>

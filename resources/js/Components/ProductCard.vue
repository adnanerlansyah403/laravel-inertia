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
        <button
          @click="addToCart"
          class="mt-2 bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-500"
        >
          Tambah ke Keranjang
        </button>
      </div>
    </div>
</template>

<script setup>

const props = defineProps({
    product: {
        type: Object,
        required: true,
        default: null
    }
})

const emit = defineEmits(['add-to-cart'])

const formatPrice = (price) => {
    return new Intl.NumberFormat("id-ID", {
        style: "currency",
        currency: "IDR",
    }).format(price);
}

const addToCard = () => {
    emit('add-to-cart', props.product.value)
}

</script>

<style scoped>

</style>

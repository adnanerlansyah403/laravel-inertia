<template>
    <Head :title="`Edit Produk ${product?.name}`" />
    <Link href="/products" class="block text-blue-500 mb-6">Kembali</Link>
    <div class="bg-white px-4 py-6 rounded-lg">
        <ProductForm :product="product" :categories="categories" />
    </div>
</template>

<script setup>
import ProductForm from '@/Components/ProductForm.vue';

const props = defineProps({
    product: Object,
    categories: Array
})

</script>

<style scoped>

</style>

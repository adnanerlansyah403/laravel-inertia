<template>
    <form @submit.prevent="submitForm">

        <div class="space-y-2">
            <TextField
                id="product-name"
                v-model="form.name"
                label="Nama Produk"
                :error="form.errors.name"
                placeholder="Masukkan nama produk..."
            />

            <!-- Select -->
            <TextField
                id="product-category"
                label="Kategori"
                type="select"
                :options="categoryOptions"
                v-model="form.category_id"
                :error="form.errors.category_id"
                placeholder="Pilih Kategori"
            />

            <TextField
                id="product-price"
                v-model="form.price"
                label="Harga"
                type="number"
                :error="form.errors.price"
                placeholder="Masukkan harga produk..."
            />

            <!-- Textarea -->
            <TextField
                id="product-description"
                label="Deskripsi"
                type="textarea"
                v-model="form.description"
                :error="form.errors.description"
                placeholder="Masukkan deskripsi produk..."
            />

            <!-- File Input -->
            <TextField
                id="product-image"
                label="Gambar"
                type="file"
                v-model="form.image"
                :error="form.errors.image"
                placeholder="Masukkan gambar..."
            />
        </div>

        <button
                type="submit"
                :disabled="form.processing"
                class="w-full flex justify-center py-2 px-4 mt-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
            >
            {{ form.processing ? 'Menyimpan...' : 'Simpan Produk' }}
        </button>

    </form>
</template>

<script setup>
import TextField from '@/Components/Form/TextField.vue';
import { useForm } from '@inertiajs/vue3';
import { computed, ref } from 'vue';

const props = defineProps({
    product: Object,
    categories: Array
})

// Reactive States
const categoryOptions = computed(() =>
  props.categories.map(({ id, name }) => ({
    value: id,
    label: name,
  }))
);

const form = useForm({
    category_id: props?.product?.id ?? '',
    name: props?.product?.name ?? '',
    price: props?.product?.price ?? 0,
    description: props?.product?.description ?? '',
    image: null,
})

// Handle File Input
const handleFileChange = (event) => {
    const file = event.target.files[0]; // Get the first selected file
    form.image = file; // Assign file to the form's image property
};

const submitForm = () => {
    form.post('/products', {
        onSuccess: () => {
            form.reset()
            emit('success')
        }
    })
}

</script>

<style scoped>

</style>

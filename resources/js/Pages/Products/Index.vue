<template>
    <Head title="Products" />
    <div>
        <div class="flex space-x-4 mb-4">
            <input
                type="text"
                v-model="search"
                @input="debounceSearch"
                class="border border-gray-300 rounded p-2 flex-1"
                placeholder="Cari produk..."
            />
            <select
                v-model="selectedCategory"
                @change="filterProducts"
                class="border border-gray-300 rounded p-2"
            >
                <option value="" disabled>Semua Kategori</option>
                <option
                    v-for="category in categories"
                    :key="category.id"
                    :value="category.id"
                >
                    {{ category?.name }}
                </option>
            </select>
            <button @click="showForm = true;" type="button" class="inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700">
                Tambah Projek
            </button>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <template v-if="products?.data">
                <ProductCard
                    v-for="product in filteredProducts"
                    :key="product.id"
                    :product="product"
                    @add-to-cart="handleAddToCart"
                />
            </template>
        </div>

        <!-- Form Modal -->
        <Modal :show="showForm" @close="showForm = false">
            <ProductForm
                :categories="categories"
                @success="showForm = false"
            />
        </Modal>

    </div>
</template>

<script setup>
import ProductCard from "@/Components/ProductCard.vue";
import debounce from "debounce";
import { computed, ref } from "vue";
import { router } from "@inertiajs/vue3";
import ProductForm from "@/Components/ProductForm.vue";
import Modal from "@/Components/Modal.vue";

// Props
const props = defineProps({
  products: {
    type: Object || Array,
    default: null,
  },
  categories: Array,
});

// Reactive State
const showForm = ref(false);
const search = ref("");
const selectedCategory = ref("");

// Computed properties
const filteredProducts = computed(() => {
  return props.products.data;
});

// Debounced search
const debounceSearch = debounce(() => {
  const query = {};
  if (search.value) query.search = search.value;
  if (selectedCategory.value) query.category = selectedCategory.value;

  router.visit(`/products`, {
    method: "get",
    data: query,
    preserveState: true,
    replace: true,
  });
}, 300);

// Filter products
const filterProducts = () => {
  const query = {};
  if (search.value) query.search = search.value;
  if (selectedCategory.value) query.category = selectedCategory.value;

  router.visit(`/products`, {
    method: "get",
    data: query,
    preserveState: true,
    replace: true,
  });
};

// Reset filters
const resetFilters = () => {
  search.value = "";
  selectedCategory.value = "";

  router.visit(`/products`, {
    method: "get",
    replace: true,
  });
};

// Handle add to cart
const handleAddToCart = (product) => {
  // Implementasi logika tambah ke keranjang
};
</script>

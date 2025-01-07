<!-- resources/js/Layouts/AppLayout.vue -->
<template>
    <div class="min-h-screen bg-gray-100">

      <!-- Navigasi -->
      <nav class="bg-white border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div class="flex justify-between h-16">
            <div class="flex">
              <Link href="/dashboard" class="flex-shrink-0 flex items-center">
                <span class="text-xl font-bold">LaraVue App</span>
              </Link>
              <div class="hidden sm:ml-6 sm:flex sm:space-x-8 items-center">
                <NavLink href="/dashboard" :active="$page.url.endsWith('/dashboard')">
                  Dashboard
                </NavLink>
                <NavLink href="/projects" :active="$page.url.endsWith('/projects')">
                  Projects
                </NavLink>
                <NavLink href="/products" :active="$page.url.endsWith('/products')">
                  Products
                </NavLink>
              </div>
            </div>
            <div class="flex items-center gap-2">
                <button @click="toggleTheme" :class="buttonClass" :disabled="loading" class="px-1 pt-1 pb-2">
                    <span v-if="loading">Switching...</span>
                    <span v-else>{{ darkMode ? 'Light Mode' : 'Dark Mode' }}</span>
                </button>
                <NavLink href="/auth/logout">Sign Out</NavLink>
            </div>
          </div>
        </div>
      </nav>

      <!-- Konten Utama -->
      <main class="py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <slot></slot>
        </div>
      </main>

    </div>
</template>

<script setup>
import NavLink from '@/Components/NavLink.vue'
import { router } from '@inertiajs/vue3';
import { computed, ref, watch } from 'vue';

const props = defineProps({
    dark_mode: Boolean
});

// Dark mode berasal dari shared data di Inertia
const darkMode = ref(props.dark_mode || false);
const loading = ref(false);

// Update local state jika shared data berubah
watch(() => props.dark_mode, (newVal) => {
    darkMode.value = newVal;
});

// Kelas tombol tergantung pada tema
const buttonClass = computed(() => (darkMode.value ? 'bg-gray-800 text-white' : 'bg-white text-gray-800'));

const toggleTheme = () => {
   router.post('/theme/toggle', {}, {
        onSuccess: () => {
            // Setelah sukses, toggle tema secara lokal
            darkMode.value = !darkMode.value;
            if(darkMode.value) document.querySelector('html').classList.toggle('dark')
            else document.querySelector('html').classList.remove('dark')
        },
        onFinish: () => {
            loading.value = false;
        }
    });
}
</script>

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

</script>

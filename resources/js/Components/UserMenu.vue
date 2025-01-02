<!-- resources/js/Components/UserMenu.vue -->
<template>
    <div class="relative">
      <button @click="isOpen = !isOpen" class="flex items-center space-x-2 text-sm focus:outline-none">
        <span>{{ $page.props.user?.name }}</span>
        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
        </svg>
      </button>
      <div v-if="isOpen" class="absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5">
        <div class="py-1">
          <Link href="/profile" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</Link>
          <Link href="/logout" method="post" as="button" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Logout</Link>
        </div>
      </div>
    </div>
  </template>

  <script setup>
  import { ref } from 'vue'

  const isOpen = ref(false)
  </script>

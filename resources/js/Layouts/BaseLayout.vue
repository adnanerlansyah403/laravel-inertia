<template>
    <div>
        <!-- FlashMessage will display flash messages, if available -->
        <FlashMessage />

        <!-- This will render the page content -->
        <slot />
    </div>
  </template>

<script setup>
import FlashMessage from '@/Components/FlashMessage.vue'; // Path to the FlashMessage component
  import { ref, onMounted, onUnmounted, watch } from 'vue';
  import { usePage } from '@inertiajs/vue3';

  // Access the flash message from the shared data
  const props = usePage().props;

  // Store the flash message in a ref
  const flashMessage = ref(props.flash?.message);

  // Watch for changes in flash.message
  watch(() => props, (newMessage) => {
    // flashMessage.value = newMessage;  // Update the flash message if it changes
    if (newMessage) {
      setTimeout(() => {
        flashMessage.value = null;  // Hide the message after 5 seconds
      }, 5000);
    }
  });
</script>

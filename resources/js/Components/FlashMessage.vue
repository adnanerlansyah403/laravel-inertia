<script setup>
import { usePage } from '@inertiajs/vue3';
import { computed, ref, watch } from 'vue';

const page = usePage();

const showFlash = ref(false);

const flash = computed(function () {
  return page.props.flash;
});

watch(page, function (val) {
    if (val?.props?.flash) {
        showFlash.value = true;
    }
    setTimeout(() => {
        closeFlashMessage()
    }, 5000)
}, {
  immediate: true,
  deep: true,
});

// Function to close the flash message
const closeFlashMessage = () => {
    // usePage().props.flash.message = null;
    showFlash.value = false;
};

</script>

<template>
    <!-- Show the flash message if it exists -->
    <div v-if="showFlash && flash.message" class="fixed top-0 left-1/2 transform -translate-x-1/2 max-w-md w-full mt-4 bg-green-500 text-white p-4 rounded shadow-md">
      <div class="w-full flex items-center justify-between">
        <h4>{{ flash.message }}</h4>
        <!-- Close button -->
        <button @click="closeFlashMessage" class="text-2xl text-white font-bold">
          &times;
        </button>
      </div>
    </div>
</template>

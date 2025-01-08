<script setup lang="ts">
import BaseLayout from './BaseLayout.vue';

</script>

<template>
    <BaseLayout>
        <div class="min-h-screen flex justify-center items-center bg-gray-100">
            <slot></slot>
        </div>
    </BaseLayout>
</template>

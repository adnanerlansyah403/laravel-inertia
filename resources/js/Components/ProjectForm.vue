<template>
    <form @submit.prevent="submit" class="space-y-6">
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700">Nama Proyek</label>
            <input
                type="text"
                v-model="form.name"
                placeholder="Masukkan nama projek..."
                class="mt-1 px-4 py-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500"
                :class="{ 'border-red-500': form.errors.name }"
            >
            <div v-if="form.errors.name" class="text-red-500 text-sm mt-1">
                {{ form.errors.name }}
            </div>
        </div>
        <div>
            <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi</label>
            <textarea
                v-model="form.description"
                placeholder="Masukkan deskripsi projek..."
                rows="3"
                class="mt-1 px-4 py-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500"
                :class="{ 'border-red-500': form.errors.description }"
            ></textarea>
            <div v-if="form.errors.description" class="text-red-500 text-sm mt-1">
                {{ form.errors.description }}
            </div>
        </div>
        <div>
            <button
                type="submit"
                :disabled="form.processing"
                class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
            >
                {{ form.processing ? 'Menyimpan...' : 'Simpan Proyek' }}
            </button>
        </div>
    </form>
</template>

<script setup>

import { useForm } from '@inertiajs/vue3';

const form = useForm({
    name: '',
    description: ''
})

const submit = () => {
    form.post('/projects', {
        onSuccess: () => form.reset()
    })
}

</script>

<style scoped>

</style>

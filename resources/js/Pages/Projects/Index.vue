<template>
    <Head title="Projects" />
    <div class="projects p-6">
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <div class="text-2xl font-semibold text-gray-900">Projects</div>
            </div>
            <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                <button @click="showForm = true;" type="button" class="inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700">
                    Add Project
                </button>
            </div>
        </div>

        <!-- Project List -->
        <div class="mt-8 flex flex-col">
            <input type="text" v-model="search" @input="filterProjects" placeholder="Cari Projek..." class="mt-2 px-4 py-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500">
            <div class="inline-block min-w-full py-2 align-middle">
                <div class="overflow-hidden shadow-sm ring-1 ring-black ring-opacity-5">
                    <table class="min-w-full divide-y divide-gray-300">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900">
                                    Name
                                </th>
                                <th class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                    Description
                                </th>
                                <th class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                    Category
                                </th>
                                <th class="relative py-3.5 pl-3 pr-4">
                                    <span class="sr-only">Actions</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white">
                            <tr v-for="project in projects.data" :key="project.id">
                                <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900">
                                    {{ project.name }}
                                </td>
                                <td class="px-3 py-4 text-sm text-gray-500">
                                    {{ project.description }}
                                </td>
                                <td class="px-3 py-4 text-sm text-gray-500">
                                    {{ project?.category?.name ?? 'Tidak ada Kategori' }}
                                </td>
                                <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium">
                                    <Link :href="`/projects/${project.id}/edit`" class="text-indigo-600 hover:text-indigo-900">
                                    Edit
                                    </Link>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <Pagination :links="projects.links" />
                </div>
            </div>
        </div>

        <!-- Form Modal -->
        <Modal :show="showForm" @close="showForm = false">
            <ProjectForm @success="showForm = false" />
        </Modal>

    </div>
</template>

<script setup>
import { ref } from "vue";
import { router } from '@inertiajs/vue3'
import ProjectForm from "@/Components/ProjectForm.vue";
import Pagination from "@/Components/Pagination.vue";
import Modal from "@/Components/Modal.vue";

defineProps({
    projects: {
        type: Object || Array,
        // required: true
        default: null
    }
})

const showForm = ref(false);
const search = ref('')

const filterProjects = () => {
    const query = {}
    if(search.value) query.search = search.value
    router.visit(`/projects`, {
        method: 'get',
        data: query,
        preserveState: true,
        replace: true,
    });
}

</script>

<style scoped>

</style>

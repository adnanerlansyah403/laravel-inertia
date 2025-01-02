<template>
    <Head title="Dashboard" />
    <div class="dashboard p-6">
        <h1 class="text-3xl font-bold mb-6">{{ title }}</h1>
        {{ $page.props.app.name }}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            <div class="bg-white p-4 rounded-lg shadow">
                <h3 class="text-lg font-semibold mb-2">Total Tasks</h3>
                <p class="text-2xl text-blue-600">{{ stats.total_tasks }}</p>
            </div>
            <div class="bg-white p-4 rounded-lg shadow">
                <h3 class="text-lg font-semibold mb-2">Completed</h3>
                <p class="text-2xl text-blue-600">{{ stats.completed_tasks }}</p>
            </div>
            <div class="bg-white p-4 rounded-lg shadow">
                <h3 class="text-lg font-semibold mb-2">Pending</h3>
                <p class="text-2xl text-blue-600">{{ stats.pending_tasks }}</p>
            </div>
            <div class="bg-white p-4 rounded-lg shadow">
                <h3 class="text-lg font-semibold mb-2">Completion Rate</h3>
                <p class="text-2xl text-blue-600">{{ stats.completion_rate }}</p>
            </div>
        </div>

        <div class="mt-6 text-sm text-gray-500">
            Last updated: {{ last_updated }}
        </div>
    </div>
</template>

<script setup>
defineProps({
    title: String,
    stats: Object,
    last_updated: String
})
</script>

<style scoped>

</style>

<template>
    <div class="mb-4">
        <!-- Label -->
        <label v-if="label" :for="id" class="block text-gray-700 mb-1">
            {{ label }}
        </label>

        <!-- Dynamic Component -->
        <component
            :is="element"
            :id="id"
            v-bind="attrs"
            v-model="localValue"
            @input="handleInput"
            @change="handleFileInput"
            class="border border-gray-300 rounded p-2 w-full focus:ring-2 focus:ring-blue-500"
            :class="{ 'border-red-500': error }"
            :placeholder="placeholder"
        >
            <!-- Select options -->
            <template v-if="type === 'select'">
                <option value="" selected disabled>{{ placeholder }}</option>
                <option :value="option.value" v-for="option in options" :key="option.value">
                    {{ option.label }}
                </option>
            </template>
        </component>

        <!-- Tampilkan Error -->
        <div v-if="error" class="text-red-500 text-sm mt-1">
            {{ error }}
        </div>
    </div>
</template>

<script setup>
import { computed, ref } from 'vue';

// Props
const props = defineProps({
    label: String,
    modelValue: [String, Number, File, Array], // Tambahkan tipe File dan Array
    type: {
        type: String,
        default: 'text', // Default input type
    },
    error: String,
    id: {
        type: String,
        required: true,
    },
    placeholder: String,
    options: {
        type: Array,
        default: () => [],
    },
});

// Emit event
const emit = defineEmits(['update:modelValue']);

// Elemen dinamis (input, textarea, select, dll.)
const element = computed(() => {
    if (props.type === 'textarea') return 'textarea';
    if (props.type === 'select') return 'select';
    return 'input'; // Default: input
});

// Tambahkan atribut tambahan berdasarkan jenis input
const attrs = computed(() => {
    const baseAttrs = { type: props.type }; // Pasang type di atribut
    if (props.type === 'textarea') {
        return { rows: 4, ...baseAttrs };
    }
    return baseAttrs;
});

// Local state untuk file input
const localValue = ref(props.modelValue);

// Handle input event
const handleInput = (event) => {
    if (props.type !== 'file') {
        emit('update:modelValue', event.target.value);
    }
};

// Handle file input secara spesifik
const handleFileInput = (event) => {
    if (props.type === 'file') {
        const files = event.target.files.length > 1 ? [...event.target.files] : event.target.files[0];
        emit('update:modelValue', files); // Emit file (single atau multiple)
    }
};
</script>

<style scoped>
/* Tambahkan styling jika diperlukan */
</style>

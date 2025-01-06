<template>
    <div class="mb-4">
        <label v-if="label" :for="id" class="block text-gray-700 mb-1">
            {{ label }}
        </label>
        <!-- <input
            :id="id"
            :type="type"
            :value="modelValue"
            @input="$emit('update:modelValue', $event.target.value)"
            class="border border-gray-300 rounded p-2 w-full focus:ring-2 focus:ring-blue-500"
            :class="{ 'border-red-500': error }"
        > -->
        <component
            :is="element"
            :id="id"
            v-bind="attrs"
            :value="modelValue"
            @input="$emit('update:modelValue', $event.target.value)"
            class="border border-gray-300 rounded p-2 w-full focus:ring-2 focus:ring-blue-500"
            :class="{ 'border-red-500': error }"
            :placeholder="placeholder"
        >
            <template v-if="type == 'select'">
                <option value="" disabled>{{ placeholder }}</option>
                <option :value="option.value" v-for="option in options" :key="option.value">{{ option.label }}</option>
            </template>
        </component>
        <div v-if="error" class="text-red-500 text-sm mt-1">
            {{ error }}
        </div>
    </div>
</template>

<script setup>
import { computed } from 'vue';


// Define props
const props = defineProps({
    label: String,
    modelValue: [String, Number],
    type: {
        type: String,
        default: 'text'
    },
    error: String,
    id: {
        type: String,
        required: true
    },
    placeholder: String,
    options: {
        type: Array,
        default: () => []
    }
})

const emit = defineEmits(['update:modelValue'])

const element = computed(() => {
    if (props.type == 'textarea') return 'textarea';
    if (props.type === 'select') return 'select';
    return 'input'; // Default nya input
})

const attrs = computed(() => {
    const baseAttrs = {};
    if (props.type === 'textarea') {
        return { rows: 4, ...baseAttrs };
    }
    return baseAttrs;
})

</script>

<style scoped>

</style>

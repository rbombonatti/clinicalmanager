<script setup>
import { ref, watch } from 'vue';


const model = defineModel({
    type: String,
    required: true,
});

const props = defineProps({
    currency: {
        type: Boolean,
        default: false,
    },
});

const input = ref(null);

function formatCurrency(value) {
    let val = (value.replace(/\D/g, '') / 100).toFixed(2);
    return `R$ ${val.toString().replace('.', ',').replace(/\B(?=(\d{3})+(?!\d))/g, '.').substring(0,10)}`;
}

watch(model, (newValue, oldValue) => {
    if (props.currency && newValue !== formatCurrency(oldValue)) {
        model.value = formatCurrency(newValue);
    }
});
</script>

<template>
    <input
        class="focus:ring-indigo-500 shadow-sm appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
        v-model="model"
        ref="input"
    />
</template>

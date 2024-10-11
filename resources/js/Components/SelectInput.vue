<script setup>
import { ref, watch, defineProps, defineEmits } from 'vue';

const props = defineProps({
    options: {
        type: Array,
        required: true,
    },
    modelValue: {
        type: [String, Number],
        required: true,
    },
    valueKey: {
        type: String,
        required: true,
        default: 'id'
    },
    textKey: {
        type: String,
        required: true,
        default: 'title',
    }

});
const emit = defineEmits(["update:modelValue"]);
const selected = ref(props.modelValue);

watch(() => props.modelValue, (newValue) => {
    selected.value = newValue;
})

const onChange = (event) => {
    emit("update:modelValue", event.target.value);
};
</script>

<template>
    <select
        @change="onChange" :value="selected" v-bind="$attrs" class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white"
        required
    >
        <option disabled value="">Select...</option>
        <option
            v-for="(item, index) in options"
            :key="index"
            :value="item[valueKey]"
            :disabled="item.deleted_at"

        >
            {{ item[textKey] }}
        </option>
    </select>
</template>

<style scoped></style>

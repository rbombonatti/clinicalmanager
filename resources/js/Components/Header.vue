<script setup>
defineProps({
    title: String
})
</script>
<template>
    <div class="mb-0 bg-white w-1/4 p-3 rounded-t-lg">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-left pl-2">
            {{ title }}
        </h2>
    </div>

</template>

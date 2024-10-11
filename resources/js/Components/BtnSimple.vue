<script setup>
import {Link} from "@inertiajs/vue3";
const props = defineProps({
    routeName: {
        type: String,
        required: true,
    },
})
</script>

<template>
    <Link
        :href="`${routeName}`"
        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-2">
        <slot />
    </Link>
</template>

<style scoped>

</style>

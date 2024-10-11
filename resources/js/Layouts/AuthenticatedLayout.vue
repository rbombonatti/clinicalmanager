<script setup>
import NavBar from "@/Components/NavBar.vue";

</script>

<template>
    <div class="min-h-screen bg-gray-100">
        <NavBar />
        <header class="bg-white shadow">
        </header>
        <main>
            <div class="mx-auto w-full px-4 py-6 sm:px-6 lg:px-8">
                <slot />
            </div>
        </main>
    </div>
</template>



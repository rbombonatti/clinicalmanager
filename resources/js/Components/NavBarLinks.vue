<script setup>
import { ref } from "vue";
import NavLink from "@/Components/NavLink.vue";

// Estados para controlar a visibilidade dos dropdowns
const showMenu1 = ref(false);
const showMenu2 = ref(false);

// Funções para alternar a visibilidade dos menus
function toggleMenu1() {
    showMenu1.value = !showMenu1.value;
}

function toggleMenu2() {
    showMenu2.value = !showMenu2.value;
}
</script>

<template>
    <div class="ml-10 flex items-baseline space-x-4 text-sm">
        <NavLink :href="route('dashboard')" :active="route().current('dashboard')">{{ $t('home') }}</NavLink>
        <div class="relative w-24">
            <button
                @click="toggleMenu1"
                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                <span>{{ $t('doctors') }}</span>
                <svg class="ml-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                </svg>
            </button>

            <div v-if="showMenu1" class="absolute dropdown-box mt-2 bg-white rounded-md shadow-lg ring-1 ring-black ring-opacity-5 z-10">
                <NavLink :href="route('doctors.index')" :active="route().current('doctors.index')" class="block w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">{{ $t('doctors') }}</NavLink>
                <NavLink :href="route('roles.index')" :active="route().current('roles.index')" class="block w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">{{ $t('roles') }}</NavLink>
                <NavLink :href="route('specialties.index')" :active="route().current('specialties.index')" class="block w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">{{ $t('specialties') }}</NavLink>
            </div>
        </div>
        <div class="relative">
            <button
                @click="toggleMenu2"
                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                <span>{{ $t('finance') }}</span>
                <svg class="ml-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                </svg>
            </button>
            <div v-if="showMenu2" class="absolute  mt-2 bg-white rounded-md shadow-lg ring-1 ring-black ring-opacity-5 z-10 w-72 dropdown-box">
                <NavLink :href="route('procedures.index')" :active="route().current('procedures.index')" class="block w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">{{ $t('procedures') }}</NavLink>
                <NavLink :href="route('healthinsuranceplans.index')" :active="route().current('healthinsuranceplans.index')" class="block w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">{{ $t('healthinsuranceplans') }}</NavLink>
                <NavLink :href="route('pricelists.index')" :active="route().current('pricelists.index')" class="block px-4 py-2 text-sm  w-full text-gray-700 hover:bg-gray-100">{{ $t('pricelists') }}</NavLink>
                <NavLink :href="route('procedureprices.index')" :active="route().current('procedureprices.index')" class="block  w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">{{ $t('procedureprices') }}</NavLink>
            </div>
        </div>
        <NavLink :href="route('consultations.index')" :active="route().current('consultations.index')">{{ $t('consultation') }}</NavLink>
    </div>
</template>

<style scoped>
.dropdown-box {
    padding: 2px;
}
</style>

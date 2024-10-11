<script setup>
import { ref } from "vue";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import NavBarLinks from "@/Components/NavBarLinks.vue";
import { Link } from '@inertiajs/vue3';

defineProps({
    request: Object
})

const showDropdown = ref(false);

function toggleDropdown() {
    showDropdown.value = !showDropdown.value;
}


</script>

<template>
    <nav class="bg-white border-b border-gray-100 py-2">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex h-16 items-center justify-between">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <ApplicationLogo/>
                    </div>
                    <div class="hidden md:block">
                        <NavBarLinks />
                    </div>
                </div>
                <div class="hidden md:block">
                    <div class="ml-4 flex items-center md:ml-6">
                        <div class="hidden sm:flex sm:items-center sm:ms-6 relative">
                            <button
                                @click="toggleDropdown"
                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                <div>{{ $page.props.auth.user.name }}</div>
                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                         viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                              d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                              clip-rule="evenodd"/>
                                    </svg>
                                </div>
                            </button>
                            <div v-if="showDropdown" class="absolute right-0 mt-32 w-32 bg-white rounded-md shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
                                <Link :href="route('profile.edit')" method="get" as="button" class="inline-flex items-center  dropdown-item px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 w-full">
                                    Edit Profile
                                </Link>
                                <Link :href="route('logout')" method="post" as="button" class="inline-flex items-center dropdown-item px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 w-full">
                                    Logout
                                </Link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</template>

<style scoped>

</style>

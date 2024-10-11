<script setup>
import Header from "@/Components/Header.vue";
import { useI18n } from 'vue-i18n';
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {Head, Link } from "@inertiajs/vue3";
import 'vue-toast-notification/dist/theme-sugar.css';
import BtnDeleteForm from "@/Components/BtnDeleteForm.vue";
import Pagination from "@/Components/Pagination.vue";
import SearchBar from "@/Components/SearchBar.vue";
import { useFormatReal } from "@/composables/useFormatReal.js";

const { t } = useI18n();
const routeName = 'procedureprices';
const { formatReal } = useFormatReal();

const props = defineProps({
    request: {
        type: Object,
    },
    procedureprices: {
        type: Object,
    },

})

</script>

<template>
    <AuthenticatedLayout>
        <Head :title="t(`${routeName}`)" />
        <div class="py-1">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <Header :title="t(`${routeName}`)" />
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-b-lg">
                    <div class="p-6 text-gray-900">
                        <SearchBar :placeholder="`${routeName}_search`" :routeName="routeName" :modelValue="request.search" />
                        <div class="hidden lg:flex lg:gap-x-12">
                            <Link :href="route(`${routeName}.create`)" class="edit-button hover:bg-blue-700 mb-4">{{ $t('create_new') }}</Link>
                        </div>
                        <div class="space-y-4">
                            <div class="flex px-4 py-6 border border-gray-200" v-for="procedureprice in procedureprices.data">
                                <div class="md:w-3/4">
                                    <div class="flex">
                                        <div class="flex-1">
                                            <b>{{ procedureprice.procedure.title }}</b>
                                            <br>
                                            <span class="text-xs">{{ procedureprice.health_insurance_plan.title }}</span>
                                        </div>
                                        <div class="flex-1">
                                            {{ formatReal(procedureprice.price) }}
                                        </div>
                                    </div>

                                </div>
                                <div class="md:w-1/4">
                                    <BtnDeleteForm :routeName="routeName" :subjectId="procedureprice.id" >{{ t('delete') }}</BtnDeleteForm>
                                    <Link :href="route(`${routeName}.edit`, {procedureprice})" class="edit-button hover:bg-blue-700">{{ $t('edit') }}</Link>
                                    <Link :href="route(`${routeName}.show`, {procedureprice})" class="edit-button hover:bg-blue-700 ml-2">{{ $t('details') }}</Link>
                                </div>
                            </div>
                        </div>
                        <div v-if="(!procedureprices.total)" class="text-sm text-center mt-4 mb-4">{{ t('no_results') }}</div>
                    </div>
                </div>
                <Pagination :pagination="procedureprices"></Pagination>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>

</style>

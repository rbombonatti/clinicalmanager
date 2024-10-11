<script setup>
import Header from "@/Components/Header.vue";
import { useI18n } from 'vue-i18n';
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {Head, Link, useForm } from "@inertiajs/vue3";
import 'vue-toast-notification/dist/theme-sugar.css';
import BtnDeleteForm from "@/Components/BtnDeleteForm.vue";
import Pagination from "@/Components/Pagination.vue";
import SearchBar from "@/Components/SearchBar.vue";
import {useToast} from 'vue-toast-notification';

const { t } = useI18n();
const routeName = 'healthinsuranceplans';
const toast = useToast();

const props = defineProps({
    request: {
        type: Object,
    },
    healthinsuranceplans: {
        type: Object,
    },
    totalProcedures: Number,
})

const navigateToProcedurePrices = (healthinsuranceplan) => {
    const form = useForm({
        healthinsuranceplan: healthinsuranceplan,
    });
    form.get(route('generateProcedurePricesAtNewHealthInsurancePlan', healthinsuranceplan), {
        onSuccess: () => toast.success(t('generate_procedure_prices_success')),
        preserveScroll: true,
    })
}

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
                            <div class="flex px-4 py-6 border border-gray-200" v-for="healthinsuranceplan in healthinsuranceplans.data">
                                <div class="md:w-3/4">
                                    <b>{{ healthinsuranceplan.title }}</b>
                                    <br>
                                    <span class="text-xs">{{ healthinsuranceplan.procedure_prices.length }} / {{ totalProcedures }} {{ t('procedures')}}</span>
                                    <br>
                                    <Link
                                        v-if="healthinsuranceplan.procedure_prices.length < totalProcedures"
                                        href="#"
                                        @click.prevent="navigateToProcedurePrices(healthinsuranceplan)"
                                        class="generate-button hover:bg-blue-700">{{ $t('generate_procedure_prices') }}
                                    </Link>
                                </div>
                                <div class="md:w-1/4">
                                    <BtnDeleteForm :routeName="routeName" :subjectId="healthinsuranceplan.id" >{{ t('delete') }}</BtnDeleteForm>
                                    <Link :href="route(`${routeName}.edit`, {healthinsuranceplan})" class="edit-button hover:bg-blue-700">{{ $t('edit') }}</Link>
                                    <Link :href="route(`${routeName}.show`, {healthinsuranceplan})" class="edit-button hover:bg-blue-700 ml-2">{{ $t('details') }}</Link>


                                </div>
                            </div>
                        </div>
                        <div v-if="(!healthinsuranceplans.total)" class="text-sm text-center mt-4 mb-4">{{ t('no_results') }}</div>
                    </div>
                </div>
                <Pagination :pagination="healthinsuranceplans"></Pagination>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>

</style>

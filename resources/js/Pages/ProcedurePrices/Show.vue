<script setup>

import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {useI18n} from 'vue-i18n';
import {Head} from "@inertiajs/vue3";
import Header from "@/Components/Header.vue"
import FooterShow from "@/Components/FooterShow.vue";
import { useFormatReal} from "@/composables/useFormatReal.js";
import InputLabel from "@/Components/InputLabel.vue";

const {t} = useI18n();
const { formatReal } = useFormatReal();
const routeName = 'procedureprices';

const props = defineProps({
    procedureprice: Object,
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
                            <div class="w-full px-3 mb-6 mt-6 md:mb-0">
                                <InputLabel for="health_insurance_plan_id" :value="t('healthinsuranceplan')" />
                                {{ procedureprice.health_insurance_plan.title }}
                            </div>
                            <div class="w-full px-3 mb-6 mt-6 md:mb-0">
                                <InputLabel for="title" :value="t('procedure')" />
                                {{ procedureprice.procedure.title }}
                            </div>
                            <div class="w-full px-3 mb-6 mt-6 md:mb-0">
                                <InputLabel for="title" :value="t('pricelists')" />
                                {{ procedureprice.price_list.title }}
                            </div>
                            <div class="w-full px-3 mb-6 mt-6 md:mb-0">
                                <InputLabel for="price" :value="t('price')" />
                                {{ formatReal(procedureprice.price) }}
                            </div>
                            <FooterShow :routeName="routeName" :subject="procedureprice"/>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>


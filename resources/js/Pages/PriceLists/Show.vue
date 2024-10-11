<script setup>

import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {useI18n} from 'vue-i18n';
import {Head} from "@inertiajs/vue3";
import Header from "@/Components/Header.vue"
import InputLabel from "@/Components/InputLabel.vue";
import FooterShow from "@/Components/FooterShow.vue";
import { useDateFormatter } from '@/composables/useDateFormatter.js'
import { useActiveLabel } from '@/composables/useActiveLabel.js'

const {t} = useI18n();
const routeName = 'pricelists';
const { formatDate } = useDateFormatter();
const { activeLabel } = useActiveLabel();

const props = defineProps({
    pricelist: Object,
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

                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full md:w-1/4 px-3 mb-6 md:mb-0">
                                <InputLabel for="title" :value="t('title')" />
                                {{ pricelist.title }}
                            </div>
                            <div class="w-full md:w-1/4 px-3 mb-6 md:mb-0">
                                <InputLabel for="title" :value="t('start_date')" />
                                {{ formatDate(pricelist.start_date) }}
                            </div>
                            <div class="w-full md:w-1/4 px-3 mb-6 md:mb-0">
                                <InputLabel for="end_date" :value="t('end_date')" />
                                {{ formatDate(pricelist.end_date) }}
                            </div>
                            <div class="w-full md:w-1/4 px-3 mb-6 md:mb-0">
                                <InputLabel for="active" :value="t('active')" />
                                {{ activeLabel(pricelist.active) }}
                            </div>
                        </div>

                        <FooterShow :routeName="routeName" :subject="pricelist"/>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

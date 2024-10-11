<script setup>

import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {useI18n} from 'vue-i18n';
import {Head} from "@inertiajs/vue3";
import Header from "@/Components/Header.vue"
import InputLabel from "@/Components/InputLabel.vue";
import FooterShow from "@/Components/FooterShow.vue";

const {t} = useI18n();
const routeName = 'doctors';

const props = defineProps({
    roles: Object,
    specialties: Array,
    doctor: Object,
    doctorSpecialties: Array,
})

</script>

<template>
    <AuthenticatedLayout>
        <Head :title="t(`${routeName}`)"/>
        <div class="py-1">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <Header :title="t(`${routeName}`)"/>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-b-lg">
                    <div class="p-6 text-gray-900">
                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                <InputLabel for="first_name" :value="t('first_name')"/>
                                {{ doctor.first_name }}
                            </div>
                            <div class="w-full md:w-1/2 px-3">
                                <InputLabel for="last_name" :value="t('last_name')"/>
                                {{ doctor.last_name }}
                            </div>

                            <div class="w-full px-3 mb-6 mt-6 md:mb-0">
                                <InputLabel for="role" :value="t('role')"/>
                                {{ doctor.role.title }}
                            </div>
                            <div class="w-full px-3 mb-6 md:mb-0 mt-4">
                                <InputLabel for="specialties" :value="t('specialties')"/>
                                <div class="grid grid-cols-3 gap-4">
                                    <div v-for="specialty in doctor.specialties" :key="specialty.id">
                                        {{ specialty.title }}
                                    </div>
                                </div>
                            </div>

                        </div>
                        <FooterShow :routeName="routeName" :subject="doctor"/>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

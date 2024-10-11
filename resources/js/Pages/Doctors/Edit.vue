<script setup>

import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { useI18n } from 'vue-i18n';
import { Head, useForm } from "@inertiajs/vue3";
import Header from "@/Components/Header.vue"
import TextInput from "@/Components/TextInput.vue";
import { ref, watch } from "vue";
import InputLabel from "@/Components/InputLabel.vue";
import SelectInput from "@/Components/SelectInput.vue";
import FooterActions from "@/Components/FooterActions.vue";
import InputError from "@/Components/InputError.vue";
import {useToast} from 'vue-toast-notification';
import 'vue-toast-notification/dist/theme-sugar.css';
import FormChanged from "@/Components/FormChanged.vue";

const { t } = useI18n();
const toast = useToast();
const routeName = 'doctors';

const props = defineProps({
    roles: Object,
    specialties: Array,
    doctor: Object,
    doctorSpecialties: Array,
    errors: Object
})

const selectedSpecialties = ref([...props.doctorSpecialties]);

const form = useForm({
    first_name: props.doctor.first_name,
    last_name: props.doctor.last_name,
    role_id: props.doctor.role_id,
    thumbnail: props.doctor.thumbnail,
    specialties: selectedSpecialties.value,
});
const formErrors = ref({});

watch(selectedSpecialties, (newVal) => {
    form.specialties = newVal;
});
const validateForm = () => {
    formErrors.value = {}; // Reset errors
    let isValid = true;

    if (!form.first_name) {
        formErrors.value.first_name = t('required');
        isValid = false;
    }
    if (!form.last_name) {
        formErrors.value.last_name = t('required');
        isValid = false;
    }
    if (!form.role_id) {
        formErrors.value.role_id = t('required');
        isValid = false;
    }

    return isValid;
};
const update = () => {
    if (validateForm()) {
        form.put(route(`${routeName}.update`, props.doctor.id), {
            onSuccess: () => toast.success(t(`${routeName}_updated`))
        });
    }
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
                        <form @submit.prevent="update">
                            <div class="flex flex-wrap -mx-3 mb-6">
                                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                    <InputLabel for="first_name" :value="t('first_name')" />
                                    <TextInput
                                        id="first_name"
                                        v-model="form.first_name"
                                        type="text"
                                        required
                                        />
                                    <InputError v-if="formErrors.first_name || errors.first_name" :message="formErrors.first_name || errors.first_name" />
                                </div>
                                <div class="w-full md:w-1/2 px-3">
                                    <InputLabel for="last_name" :value="t('last_name')" />
                                    <TextInput
                                        id="last_name"
                                        v-model="form.last_name"
                                        type="text"
                                        required
                                        class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                    />
                                    <InputError v-if="formErrors.last_name || errors.last_name" :message="formErrors.last_name || errors.last_name" />
                                </div>

                                <div class="w-full px-3 mb-6 mt-6 md:mb-0">
                                    <InputLabel for="role" :value="t('role')" />
                                    <SelectInput id="role" v-model="form.role_id" :options="roles" value-key="id" text-key="title" />
                                    <InputError v-if="formErrors.role_id || errors.role_id" :message="formErrors.role_id || errors.role_id" />
                                </div>
                                <div class="w-full px-3 mb-6 md:mb-0 mt-4">
                                    <InputLabel for="specialties" :value="t('specialties')"/>
                                    <div class="grid grid-cols-3 gap-4">
                                        <div v-for="specialty in specialties" :key="specialty.id">
                                            <input
                                                type="checkbox"
                                                :id="specialty.id"
                                                :value="specialty.id"
                                                v-model="selectedSpecialties"
                                            />
                                            {{ specialty.title }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <FooterActions :routeName="routeName" />
                        </form>
                        <FormChanged :state="form.isDirty" />
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

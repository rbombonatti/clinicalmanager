<script setup>

import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { useI18n } from 'vue-i18n';
import { Head, useForm } from "@inertiajs/vue3";
import Header from "@/Components/Header.vue"
import TextInput from "@/Components/TextInput.vue";
import { ref } from "vue";
import InputLabel from "@/Components/InputLabel.vue";
import FooterActions from "@/Components/FooterActions.vue";
import InputError from "@/Components/InputError.vue";
import {useToast} from 'vue-toast-notification';
import 'vue-toast-notification/dist/theme-sugar.css';
import FormChanged from "@/Components/FormChanged.vue";

const { t } = useI18n();
const toast = useToast();
const routeName = 'specialties';

const props = defineProps({
    specialty: Object,
    errors: Object
})

const form = useForm({
    title: props.specialty.title,
});
const formErrors = ref({});

const validateForm = () => {
    formErrors.value = {}; // Reset errors
    let isValid = true;

    if (!form.title) {
        formErrors.value.title = t('required');
        isValid = false;
    }
    return isValid;
};
const update = () => {
    if (validateForm()) {
        form.put(route(`${routeName}.update`, props.specialty.id), {
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
                                    <InputLabel for="title" :value="t('title')" />
                                    <TextInput
                                        id="title"
                                        v-model="form.title"
                                        type="text"
                                        required
                                        />
                                    <InputError v-if="formErrors.title || errors.title" :message="formErrors.title || errors.title" />
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

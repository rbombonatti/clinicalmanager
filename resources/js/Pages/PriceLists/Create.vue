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
const routeName = 'pricelists';

const props = defineProps({
    errors: Object,
})


const form = useForm({
    title: '',
    start_date: '',
    end_date: '',
    active: false
});
const formErrors = ref({});
const validateForm = () => {

    let isValid = true;
    formErrors.value = {};

    if (!form.title) {
        formErrors.value.title = t('required');
        isValid = false;
    }

    if (!form.start_date) {
        formErrors.value.start_date = t('required');
        isValid = false;
    }

    if (!form.end_date) {
        formErrors.value.end_date = t('required');
        isValid = false;
    }

    return isValid;
};
const store = () => {
    if (validateForm()) {
        form.post(route(`${routeName}.store`), {
            onSuccess: () => toast.success(t(`${routeName}_created`)),
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
                        <form @submit.prevent="store">
                            <div class="flex flex-wrap -mx-3 mb-6">
                                <div class="w-full md:w-1/4 px-3 mb-6 md:mb-0">
                                    <InputLabel for="title" :value="t('title')" />
                                    <TextInput
                                        id="title"
                                        v-model="form.title"
                                        type="text"
                                        required
                                    />
                                    <InputError v-if="formErrors.title || errors.title" :message="formErrors.title || errors.title" />
                                </div>
                                <div class="w-full md:w-1/4 px-3 mb-6 md:mb-0">
                                    <InputLabel for="start_date" :value="t('start_date')" />
                                    <TextInput
                                        id="start_date"
                                        v-model="form.start_date"
                                        type="date"
                                        required
                                    />
                                    <InputError v-if="formErrors.start_date || errors.start_date" :message="formErrors.start_date || errors.start_date" />
                                </div>
                                <div class="w-full md:w-1/4 px-3 mb-6 md:mb-0">
                                    <InputLabel for="end_date" :value="t('end_date')" />
                                    <TextInput
                                        id="end_date"
                                        v-model="form.end_date"
                                        type="date"
                                        required
                                    />
                                    <InputError v-if="formErrors.end_date || errors.end_date" :message="formErrors.end_date || errors.end_date" />
                                </div>
                                <div class="w-full md:w-1/4 px-3 mb-6 md:mb-0">
                                    <InputLabel for="active" :value="t('active')" />
                                    <input
                                        id="active"
                                        v-model="form.active"
                                        type="checkbox"
                                        class="checkbox"
                                    />
                                    <InputError v-if="formErrors.active || errors.active" :message="formErrors.active || errors.active" />
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

<style scoped>

</style>

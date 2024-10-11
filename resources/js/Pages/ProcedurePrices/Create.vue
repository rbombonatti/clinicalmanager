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
import SelectInput from "@/Components/SelectInput.vue";

const { t } = useI18n();
const toast = useToast();
const routeName = 'procedureprices';

const props = defineProps({
    healthinsuranceplans: Object,
    procedures: Object,
    pricelists: Object,
    errors: Object,
})


const form = useForm({
    procedure_id: '',
    health_insurance_plan_id: '',
    price_list_id: '',
    price: '',
});
const formErrors = ref({});
const validateForm = () => {

    let isValid = true;
    formErrors.value = {};

    if (!form.procedure_id) {
        formErrors.value.procedure_id = t('required');
        isValid = false;
    }

    if (!form.health_insurance_plan_id) {
        formErrors.value.health_insurance_plan_id = t('required');
        isValid = false;
    }

    if (!form.price_list_id) {
        formErrors.value.price_list_id = t('required');
        isValid = false;
    }

    if (!form.price) {
        formErrors.value.price = t('required');
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
                            <div class="w-full px-3 mb-6 mt-6 md:mb-0">
                                <InputLabel for="health_insurance_plan_id" :value="t('healthinsuranceplan')" />
                                <SelectInput id="health_insurance_plan_id" v-model="form.health_insurance_plan_id" :options="healthinsuranceplans" value-key="id" text-key="title" />
                                <InputError v-if="formErrors.health_insurance_plan_id || errors.health_insurance_plan_id " :message="formErrors.health_insurance_plan_id || errors.health_insurance_plan_id" />
                            </div>
                            <div class="w-full px-3 mb-6 mt-6 md:mb-0">
                                <InputLabel for="procedure_id" :value="t('procedure')" />
                                <SelectInput id="procedure_id" v-model="form.procedure_id" :options="procedures" value-key="id" text-key="title" />
                                <InputError v-if="formErrors.procedure_id || errors.procedure_id " :message="formErrors.procedure_id || errors.procedure_id" />
                            </div>
                            <div class="w-full px-3 mb-6 mt-6 md:mb-0">
                                <InputLabel for="price_list_id" :value="t('pricelist')" />
                                <SelectInput id="price_list_id" v-model="form.price_list_id" :options="pricelists" value-key="id" text-key="title" />
                                <InputError v-if="formErrors.price_list_id || errors.price_list_id " :message="formErrors.price_list_id || errors.price_list_id" />
                            </div>
                            <div class="w-full px-3 mb-6 mt-6 md:mb-0">
                                <InputLabel for="price" :value="t('price')" />
                                <TextInput
                                    id="price"
                                    v-model="form.price"
                                    type="text"
                                    :currency=true
                                    required
                                    class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                />
                                <InputError v-if="formErrors.price || errors.price" :message="formErrors.price || errors.price" />
                                <div v-if="errors.price_list_id" class="mt-4 text-center text-red-500">
                                    {{ t('duplicate_entry')}}
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

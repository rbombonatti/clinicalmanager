<template>
    <a @click="destroySubject" class="bg-red-500 hover:bg-red-700 text-white font-bold p-2 px-4 rounded mb-2 mr-2 delete-button">
        {{ t('delete') }}
    </a>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3';
import { useI18n } from 'vue-i18n';
import Swal from 'sweetalert2'

const props = defineProps({
    subjectId: Number,
    routeName: {
        type: String,
        required: true,
    }
});

const { t } = useI18n();
const form = useForm({});
const destroySubject = () => {
    Swal.fire({
        title: t('confirm_delete'),
        text: t('undo_delete'),
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: t('delete_yes'),
        cancelButtonText: t('delete_no'),
    }).then((result) => {
        if (result.isConfirmed) {
            form.delete(route(`${props.routeName}.destroy`, props.subjectId), {
                onSuccess: () => {
                    Swal.fire({
                        title: t('deleted'),
                        text: t('deleted_text'),
                        icon: "success",
                    });
                },
                onError: (errors) => {
                    console.error(errors);
                }
            })
        }
    });
};
</script>

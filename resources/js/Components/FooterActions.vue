<script setup>
import { useI18n } from 'vue-i18n';
import BtnSimple from "@/Components/BtnSimple.vue";
import BtnSubmit from "@/Components/BtnSubmit.vue";

const { t } = useI18n();

const props = defineProps({
  routeName: {
    type: String,
    required: true,
  }
})

</script>

<template>
    <div class="max-w-full flex justify-between mt-4">
        <div class="mt-6 flex items-center justify-end gap-x-6">
            <BtnSimple :routeName="`/${routeName}`">{{ t('cancel') }}</BtnSimple>
        </div>
        <div class="mt-6 flex items-center justify-end gap-x-6">
            <BtnSubmit>{{ t('save') }}</BtnSubmit>
        </div>
    </div>
</template>


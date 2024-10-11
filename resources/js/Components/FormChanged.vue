<script setup>
import { useI18n } from 'vue-i18n';
const { t } = useI18n();

const props = defineProps({
    state: {
        type: Boolean,
        required: true,
        default: false
    }
})
</script>

<template>
    <div class="form-changed" v-if="state">{{ t('form_changed')}}</div>
</template>

<style scoped>
.form-changed {
    color: white;
    font-size: small;
    font-weight: bold;
    background-color: mediumseagreen;
    padding: 4px 10px 4px 10px;
    border-radius: 4px;
    margin-top: 20px;
}
</style>

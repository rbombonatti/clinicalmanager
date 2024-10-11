<script setup>
import { AgGridVue } from "ag-grid-vue3";
import "ag-grid-community/styles/ag-grid.css";
import "ag-grid-community/styles/ag-theme-alpine.css";
import { ref, onMounted, watch } from 'vue';
import axios from 'axios';
import { useDateFormatter } from "@/composables/useDateFormatter.js";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import { useI18n } from "vue-i18n";
import CurrencyFormatter from "@/composables/useCurrencyFormatter.js";
import validateFields from "@/composables/useValidateFields.js";

const { t } = useI18n();
const routeName = 'consultations';

const { formatDate } = useDateFormatter();

const props = defineProps({
    doctors: Array,
    procedures: Array,
    health_insurance_plans: Array,
    consultation_types: Array,
    consultation_sources: Array,
    token: String,
});

const rowData = ref([]);
const doctors = ref(props.doctors);
const consultation_types = props.consultation_types;
const consultation_sources = props.consultation_sources;
const health_insurance_plans = ref(props.health_insurance_plans);
const procedures = ref(props.procedures);
const followup = props.consultation_sources;
let inputRow = {};
const dataTypeDefinitions = ref(null);

const errorRows = ref([]);

async function onCellEditingStopped(params) {
    if (validateFields(params.data)) {
        if (params.rowPinned === 'bottom') {
            const createdData = params.data;
            await axios.post('/api/consultations/create', createdData, {
                headers: {
                    Authorization: `Bearer ${props.token}`
                }
            }).then(response => {
                inputRow.reference_price = response.data.data.reference_price;
                inputRow.id = response.data.data.id;
                rowData.value = [...rowData.value, inputRow];
                inputRow = {};
                console.log(
                    `Registro ${inputRow.id} (${inputRow.consultation_number}) - ${response.data.message}`
                );
            }).catch(error => {
                console.error('Erro ao salvar dados:', error);
            });
        }
        if (params.data.id) {
            if (params.newValue === params.oldValue) return;
            const updatedData = params.data;
            await axios.post('/api/consultations/update', updatedData, {
                headers: {
                    Authorization: `Bearer ${props.token}`
                }
            }).then(response => {
                const updatedConsultation = response.data.data;
                const rowNode = gridApi.value.getRowNode(updatedConsultation.id);
                if (rowNode) {
                    rowNode.setData(updatedConsultation);
                }
                console.log(
                    `Registro ${updatedConsultation.id} (${updatedConsultation.consultation_number}) - ${response.data.message}`
                );
            }).catch(error => {
                console.error('Erro ao salvar dados:', error);
                // Adicionar a linha com erro ao array errorRows
                errorRows.value.push(params.node.id);
                console.log('errorRows: ', errorRows.value);
                params.api.refreshCells()
            });
        }
    }
}

const rowClassRules = {
    'error-row': (params) => {
        errorRows.value.includes(params.node.id);
    }
};

function isEmptyPinnedCell(params) {
    return (
        (params.node.rowPinned === 'bottom' && params.value == null) ||
        (params.node.rowPinned === 'bottom' && params.value === '')
    );
}
function createPinnedCellPlaceholder({ colDef }) {
    return colDef.headerName;
}

const DateFormat = (params) => {
    const date = params.value;
    if (!date) {
        return '';
    }
    return formatDate(params.value);
};

const columnTypes = {
    currency: {
        width: 150,
        valueFormatter: CurrencyFormatter,
        editable: true,
    },
    date: {
        valueFormatter: DateFormat,
        flex: 1.2,
        editable: true,
    }
};

const getRowId = (params) => {
    if (params.node && params.node.rowPinned === 'bottom') {
        return 'pinnedRow';
    }
    if (typeof params.data?.id !== 'undefined') {
        return params.data.id.toString();
    }

    return 'row_' + params.rowIndex;
};

watch(procedures, (newProcedures) => {
    if (newProcedures.length === 0) {
        console.error('Procedures está vazio. Verifique a API ou as props');
    } else {
        gridApi.value.refreshCells();
    }
});

const columnDefs = [
    {
        field: "consultation_date",
        headerName: "Data Consulta",
        type: "date",
    },
    {
        field: "patient_name",
        headerName: "Nome do Paciente",
        flex: 2,
    },
    {
        field: "consultation_number",
        headerName: "Número de Atendimento",
        flex: 1.4,
    },
    {
        field: "doctor_id",
        headerName: "Médico",
        cellEditor: "agSelectCellEditor",
        cellEditorParams: {
            values: doctors.value.map(doc => doc.id)
        },
        valueFormatter: (params) => {
            const doctor = doctors.value.find(doc => doc.id === params.value);
            return doctor ? doctor.first_name : '';
        },
        editable: true,
        flex: 1.3,
    },
    {
        field: "procedure_id",
        headerName: "Procedimento",
        cellEditor: "agSelectCellEditor",
        cellEditorParams: {
            values: procedures.value.map(p => p.id),
        },
        valueFormatter: (params) => {
            const procedure = procedures.value.find(p => p.id === params.value);
            return procedure ? procedure.title : '';
        },
        flex: 2,
    },
    {
        field: "health_insurance_plan_id",
        headerName: "Seguro",
        cellEditor: "agSelectCellEditor",
        cellEditorParams: {
            values: health_insurance_plans.value.map(plan => plan.id)
        },
        valueFormatter: (params) => {
            const health_insurance_plan = health_insurance_plans.value.find(plan => plan.id === params.value);
            return health_insurance_plan ? health_insurance_plan.title : '';
        },
        flex: 2,
    },
    {
        field: "type",
        headerName: "Tipo",
        cellEditor: "agSelectCellEditor",
        cellEditorParams: {
            values: Array.isArray(consultation_types) ? consultation_types : []
        },
        valueFormatter: (params) => {
            const type = consultation_types.find(t => t === params.value);
            return type || '';
        }
    },
    {
        field: "reference_price",
        headerName: "Referência",
        type: 'currency',
        flex: 1.5,
        editable: false,
    },
];

const defaultColDef = {
    editable: true,
    filter: true,
    flex: 1,
    valueFormatter: (params) =>
        isEmptyPinnedCell(params) ? createPinnedCellPlaceholder(params) : undefined,
};

const gridApi = ref(null);

const onGridReady = (params) => {
    gridApi.value = params.api;
};

onMounted(() => {
    axios.get('/api/consultationsApi', {
        headers: {
            Authorization: `Bearer ${props.token}`
        }
    })
        .then(response => {
            rowData.value = response.data;
        })
        .catch(error => {
            console.error('Erro ao buscar dados:', error);
        });
});
</script>

<template>
    <AuthenticatedLayout>
        <Head :title="t(`${routeName}`)" />
        <ag-grid-vue
            @grid-ready="onGridReady"
            :getRowId="getRowId"
            :rowData="rowData"
            :columnDefs="columnDefs"
            style="height: 500px; width: 100%; font-size: 11px; flex-wrap: wrap"
            class="ag-theme-alpine"
            :defaultColDef="defaultColDef"
            :columnTypes="columnTypes"
            @cellEditingStopped="onCellEditingStopped"
            @cellValueChanged="onCellValueChanged"
            :pinnedBottomRowData="[inputRow]"
            :rowClassRules="rowClassRules"
        />
    </AuthenticatedLayout>
</template>


<style scoped>
.error-row {
    border: 2px solid red !important;
}
</style>

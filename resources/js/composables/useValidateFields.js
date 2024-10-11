const validateFields = (data) => {
    return !!((data.consultation_date) &&
        (data.patient_name) &&
        (data.consultation_number) &&
        (data.doctor_id) &&
        (data.procedure_id) &&
        (data.health_insurance_plan_id) &&
        (data.type));
}

export default validateFields;

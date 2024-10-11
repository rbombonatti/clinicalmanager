<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';

const selectedValue = ref(null);
const doctors = ref([]);

onMounted(() => {
  axios.get('/api/doctors')
      .then(response => {
        doctors.value = response.data;
      })
      .catch(error => {
        console.error('Erro ao buscar dados dos médicos:', error);
      });
});

const onChange = (event) => {
  selectedValue.value = event.target.value;
};
</script>

<template>
  <select v-model="selectedValue" @change="onChange">
    <option v-for="doctor in doctors" :key="doctor.id" :value="doctor.id">
      {{ doctor.first_name }} {{ doctor.last_name }}
    </option>
  </select>
</template>

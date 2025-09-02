<template>
  <div class="card">
    <Fieldset legend="Property Search Filters">
      <div class="grid p-fluid align-items-center">
        <div class="col-12 md:col-6">
          <label for="name">Name</label>
          <InputText id="name" v-model="filters.name" placeholder="For example, The Victoria" />
        </div>
        <div class="col-6 md:col-3">
          <label for="bedrooms">Bedrooms</label>
          <InputNumber id="bedrooms" v-model="filters.bedrooms" />
        </div>
        <div class="col-6 md:col-3">
          <label for="bathrooms">Bathrooms</label>
          <InputNumber id="bathrooms" v-model="filters.bathrooms" />
        </div>

        <div class="col-12 md:col-6">
          <label for="price_range">Price range</label>
          <InputGroup id="price_range">
            <InputNumber v-model="filters.price_min" placeholder="From" mode="currency" currency="USD" locale="en-US" />
            <InputGroupAddon>To</InputGroupAddon>
            <InputNumber v-model="filters.price_max" placeholder="To" mode="currency" currency="USD" locale="en-US" />
          </InputGroup>
        </div>
      </div>

      <div class="flex justify-content-end gap-2 mt-4">
        <Button label="Clear" icon="pi pi-replay" class="p-button-secondary" @click="clearFilters" />
        <Button label="Find" icon="pi pi-search" @click="search" />
      </div>
    </Fieldset>

    <div v-if="isLoading" class="flex justify-content-center align-items-center mt-4" style="height: 250px;">
      <ProgressSpinner />
    </div>

    <div v-if="!isLoading && searched" class="mt-4">
      <DataTable :value="results" :paginator="true" :rows="10" responsiveLayout="scroll">
        <template #empty>
          Nothing found matching your request.
        </template>
        <Column field="name" header="Name"></Column>
        <Column field="price" header="Price">
          <template #body="slotProps">
            {{ formatCurrency(slotProps.data.price) }}
          </template>
        </Column>
        <Column field="bedrooms" header="Bedrooms"></Column>
        <Column field="bathrooms" header="Bathrooms"></Column>
        <Column field="storeys" header="Storeys"></Column>
        <Column field="garages" header="Garages"></Column>
      </DataTable>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import axios from 'axios';
import Fieldset from 'primevue/fieldset';
import InputText from 'primevue/inputtext';
import InputNumber from 'primevue/inputnumber';
import InputGroup from 'primevue/inputgroup';
import InputGroupAddon from 'primevue/inputgroupaddon';
import Button from 'primevue/button';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import ProgressSpinner from 'primevue/progressspinner';

const initialFilters = {
  name: null,
  bedrooms: null,
  bathrooms: null,
  price_min: null,
  price_max: null,
};

const filters = ref({ ...initialFilters });
const results = ref([]);
const isLoading = ref(false);
const searched = ref(false);

// Функция для очистки фильтров
const clearFilters = () => {
  filters.value = { ...initialFilters };
  results.value = [];
  searched.value = false;
};

const search = async () => {
  isLoading.value = true;
  searched.value = true;
  results.value = [];

  const params = {};
  for (const key in filters.value) {
    if (filters.value[key] !== null && filters.value[key] !== '') {
      params[key] = filters.value[key];
    }
  }

  try {
    const response = await axios.get('http://localhost/api/realties/search', { params });
    results.value = response.data;
  } catch (error) {
    console.error('Error executing request:', error);
  } finally {
    isLoading.value = false;
  }
};

const formatCurrency = (value) => {
  if (value === null || value === undefined) return '';
  return new Intl.NumberFormat('en-US', { style: 'currency', currency: 'USD' }).format(value);
};
</script>

<style scoped>
.card {
  padding: 1rem;
}
/* Добавляем стили для label, чтобы обеспечить отступы */
label {
  display: block;
  margin-bottom: 0.5rem;
  font-weight: 500;
}
</style>

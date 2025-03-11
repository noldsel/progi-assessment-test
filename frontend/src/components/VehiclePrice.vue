<template>
    <v-container>
      <v-form>
        <v-text-field
          v-model="vehiclePrice"
          label="Vehicle Base Price"
          type="number"
          min="0"
          @input="calculateTotal"
        ></v-text-field>
  
        <v-select
          v-model="vehicleType"
          :items="vehicleTypes"
          label="Vehicle Type"
          @input="calculateTotal"
        ></v-select>
  
        <v-btn @click="calculateTotal">Calculate</v-btn>
  
        <v-divider></v-divider>
  
        <div v-if="result">
          <v-row>
            <v-col>
              <p><strong>Basic Buyer Fee:</strong> ${{ result.fees.basic_buyer_fee }}</p>
              <p><strong>Special Fee:</strong> ${{ result.fees.special_fee }}</p>
              <p><strong>Association Fee:</strong> ${{ result.fees.association_fee }}</p>
              <p><strong>Storage Fee:</strong> ${{ result.fees.storage_fee }}</p>
              <p><strong>Total Cost:</strong> ${{ result.total_cost }}</p>
            </v-col>
          </v-row>
        </div>
      </v-form>
    </v-container>
  </template>
  
  <script setup>
  import { ref } from 'vue';
  import axios from '../plugins/axios';
//   import { VTextField } from 'vuetify/lib';
//   import { VTextField } from 'vuetify/lib/components/index.mjs';
  
  const vehiclePrice = ref(0);
  const vehicleType = ref('Common');
  const vehicleTypes = ['Common', 'Luxury'];
  const result = ref(null);
  
  const calculateTotal = async () => {
    if (vehiclePrice.value <= 0) return;
  
    try {
      const response = await axios.post('/api/calculate-vehicle-price', {
        vehicle_price: vehiclePrice.value,
        vehicle_type: vehicleType.value
      });
  
      result.value = response.data;
    } catch (error) {
      console.error('Error calculating vehicle price:', error);
    }
  };
  </script>
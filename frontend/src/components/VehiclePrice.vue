<template>
    <v-container>
      <v-form>
        <v-text-field
          v-model="vehiclePrice"
          label="Vehicle Base Price"
          type="number"
          min="0"
        ></v-text-field>
  
        <v-select
          v-model="vehicleType"
          :items="vehicleTypes"
          label="Vehicle Type"
        ></v-select>
  
        <!-- <v-btn @click="calculateTotal">Calculate</v-btn> -->
  
        <v-divider></v-divider>
  
        <v-table v-if="result">
        <thead>
          <tr>
            <th>Vehicle Price</th>
            <th>Vehicle Type</th>
            <th>Basic Fee</th>
            <th>Special Fee</th>
            <th>Association Fee</th>
            <th>Storage Fee</th>
            <th>Total</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>${{ vehiclePrice }}</td>
            <td>{{ vehicleType }}</td>
            <td>${{ result.fees.basic_buyer_fee }}</td>
            <td>${{ result.fees.special_fee }}</td>
            <td>${{ result.fees.association_fee }}</td>
            <td>${{ result.fees.storage_fee }}</td>
            <td><strong>${{ result.total_cost }}</strong></td>
          </tr>
        </tbody>
      </v-table>
      </v-form>
    </v-container>
  </template>
  
  <script setup>
  import { ref, watch } from 'vue';
  import axios from '../plugins/axios';
  import { debounce } from 'lodash';
  
  const vehiclePrice = ref(0);
  const vehicleType = ref('Common'); // Default Vehicle Type

  // NOTE: I would have prefered these values to be retrieved 
  // from the database at the backend, but I don't have time to implement it
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

  // Debounce the function to delay execution by 2 seconds
  // because we don't want excessive call to the endpoing 
  // when typing at every digit of any number
  const debouncedCalculateTotal = debounce(calculateTotal, 2000);

  // Watch for changes in vehiclePrice or vehicleType
  watch([vehiclePrice, vehicleType], debouncedCalculateTotal);
  </script>
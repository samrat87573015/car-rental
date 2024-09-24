<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { defineProps,ref } from 'vue';
import { useToast } from 'vue-toastification';
import axios from 'axios';
import { router } from '@inertiajs/vue3'


const toast = useToast();


const props = defineProps({
  rental: Object,
  customers: Array,
  cars: Array
});


const todayDate = new Date().toISOString().split('T')[0];


const form = ref({
  rental_id: props.rental.id,
  user_id: props.rental.user_id,
  car_id: props.rental.car_id,
  start_date: props.rental.start_date,
  end_date: props.rental.end_date,
  status: props.rental.status
});


const updateRental = async() => {
  const res = await axios.post('/admin/rental-update', form.value);
  //console.log(res.data);

  if(res.data.msg === 'success'){
    toast.success('Rental updated successfully');
    router.visit('/admin/rental-list');

  }else{
    toast.error('Something went wrong');
  }
}





</script>


<template>
  <AdminLayout>
    <div class="dContent m-2 p-3 bg-white">
      <h1 class="text-2xl font-bold mb-4 dark:text-gray-200">Update Rental</h1>
    

      <div class="create_rental_form p-6">
        <form @submit.prevent="updateRental">
          <input type="hidden" v-model="form.rental_id">
          <div class="grid grid-cols-2 gap-5">

            <div class="w-full">
              <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Select
                Customer</label>
              <select id="customer_id" class="input" v-model="form.user_id" required>
                <option value="">Select Customer</option>
                <option v-for="customer in props.customers" :key="customer.id" :value="customer.id">
                  {{ customer.name }}
                </option>
              </select>
            </div>
            <div class="w-full">
              <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Select
                Car</label>
              <select id="car_id" class="input" v-model="form.car_id" required>
                <option value="">Select Car</option>
                <option v-for="car in props.cars" :key="car.id" :value="car.id">
                  <span>{{ car.name }} - <span>Model: {{ car.model }} - <span>(Daily Price: {{ car.daily_rent_price
                        }})</span></span></span>
                </option>
              </select>
            </div>

            <div class="w-full">
              <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Start
                Date</label>
              <input type="date" id="start_date" v-model="form.start_date" class="input" :min="todayDate" required />
            </div>
            <div class="w-full">
              <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">End Date</label>
              <input type="date" id="end_date" v-model="form.end_date" :min="todayDate" class="input" required />
            </div>

          </div>

          <div class="my-4">
            <select id="selected_status" v-model="form.status" class="input">
              <option value="">Select Status</option>
              <option value="Ongoing">Ongoing</option>
              <option value="Completed">Completed</option>
              <option value="Canceled">Canceled</option>
            </select>
          </div>

          <div class="mt-4">
            <button type="submit" class="btn btn-primary">Update</button>
          </div>
        </form>
      </div>


    </div>
  </AdminLayout>
</template>
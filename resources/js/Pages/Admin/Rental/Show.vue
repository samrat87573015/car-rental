<script setup>
  import AdminLayout from '@/Layouts/AdminLayout.vue';
  import { defineProps } from 'vue';
  import { Link } from '@inertiajs/vue3';


  const props = defineProps({
    rental: Object
  });
</script>


<template>  
  <AdminLayout>
    <div class="dContent m-2 p-10 bg-white">
        <div class="text-right flex justify-between">
            <h1 class="text-2xl font-bold text-gray-800 mb-10">Rental Details</h1>
            <div>
              <Link class="btn-primary" href="/admin/rental-list">back</Link>
            </div>
        </div>
        <div class="grid grid-cols-3 gap-4">
          <div class="cus_details">
              <h2 class="text-xl mb-5 font-semibold">Customer Details</h2>
              <p class="py-2 text-lg">Name: {{ props.rental.user.name }}</p>
              <p class="py-2 text-lg">Email: {{ props.rental.user.email }}</p>
              <p class="py-2 text-lg">Phone: {{ props.rental.user.phone }}</p>
              <p class="py-2 text-lg">Address: {{ props.rental.user.address }}</p>

          </div>

          <div class="car_details">
              <h2 class="text-xl mb-5 font-semibold">Car Details</h2>
              <p class="py-2 text-lg">Name: {{ props.rental.car.name }}</p>
              <p class="py-2 text-lg">Model: {{ props.rental.car.model }}</p>
              <p class="py-2 text-lg">Year: {{ props.rental.car.year }}</p>
              <p class="py-2 text-lg">Brand: {{ props.rental.car.brand }}</p>
              <p class="py-2 text-lg">Type: {{ props.rental.car.car_type }}</p>
              <p class="py-2 text-lg">Price: {{ props.rental.car.daily_rent_price }}</p>
              <p :class="props.rental.car.availability ? 'bg-green-500 inline-block px-4 py-1 rounded-full text-white' : 'bg-red-500 inline-block px-4 py-1 rounded-full text-white'">{{ props.rental.car.availability ? 'Available' : 'Not Available' }}</p>
          </div>

          <div class="rental_details ">
              <h2 class="text-xl mb-5 font-semibold">Rental Details</h2>
              <p class="py-2 text-lg">Start Date: {{ props.rental.start_date }}</p>
              <p class="py-2 text-lg">End Date: {{ props.rental.end_date }}</p>
              <p class="py-2 text-lg">Total Cost: {{ props.rental.total_cost }}</p>
              <p v-if="props.rental.status === 'Ongoing'" :class="props.rental.status === 'Ongoing' ? 'ongoingRentalStatus inline-block' : ''">Status: {{ props.rental.status }}</p>
              <p v-if="props.rental.status === 'Completed'" :class="props.rental.status === 'Completed' ? 'completedRentalStatus inline-block' : ''">Status: {{ props.rental.status }}</p>

              <p v-if="props.rental.status === 'Canceled'" :class="props.rental.status === 'Canceled' ? 'canceledRentalStatus inline-block' : ''" >Status: {{ props.rental.status }}</p>

          </div>
        </div>
    </div>
  </AdminLayout>
</template>
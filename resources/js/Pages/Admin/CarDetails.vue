<script setup>
  import AdminLayout from '@/Layouts/AdminLayout.vue';
  import { Link } from '@inertiajs/vue3';

  import { defineProps } from 'vue';

  const props = defineProps({
    car: Object
  })


</script>

<template>
  <AdminLayout>
    <div class="dContent m-2 p-10 bg-white">
        <div class="flex justify-between">
          <div>
            <h1 class="text-2xl font-bold text-gray-800">Car Details</h1>
          </div>
          <div>
              <Link class="btn-primary" href="/admin/car-list">back</Link>
          </div>
        </div>

        <div class="flex gap-5 items-center py-10">
          <div class="car_image md:w-1/2 w-full">
            <img :src="`/${car.image}`" alt="">
          </div>

          <div class="car_details py-5 md:w-1/2 w-full">
              <h2 class="text-xl"><strong>Name:</strong> {{ car.name }}</h2>
              <p class="py-2"><strong>Model:</strong> {{ car.model }}</p>
              <p class="py-2"><strong>Year:</strong> {{ car.year }}</p>
              <p class="py-2"><strong>Brand:</strong> {{ car.brand }}</p>
              <p class="py-2"><strong>Type:</strong> {{ car.car_type }}</p>
              <p class="py-2"><strong>Price:</strong> {{ car.daily_rent_price }}</p>
              <p><span class="mr-2 font-semibold">Availability:</span><span :class="car.availability ? 'bg-green-500 inline-block px-4 py-1 rounded-full text-white' : 'bg-red-500 inline-block px-4 py-1 rounded-full text-white' "> {{ car.availability ? 'Available' : 'Not Available' }}</span></p>
          </div>
        </div>
        
    </div>
  </AdminLayout>
</template>
<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { defineProps, ref, computed } from 'vue';
import { Link } from '@inertiajs/vue3';
import axios from 'axios';
import { Inertia } from '@inertiajs/inertia'


const props = defineProps({
  cars: Array,
  car_types: Object,
  brands: Object
});


const filters = ref({
  car_type: '',
  brand: '',
  min_price: '',
  max_price: '',
});


// Computed property to filter cars based on the filters
const filteredCars = computed(() => {
  return props.cars.filter(car => {
    const matchesType = filters.value.car_type ? car.car_type === filters.value.car_type : true;
    const matchesBrand = filters.value.brand ? car.brand === filters.value.brand : true;
    const minPrice = filters.value.min_price ? Number(filters.value.min_price) : null;
    const maxPrice = filters.value.max_price ? Number(filters.value.max_price) : null;
    const matchesPrice =
      (minPrice !== null ? car.daily_rent_price >= minPrice : true) &&
      (maxPrice !== null ? car.daily_rent_price <= maxPrice : true);

    return matchesType && matchesBrand && matchesPrice;
  });
});





</script>

<template>

  <AppLayout>
    <div class="rental_wrapp bg-gray-200 py-20">
      <div class="container mx-auto">

        <div class="filter_area mb-10">
          <div class="grid grid-cols-4 gap-4 items-center">
            <div class="filter_item">
              <label for="">Type</label>
              <select class="input" v-model="filters.car_type">
                <option value="">Select Car Type</option>
                <option v-for="car_type in props.car_types" :key="car_type.id" :value="car_type">{{ car_type }}</option>
              </select>
            </div>
            <div class="filter_item">
              <label for="">Brand</label>
              <select class="input" v-model="filters.brand">
                <option value="">Select Brand</option>
                <option v-for="brand in props.brands" :key="brand.id" :value="brand">{{ brand }}</option>
              </select>
            </div>
            <div class="filter_item">
              <label for="">Min Price</label>
              <input type="text" v-model="filters.min_price" class="input">
            </div>
            <div class="filter_item">
              <label for="">Max Price</label>
              <input type="text" v-model="filters.max_price" class="input">
            </div>
          </div>
        </div>

        <div v-if="filteredCars.length === 0">
          <p class="text-center text-3xl capitalize">No car found</p>
        </div>

        <div v-else class="car_list_inner grid grid-cols-3 gap-5 items-start">
          <div v-for="car in filteredCars" :key="car.id" class="car_item shadow-md bg-white">
            <div v-if="car.image" class="ima w-full h-[300px]">
              <img class="w-full h-full object-cover" :src="`/${car.image}`" alt="">
            </div>
            <div class="content space-y-3 py-5 px-10 relative">
              <div class="absolute -top-[50px] right-[30px]">
                <p class="w-[100px] h-[100px] rounded-full flex justify-center items-center bg-indigo-500 text-white">
                  ${{ car.daily_rent_price }}</p>
              </div>
              <Link :href="`/cars/${car.id}`">
              <h3 class="text-xl font-bold pt-5">{{ car.name }}</h3>
              </Link>
              <p class="text-gray-500">Model: {{ car.model }}</p>
              <p class="text-gray-500">Brand: {{ car.brand }}</p>
              <div class="btn_area mt-5">
                <Link :href="`/cars/${car.id}`"
                  class="flex items-center w-fit px-5 py-2 text-indigo-500 border border-indigo-500">View Details<svg
                  xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                  stroke="currentColor" class="w-4 ml-2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 19.5 15-15m0 0H8.25m11.25 0v11.25" />
                </svg>

                </Link>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </AppLayout>

</template>
<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { defineProps, ref } from 'vue';
import { router } from '@inertiajs/vue3';
import axios from 'axios';
import { useToast } from 'vue-toastification';


const toast = useToast();


const props = defineProps({
  car: Object
});

const toDay = new Date().toISOString().split('T')[0];

const isConfirmModalOpen = ref(false);

const form = ref({
  car_id: props.car.id,
  start_date: '',
  end_date: '',
});

const openConfirmModal = () => {
  isConfirmModalOpen.value = true;
};


const closeConfirmModal = () => {
  isConfirmModalOpen.value = false;
};

const loading = ref(false);

const bookingConfirm = async () => {

  loading.value = true;
  let res = await axios.post('/car-booking', form.value);
  console.log(res.data);
  loading.value = false;

  if (res.data.msg === 'success') {
    closeConfirmModal();
    toast.success('Car booked successfully');
    router.visit('/rentals-history');
  } else {
    toast.error('Please login first');
    router.visit('/login');
  }

}








</script>


<template>
  <AppLayout>

    <div class="bg-gray-200">
      <div class="container mx-auto py-10">
        <div class="car-details">
          <div class="flex gap-5 items-start justify-center">
            <div class="car-image w-10/12">
              <img class="w-full" :src="`/${props.car.image}`" alt="">
              <div class="space-y-4 py-10 px-8 bg-white shadow-md">
                <h2 class="text-4xl font-bold">{{ props.car.name }}</h2>
                <p>Model: {{ props.car.model }}</p>
                <p>Brand: {{ props.car.brand }}</p>
                <p>Year: {{ props.car.year }}</p>
                <p>Car Type: {{ props.car.car_type }}</p>
              </div>
            </div>
            <div class="content w-1/3 bg-white px-8 py-10 sticky top-0">
              <p class="text-4xl font-bold">${{ props.car.daily_rent_price }} <span class="text-gray-500 text-xl">/
                  day</span></p>
              <div class="booking_form mt-4">
                <form @submit.prevent="openConfirmModal" class="text-left">
                <input type="hidden" id="car_id" v-model="form.car_id" class="input">
                  <div class="form_group mb-4">
                    <label>Start Date</label>
                    <input type="date" id="start_date" class="input" v-model="form.start_date" :min="toDay" required>
                  </div>
                  <div class="form_group mb-4">
                    <label>End Date</label>
                    <input type="date" id="end_date" class="input" v-model="form.end_date" :min="toDay" required>
                  </div>
                  <div class="mt-10">
                    <button class="btn-primary" type="submit">Book Now</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>


    <div v-if="isConfirmModalOpen" class="booking_confirmModel">
      <div class="overlay fixed top-0 left-0 w-full h-screen bg-black/50 z-[99]"></div>
      <div class="deleteModel fixed top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 z-[999]">
        <div class="model_content max-w-[500px] bg-white p-6 shadow-md text-center rounded-md">
          <div class="model_content_header">
            <div class="flex justify-center mb-4">
              <div class="w-16 h-16 rounded-full bg-green-500 flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="text-white w-[30px]">
                <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
              </svg>

              </div>
            </div>

            <h3 class="text-xl font-bold mb-2">Confirm Booking?</h3>
          </div>
          <div class="model_content_body">
            <p class="mb-4">Are you sure you want to book this car?</p>
          </div>
          <div class="model_content_footer flex gap-2 justify-center">
            <button @click="closeConfirmModal" class="cancel_btn">Cancel</button>
            <button v-if="!loading" @click="bookingConfirm" class="btn-primary">Yes, Confirm</button>
            <button v-else type="button" class="btn-primary" disabled>
              <span class="text-white animate-spin">Loading...</span>
          </button>
          </div>
        </div>
      </div>
    </div>


  </AppLayout>
</template>
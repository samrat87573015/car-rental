<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link, router } from '@inertiajs/vue3';
import { ref, defineProps } from 'vue';
import { useToast } from 'vue-toastification';
import axios from 'axios';


const toast = useToast();


const props = defineProps({
  rentals: Array
});


const isModelOpen = ref(false);
const rentalId = ref(null);
const carId = ref(null);

const cancelModelOpen = (rental_id, car_id) => {
  isModelOpen.value = true;
  rentalId.value = rental_id;
  carId.value = car_id;
}
const closeModel = () => {
  isModelOpen.value = false;
  rentalId.value = null;
  carId.value = null;
}

const canceledBooking = async() => {
  let res = await axios.post('/cancel-booking', {
    rental_id: rentalId.value,
    car_id: carId.value
  });

  if (res.data.msg === 'success') {
    closeModel();
    toast.success('Booking canceled successfully');
    router.reload();
  } else {
    closeModel();
    toast.error('Rental already Started');
    closeModel();
  }

}


</script>


<template>
  <AppLayout>
    <div class="container mx-auto">




      <div class="flex flex-wrap -mx-3 mb-5">
        <div class="w-full max-w-full px-3 mb-6  mx-auto">
          <div
            class="relative flex-[1_auto] flex flex-col break-words min-w-0 bg-clip-border rounded-[.95rem] bg-white m-5">
            <div class="customer_pageHead py-3 flex items-center justify-between">
              <div class="div">
                <h1 class="text-2xl font-semibold">Rental History</h1>
                <p class="text-sm text-gray-500">List of all rentals history</p>
              </div>
            </div>
            <div
              class="relative flex flex-col min-w-0 break-words border border-dashed bg-clip-border rounded-2xl border-stone-200 bg-light/30">
              <!-- card body  -->
              <div class="flex-auto block py-8 pt-6 px-9">
                <div class="overflow-x-auto">
                  <table class="w-full my-0 align-middle text-dark border-neutral-200">
                    <thead class="align-bottom">
                      <tr class="font-semibold text-[0.95rem] text-left text-secondary-dark">
                        <th class="pb-3 min-w-[100px]">Car Name</th>
                        <th class="pb-3 min-w-[100px]">Brand</th>
                        <th class="pb-3 min-w-[100px]">Model</th>
                        <th class="pb-3 min-w-[100px]">Total Cost</th>
                        <th class="pb-3 min-w-[100px]">Start Date</th>
                        <th class="pb-3 min-w-[100px]">End Date</th>
                        <th class="pb-3 min-w-[100px]">Status</th>
                        <th class="pb-3 min-w-[100px]">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="rental in props.rentals" class="border-b border-dashed last:border-b-0">
                        <td class="py-3">
                          <span class="flex items-center justify-start gap-2"><img class="w-16"
                              :src="`/${rental.car.image}`" alt=""> {{ rental.car.name }}</span>
                        </td>
                        <td class="py-3">
                          <span>{{ rental.car.brand }}</span>
                        </td>
                        <td class="py-3">
                          <span>{{ rental.car.model }}</span>
                        </td>
                        <td class="py-3">
                          <span>{{ rental.total_cost }}</span>
                        </td>
                        <td class="py-3">
                          <span>{{ rental.start_date }}</span>
                        </td>
                        <td class="py-3">
                          <span>{{ rental.end_date }}</span>
                        </td>
                        <td class="py-3">
                          <span v-if="rental.status === 'Completed'" :class="rental.status === 'Completed' ? 'completedRentalStatus' : ''">{{ rental.status }}</span>
                          <span v-if="rental.status === 'Ongoing'" :class="rental.status === 'Ongoing' ? 'ongoingRentalStatus' : ''">{{ rental.status }}</span>
                          <span v-if="rental.status === 'Canceled'" :class="rental.status === 'Canceled' ? 'canceledRentalStatus' : ''">{{ rental.status }}</span>
                        </td>

                        <td class="py-3">
                          <div class="action_btn_area flex gap-2">

                            <button v-if="rental.status === 'Ongoing'" @click="cancelModelOpen(rental.id, rental.car.id)" class="delete_btn">
                              Canceled
                            </button>
                            <Link :href="`/cars/${rental.car.id}`" v-else class="btn-primary">Details</Link>
                          </div>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div v-if="isModelOpen" class="delete_model">
          <div class="overlay fixed top-0 left-0 w-full h-screen bg-black/50 z-[99]"></div>
          <div class="deleteModel fixed top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 z-[999]">
              <div class="model_content max-w-[500px] bg-white p-6 shadow-md text-center rounded-md">
                  <div class="model_content_header">
                      <div class="flex justify-center mb-4">
                          <div class="w-16 h-16 rounded-full bg-gray-200 flex items-center justify-center">
                              <svg xmlns="http://www.w3.org/2000/svg" fill="#ef4444" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" class="w-6 text-red-500">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                              </svg>
                          </div>
                      </div>

                      <h3 class="text-xl font-bold mb-2">Canceled Car Rental?</h3>
                  </div>
                  <div class="model_content_body">
                      <p class="mb-4">You can't undo this action<br> Are you sure?</p>
                  </div>
                  <div class="model_content_footer flex gap-2 justify-center">
                      <button @click="closeModel" class="cancel_btn">Cancel</button>
                      <button @click="canceledBooking" class="delete_btn">Yes, Confirm</button>
                  </div>
              </div>
          </div>
      </div>


    </div>
  </AppLayout>
</template>
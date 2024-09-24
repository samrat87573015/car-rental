<script setup>
  import AdminLayout from '@/Layouts/AdminLayout.vue';
  import CarCreate from '../../components/car/CarCreate.vue';
  import { ref, defineProps } from 'vue';
  import { Link, router  } from '@inertiajs/vue3'
  import { useToast } from 'vue-toastification';
  import axios from 'axios';


  const props = defineProps(['cars']);

  const isModelOpen = ref(false);
  const carId = ref(null);
  const carImage = ref(null);

  const getImageUrl = (image) => {
     return image ? `/${image}` : '';
  }


  const deleteCarModal = (id, image) => {
      isModelOpen.value = true;
      carId.value = id;
      carImage.value = image;
  }

  const closeDelatModel = () => {
      isModelOpen.value = false;
      carId.value = null;
      carImage.value = null;
  }


  const toast = useToast();

  const deleteCar = async() => {
      try {
          await axios.post('/admin/car-delete',{
                car_id: carId.value,
                oldImgUrl: carImage.value

            });
          closeDelatModel();
          toast.success('Car deleted successfully');
          router.reload();
      }

      catch (error) {
        toast.error('Something went wrong');
      }
  }

  const isCreateModelOpen = ref(false);

  const openCarCreate = () => {
      isCreateModelOpen.value = true;
  }

  const updateCreateModal = (newValue) => {
      isCreateModelOpen.value = newValue;
  }




</script>



<template>
  <AdminLayout>
    <div class="dContent m-2 p-3 bg-white">

      <div class="flex flex-wrap -mx-3 mb-5">
          <div class="w-full max-w-full px-3 mb-6  mx-auto">
              <div
                  class="relative flex-[1_auto] flex flex-col break-words min-w-0 bg-clip-border rounded-[.95rem] bg-white m-5">
                      <div class="customer_pageHead py-3 flex items-center justify-between">
                          <div class="div">
                              <h1 class="text-2xl font-semibold">Cars</h1>
                              <p class="text-sm text-gray-500">List of all cars</p>
                          </div>
                          <div class="CcustomerBtn_area">
                              <button @click="openCarCreate" class="btn btn-primary">Add Car</button>
                          </div>
                      </div>
                  <div class="relative flex flex-col min-w-0 break-words border border-dashed bg-clip-border rounded-2xl border-stone-200 bg-light/30">
                      <!-- card body  -->
                      <div class="flex-auto block py-8 pt-6 px-9">
                          <div class="overflow-x-auto">
                              <table class="w-full my-0 align-middle text-dark border-neutral-200">
                                  <thead class="align-bottom">
                                      <tr class="font-semibold text-[0.95rem] text-left text-secondary-dark">
                                          <th class="pb-3 min-w-[100px]">Name</th>
                                          <th class="pb-3 min-w-[100px]">Brand</th>
                                          <th class="pb-3 min-w-[100px]">Model</th>
                                          <th class="pb-3 min-w-[100px]">Daily Rent</th>
                                          <th class="pb-3 min-w-[100px]">Availability</th>
                                          <th class="pb-3 min-w-[100px]">Action</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      <tr v-for="car in props.cars" class="border-b border-dashed last:border-b-0">
                                          <td class="py-3">
                                              <span class="flex items-center justify-start gap-2"><img class="w-16" :src="getImageUrl(car.image)" alt=""> {{car.name}}</span>
                                          </td>
                                          <td class="py-3">
                                              <span>{{car.brand}}</span>
                                          </td>
                                          <td class="py-3">
                                              <span>{{car.model}}</span>
                                          </td>
                                          <td class="py-3">
                                              <span>{{car.daily_rent_price}}</span>
                                          </td>
                                          <td class="py-3">
                                              <span :class="car.availability === 1 ? 'bg-green-500 px-3 rounded text-white' : 'bg-red-500 px-3 rounded text-white'">{{car.availability === 1 ? 'Available' : 'Not Available'}}</span>
                                          </td>
                                          <td class="py-3">
                                              <div class="action_btn_area flex gap-2">
                                                  <Link :href="`/admin/cars/${car.id}` ">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Z" />
                                                    </svg>
                                                  </Link>
                                                  <Link :href="`/admin/car-edit/${car.id}` ">
                                                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                      <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                                      </svg>
                                                  </Link>
                                                  <button @click="deleteCarModal(car.id, car.image)">
                                                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                      <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                      </svg>

                                                  </button>
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


      <CarCreate :isCreateModelOpen="isCreateModelOpen" @update:isCreateModelOpen="updateCreateModal"/>



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

                      <h3 class="text-xl font-bold mb-2">Delete Car?</h3>
                  </div>
                  <div class="model_content_body">
                      <p class="mb-4">You're going to delete this Car.<br> Are you sure?</p>
                  </div>
                  <div class="model_content_footer flex gap-2 justify-center">
                      <button @click="closeDelatModel" class="cancel_btn">Cancel</button>
                      <button @click="deleteCar" class="delete_btn">Yes, Delete</button>
                  </div>
              </div>
          </div>
      </div>
        
    </div>
  </AdminLayout>
</template>
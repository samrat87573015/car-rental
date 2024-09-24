<script setup>
  import { ref, defineProps, defineEmits } from 'vue';
  import { useToast } from 'vue-toastification';
  import { router } from '@inertiajs/vue3';
  import axios from 'axios';

  defineProps({
    isCreateModelOpen: { type: Boolean, required: true },
    //errors: { type: Object},
  });

  const toast = useToast();

  const $emit = defineEmits(['update:isCreateModelOpen']);

  const createModelClose = () => {
    $emit('update:isCreateModelOpen', false);

  }

  const form = ref({
    name: '',
    model: '',
    year: '',
    brand: '',
    type: '',
    price: '',
    availability: true,
    
  });


  const file = ref(null);

  const placeholderImage = ref('/image/placeholder.webp');

  const onFileChange = (e) => {
    file.value = e.target.files[0];
    previewImage.src = URL.createObjectURL(file.value);
  }


  const createCar = async() => {

    //console.log(form.value.name);

      const formData = new FormData();
      formData.append('name', form.value.name);
      formData.append('model', form.value.model);
      formData.append('year', form.value.year);
      formData.append('brand', form.value.brand);
      formData.append('car_type', form.value.type);
      formData.append('daily_rent_price', form.value.price);
      formData.append('availability', form.value.availability ? 1 : 0);

      if(file.value){
        formData.append('image', file.value);
      }

        let res = await axios.post('/admin/car-store', formData);
        //console.log(res.data);

        if(res.data.msg === 'success'){
          toast.success('Car created successfully');
          $emit('update:isCreateModelOpen', false);
          form.value = {};

          if(file.value){
            URL.revokeObjectURL(file.value);
            file.value = null;
          }

          router.reload();
        }else{
          toast.error('Something went wrong');
        }

    
  }



</script>


<template> 

    <div v-if="isCreateModelOpen" class="customerCreateModel">
        <div class="overlay fixed top-0 left-0 w-full h-full bg-black/50 z-[99]"></div>
        <div class="customerCreateModelContent absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 z-[999]">
            <div class="model_content w-full md:w-[1200px] h-screen overflow-y-scroll bg-white p-6 shadow-md text-center rounded-md">
                <div class="model_content_header relative">
                    <div class="flex justify-center mb-4">
                        <button @click="createModelClose" class="absolute top-0 right-0">
                          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                          </svg>
                        </button>
                    </div>
                    <div class="createModelbody">
                        <h2 class="text-2xl text-left mb-5">Create Car</h2>

                        <form @submit.prevent="createCar" class="text-left">
                            <div class="mb-4">
                                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Car Name</label>
                                <input id="name" type="text" v-model="form.name" class="input" required>
                            </div>

                            <div class="grid grid-cols-2 gap-4">

                              <div class="mb-4">
                                <label for="model" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Car Model</label>
                                <input id="model" type="text" v-model="form.model" class="input" required>
                              </div>
                              <div class="mb-4">
                                  <label for="brand" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Car Brand</label>
                                  <input id="brand" type="text" v-model="form.brand" class="input" required>
                              </div>
                              <div class="mb-4">
                                  <label for="year" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Year</label>
                                  <input id="year" type="number" v-model="form.year" class="input" required>
                              </div>
                              <div class="mb-4">
                                  <label for="car_type" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Car Type</label>
                                  <input id="car_type" type="text" v-model="form.type"  class="input" required >
                                  
                              </div>
                              

                            </div>

                            <div class="mb-4">
                                <label for="price" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Daily Rant Price</label>
                                <input id="daily_rent_price" type="number" v-model="form.price" class="input" required >
                                
                            </div>

                            <div class="mb-4">
                                <label for="availability" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Availability</label>
                                <!-- component -->
                                <label class="relative inline-flex cursor-pointer items-center">
                                  <input id="availability" type="checkbox" v-model="form.availability" class="peer sr-only" />
                                  <label for="availability" class="hidden"></label>
                                  <div class="peer h-4 w-11 rounded border bg-slate-200 after:absolute after:-top-1 after:left-0 after:h-6 after:w-6 after:rounded-md after:border after:border-gray-300 after:bg-white after:transition-all after:content-[''] peer-checked:bg-green-300 peer-checked:after:translate-x-full peer-focus:ring-green-300"></div>
                                </label>
                            </div>

                            <div class="mb-4">
                                <div>
                                  <img class="w-[200px] object-cover" id="previewImage" :src="placeholderImage" alt="">
                                </div>
                                <label for="car_image" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Car Image</label>
                                <input id="image" type="file" @change="onFileChange">
                            </div>

                            <button type="submit" class="btn-primary">Create Car</button>

                          </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

</template>
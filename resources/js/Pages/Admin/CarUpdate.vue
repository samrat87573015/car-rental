<script setup>
import { ref, defineProps, defineEmits } from "vue";
import axios from "axios";
import { useToast } from "vue-toastification";
import { Link, router } from "@inertiajs/vue3";

const toast = useToast();

// const car = usePage().props.value;

const props = defineProps({
  car: Object,
});

const form = ref({
  name: props.car.name,
  model: props.car.model,
  year: props.car.year,
  brand: props.car.brand,
  type: props.car.car_type,
  price: props.car.daily_rent_price,
  availability: props.car.availability === 1 ? true : false,
  car_id: props.car.id,
  oldImgUrl: props.car.image,
});

const file = ref(null);
const previewImage = ref("/image/placeholder.webp");

const onFileChange = (e) => {
  file.value = e.target.files[0];
  previewImage.value = URL.createObjectURL(e.target.files[0]);
};

const updateCar = async () => {
  let formData = new FormData();

  console.log(form.value);

  formData.append("name", form.value.name);
  formData.append("model", form.value.model);
  formData.append("year", form.value.year);
  formData.append("brand", form.value.brand);
  formData.append("car_type", form.value.type);
  formData.append("daily_rent_price", form.value.price);
  formData.append("availability", form.value.availability ? 1 : 0);
  formData.append("image", file.value);
  formData.append("car_id", form.value.car_id);
  formData.append("oldImgUrl", form.value.oldImgUrl);

  let res = await axios.post('/admin/car-update', formData);
  console.log(res.data);

  if (res.data.data === 1) {
    toast.success("Car updated successfully");
    router.visit("/admin/car-list");
  } else {
    toast.error("Something went wrong");
  }


};
</script>

<template>
  <div class="customerCreateModel">
    <div class="overlay fixed top-0 left-0 w-full h-full bg-black/50 z-[99]"></div>
    <div
      class="customerCreateModelContent absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 z-[999]"
    >
      <div
        class="model_content w-full md:w-[1200px] h-screen overflow-y-scroll bg-white p-6 shadow-md text-center rounded-md"
      >
        <div class="model_content_header relative">
          <div class="flex justify-center mb-4">
            <Link href="/admin/car-list" class="absolute top-0 right-0">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.5"
                stroke="currentColor"
                class="size-6"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  d="M6 18 18 6M6 6l12 12"
                />
              </svg>
            </Link>
          </div>

          <div class="createModelbody">
            <h2 class="text-2xl text-left mb-5">Update Car</h2>

            <form @submit.prevent="updateCar" class="text-left">
              <input type="hidden" id="car_id" v-model="form.car_id" />
              <input type="hidden" id="oldImgUrl" v-model="form.oldImgUrl" />
              <div class="mb-4">
                <label
                  for="name"
                  class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2"
                  >Car Name</label
                >
                <input id="name" type="text" v-model="form.name" class="input" />
              </div>

              <div class="grid grid-cols-2 gap-4">
                <div class="mb-4">
                  <label
                    for="model"
                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2"
                    >Car Model</label
                  >
                  <input id="model" type="text" v-model="form.model" class="input" />
                </div>
                <div class="mb-4">
                  <label
                    for="brand"
                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2"
                    >Car Brand</label
                  >
                  <input id="brand" type="text" v-model="form.brand" class="input" />
                </div>
                <div class="mb-4">
                  <label
                    for="year"
                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2"
                    >Year</label
                  >
                  <input id="year" type="text" v-model="form.year" class="input" />
                </div>
                <div class="mb-4">
                  <label
                    for="car_type"
                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2"
                    >Car Type</label
                  >
                  <input id="car_type" type="text" v-model="form.type" class="input" />
                </div>
              </div>

              <div class="mb-4">
                <label
                  for="price"
                  class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2"
                  >Daily Rant Price</label
                >
                <input
                  id="daily_rent_price"
                  type="text"
                  v-model="form.price"
                  class="input"
                />
              </div>

              <div class="mb-4">
                <label
                  for="availability"
                  class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2"
                  >Availability</label
                >
                <!-- component -->
                <label class="relative inline-flex cursor-pointer items-center">
                  <input
                    id="availability"
                    type="checkbox"
                    v-model="form.availability"
                    class="peer sr-only"
                  />
                  <label for="availability" class="hidden"></label>
                  <div
                    class="peer h-4 w-11 rounded border bg-slate-200 after:absolute after:-top-1 after:left-0 after:h-6 after:w-6 after:rounded-md after:border after:border-gray-300 after:bg-white after:transition-all after:content-[''] peer-checked:bg-green-300 peer-checked:after:translate-x-full peer-focus:ring-green-300"
                  ></div>
                </label>
              </div>

              <div class="mb-4">
                <div>
                  <img
                    class="w-[200px] object-cover"
                    id="previewImage"
                    :src="previewImage"
                    alt=""
                  />
                </div>
                <label
                  for="car_image"
                  class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2"
                  >Car Image</label
                >
                <input id="image" type="file" @change="onFileChange" />
              </div>

              <button type="submit" class="btn-primary">Update Car</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

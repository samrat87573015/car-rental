<script setup>

import { ref, defineProps, defineEmits } from 'vue';
import * as yup from 'yup';
import axios from 'axios';
import { useToast } from 'vue-toastification';
import { router } from '@inertiajs/vue3'


defineProps({
    isModelOpenCreate: {
        type: Boolean,
        required: true
    }
});


const $emit = defineEmits(['update:isModelOpenCreate']);

const createModelClose = () => {
   $emit('update:isModelOpenCreate', false);

}

    const schema = yup.object().shape({
        name: yup.string().required('Name is required.'),
        email: yup.string().email('Email must be valid.').required('Email is required.'),
        phone: yup.string().required('Phone is required.'),
        address: yup.string().required('Address is required.'),
        password: yup.string().min(6, 'Password must be at least 6 characters long.').required('Password is required.'),
    });

const form = ref({
    name: '',
    email: '',
    phone: '',
    address: '',
    password: '',
});

const errors = ref({});

const validateForm = async () => {
      try {
        await schema.validate(form.value, { abortEarly: false })
        errors.value = {}
        return true
      } catch (err) {
        errors.value = err.inner.reduce((acc, { path, message }) => {
          acc[path] = message
          return acc
        }, {})
        return false
      }
    }

    const toast = useToast();

const createCustomer = async() => {
    if (await validateForm()) {
        let res = await axios.post('/admin/customer-store', form.value);
        if(res.data.msg === 'success'){
            toast.success('Customer created successfully');
            $emit('update:isModelOpenCreate', false);
            router.reload();
            form.value = {};
        }else{
            toast.error('Customer already exists');
        }
    }
}



</script>


<template>

      <div v-if="isModelOpenCreate" class="customerCreateModel">
          <div class="overlay absolute top-0 left-0 w-full h-full bg-black/50 z-[99]"></div>
          <div class="customerCreateModelContent absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 z-[999]">
              <div class="model_content w-full md:w-[800px] bg-white p-6 shadow-md text-center rounded-md">
                  <div class="model_content_header relative">
                      <div class="flex justify-center mb-4">
                          <button @click="createModelClose" class="absolute top-0 right-0">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                            </svg>
                          </button>
                      </div>
                      <div class="createModelbody">
                          <h2 class="text-2xl">Create Customer</h2>

                          <form @submit.prevent="createCustomer" class="text-left">
                              <div class="mb-4">
                                  <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Name</label>
                                  <input id="name" type="text" v-model="form.name" class="shadow-sm rounded-md w-full px-3 py-2 border border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                                  <span class="text-red-500 text-sm" v-if="errors.name">{{ errors.name }}</span>
                              </div>
                              <div class="mb-4">
                                  <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Email</label>
                                  <input id="email" type="email" v-model="form.email" class="shadow-sm rounded-md w-full px-3 py-2 border border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                                  <span class="text-red-500 text-sm" v-if="errors.email">{{ errors.email }}</span>
                              </div>
                              <div class="mb-4">
                                  <label for="phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Phone</label>
                                  <input id="phone" type="number" v-model="form.phone" class="shadow-sm rounded-md w-full px-3 py-2 border border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                                  <span class="text-red-500 text-sm" v-if="errors.phone">{{ errors.phone }}</span>
                              </div>
                              <div class="mb-4">
                                  <label for="Address" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Address</label>
                                  <input id="Address" type="text" v-model="form.address" class="shadow-sm rounded-md w-full px-3 py-2 border border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                                  <span class="text-red-500 text-sm" v-if="errors.address">{{ errors.address }}</span>
                              </div>
                              <div class="mb-4">
                                  <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">password</label>
                                  <input id="password" type="password" v-model="form.password" class="shadow-sm rounded-md w-full px-3 py-2 border border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                                  <span class="text-red-500 text-sm" v-if="errors.password">{{ errors.password }}</span>
                              </div>

                              <button type="submit" class="btn-primary">Create Customer</button>

                            </form>

                      </div>
                  </div>
              </div>
          </div>
      </div>

</template>
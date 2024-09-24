<script setup>
    import AppLayout from '@/Layouts/AppLayout.vue'
    import { ref } from 'vue'
    import axios from 'axios'
    import { useToast } from 'vue-toastification';
    import { router } from '@inertiajs/vue3'
    import * as yup from 'yup';

    const schema = yup.object().shape({
        name: yup.string().required('Name is required.'),
        email: yup.string().email('Email must be valid.').required('Email is required.'),
        phone: yup.string().required('Phone is required.'),
        address: yup.string().required('Address is required.'),
        password: yup.string().min(6, 'Password must be at least 6 characters long.').required('Password is required.'),
        password_confirmation: yup.string().oneOf([yup.ref('password'), null], 'Passwords must match'),
    })

    const form = ref({
      name: '',
      email: '',
      phone: '',
      address: '',
      password: '',
      password_confirmation: '',
    })

    const errors = ref({})


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

    const register = async() => {
        if (await validateForm()) {
        const res = await axios.post('/user-register', form.value);
        console.log(res.data);
        if(res.data.msg === 'success'){
            toast.success('Register success');
            router.visit('/login');
        }else{
            toast.error('Email already exists');
        }
        
      }
    };




</script>


<template>
    <app-layout>
        <div class="container mx-auto py-5">
            <div class="flex py-10 items-center justify-center w-full dark:bg-gray-950">
                <div class="bg-white dark:bg-gray-900 shadow-md rounded-lg px-8 py-6 w-[500px]">
                    <h1 class="text-2xl font-bold text-center mb-4 dark:text-gray-200">Create Account</h1>
                    <form @submit.prevent="register">
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Name</label>
                            <input id="name" type="text" v-model="form.name" class="input" placeholder="Name">
                            <span class="text-red-500 text-sm" v-if="errors.name">{{ errors.name }}</span>
                        </div>
                        <div class="mb-4">
                            <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Email Address</label>
                            <input id="email" type="email" v-model="form.email" class="input" placeholder="your@email.com">
                            <span class="text-red-500 text-sm" v-if="errors.email">{{ errors.email }}</span>
                        </div>
                        <div class="mb-4">
                            <label for="phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Phone</label>
                            <input id="phone" type="number" v-model="form.phone" class="input" placeholder="Phone">
                            <span class="text-red-500 text-sm" v-if="errors.phone">{{ errors.phone }}</span>
                        </div>
                        <div class="mb-4">
                            <label for="address" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Address</label>
                            <input id="address" type="text" v-model="form.address" class="input" placeholder="Address">
                            <span class="text-red-500 text-sm" v-if="errors.address">{{ errors.address }}</span>
                        </div>
                        <div class="mb-4">
                            <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Password</label>
                            <input id="password" type="password" v-model="form.password" class="input" placeholder="Enter your password">
                            <span class="text-red-500 text-sm" v-if="errors.password">{{ errors.password }}</span>
                        </div>
                        <div class="mb-4">
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Confirm Password</label>
                            <input id="confirm_password" type="password" v-model="form.password_confirmation" class="input" placeholder="Re-Enter your password">
                            <span class="text-red-500 text-sm" v-if="errors.password_confirmation">{{ errors.password_confirmation }}</span>
                        </div>
                        <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium bg-pColor hover:bg-indigo-700">Sing Up</button>
                    </form>
                </div>
            </div>
        </div>
    </app-layout>
</template>
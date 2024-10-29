<script setup>
    import AppLayout from '@/Layouts/AppLayout.vue'
    import axios from 'axios'
    import { reactive } from 'vue'
    import { useToast } from 'vue-toastification';
    import { Link, router } from '@inertiajs/vue3'


    const toast = useToast();

    const form = reactive({
        email: '',
        password: ''
    });

    const login = async() => {

        const fromData = {
            email: form.email,
            password: form.password
        }

        const res = await axios.post('/user-login', fromData);
        console.log(res.data);
        if(res.data.msg === 'success'){
            toast.success('Login success');
            router.visit('/');
        }else{
            toast.error('Login failed');
        }
        
    }
</script>

<template>
    <app-layout>
        <div class="py-5">
            <!-- component -->
            <div class="flex py-10 items-center justify-center w-full dark:bg-gray-950">
                <div class="bg-white dark:bg-gray-900 shadow-md rounded-lg px-8 py-6 w-[500px]">
                    <h1 class="text-2xl font-bold text-center mb-4 dark:text-gray-200">Login</h1>
                    <form @submit.prevent="login()">
                        <div class="mb-4">
                            <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Email Address</label>
                            <input type="email" v-model="form.email" class="shadow-sm rounded-md w-full px-3 py-2 border border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" placeholder="your@email.com" required>
                        </div>
                        <div class="mb-4">
                            <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Password</label>
                            <input type="password" v-model="form.password" class="shadow-sm rounded-md w-full px-3 py-2 border border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" placeholder="Enter your password" required>
                        </div>
                        <div class="flex items-center justify-between mb-4">
                            <Link href="/register"
                                class="text-sm  text-indigo-500 hover:text-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Create
                                Account</Link>
                        </div>
                        <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium bg-pColor hover:bg-indigo-700">Login</button>

                        <div class="mt-4 w-full border border-gray-300 px-4 py-2">
                            <a href="/auth/google" class="flex items-center justify-center">
                                <span class="mr-2">
                                    <svg width="24" height="24" version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" class="LgbsSe-Bz112c"><g><path fill="#EA4335" d="M24 9.5c3.54 0 6.71 1.22 9.21 3.6l6.85-6.85C35.9 2.38 30.47 0 24 0 14.62 0 6.51 5.38 2.56 13.22l7.98 6.19C12.43 13.72 17.74 9.5 24 9.5z"></path><path fill="#4285F4" d="M46.98 24.55c0-1.57-.15-3.09-.38-4.55H24v9.02h12.94c-.58 2.96-2.26 5.48-4.78 7.18l7.73 6c4.51-4.18 7.09-10.36 7.09-17.65z"></path><path fill="#FBBC05" d="M10.53 28.59c-.48-1.45-.76-2.99-.76-4.59s.27-3.14.76-4.59l-7.98-6.19C.92 16.46 0 20.12 0 24c0 3.88.92 7.54 2.56 10.78l7.97-6.19z"></path><path fill="#34A853" d="M24 48c6.48 0 11.93-2.13 15.89-5.81l-7.73-6c-2.15 1.45-4.92 2.3-8.16 2.3-6.26 0-11.57-4.22-13.47-9.91l-7.98 6.19C6.51 42.62 14.62 48 24 48z"></path><path fill="none" d="M0 0h48v48H0z"></path></g></svg>
                                </span>
                                <span>Continue with Google</span>
                            </a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </app-layout>
</template>
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
                    </form>
                </div>
            </div>
        </div>
    </app-layout>
</template>
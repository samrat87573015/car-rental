<script setup>
    import AppLayout from '@/Layouts/AppLayout.vue'
    import { Link } from '@inertiajs/vue3'
    import { ref, defineProps } from 'vue';

    const bannerImage = ref('/image/car-right.png');


    const props = defineProps({
        cars: Array
    });


</script>

<template>
    <app-layout>
        <section class="home Banner bg-[#f5f7f6]">
            <div class="container mx-auto">
                <div class="banner_inner flex justify-between items-center h-screen">
                    <div class="content w-1/2">  
                        <span class=" font-bold mb-2 inline-block">100% Trusted car rental platform in the World</span>
                        <h2 class="text-6xl font-bold mb-5 ">Find Your Best<br>
                            <span class="text-indigo-500">Dream Car for Rental</span></h2>
                        <div class="btn_area mt-10">
                            <Link href="/cars" class="btn-primary">Book Now</Link>
                        </div>
                    </div>
                    <div class="img_area w-1/2">
                        <img :src="bannerImage" alt="">
                    </div>
                </div>
            </div>
        </section>

        <section class="car_list grid_view py-20">
            <div class="container mx-auto">
                <div class="section_title text-center mb-10">
                    <h2 class="text-4xl font-bold">Car List</h2>
                    <p>Explore our huge collection of cars</p>
                </div>
                <div class="car_list_inner grid grid-cols-3 gap-5 items-start">
                    <div v-for="car in props.cars" :key="car.id" class="car_item shadow-md">
                        <div class="ima w-full h-[300px]">
                            <img class="w-full h-full object-cover" :src="`/${car.image}`" alt="">
                        </div>
                        <div class="content space-y-3 py-5 px-10 relative">
                            <div class="absolute -top-[50px] right-[30px]">
                                <p class="w-[100px] h-[100px] rounded-full flex justify-center items-center bg-indigo-500 text-white">${{ car.daily_rent_price }}</p>
                            </div>
                            <Link :href="`/cars/${car.id}`"><h3 class="text-xl font-bold pt-5">{{ car.name }}</h3></Link>
                            <p class="text-gray-500">Model: {{ car.model }}</p>
                            <p class="text-gray-500">Brand: {{ car.brand }}</p>
                            <div class="btn_area mt-5">
                                <Link :href="`/cars/${car.id}`" class="flex items-center w-fit px-5 py-2 text-indigo-500 border border-indigo-500">View Details<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 ml-2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 19.5 15-15m0 0H8.25m11.25 0v11.25" />
                                </svg>

                                </Link>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="btn_area mt-20 text-center">
                    <Link href="/rentals" class="btn-primary">View All Cars</Link>
                </div>
                    
            </div>
        </section>

    </app-layout>
</template>
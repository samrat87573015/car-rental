<script setup>
    import AdminLayout from '@/Layouts/AdminLayout.vue';
    import { defineProps, ref } from 'vue';


    const props = defineProps({
        data: Object
    });



</script>


<template>

    <AdminLayout>

        <div class="dContent m-2 p-3 ">

            <div class="wrap">
                <div class="grid grid-cols-3 gap-4">
                    <div class="dCard bg-white shadow-md rounded-lg px-8 py-6 flex items-center justify-between">
                        <div class="cardContent">
                            <h2 class="text-4xl font-bold mb-3 text-indigo-500">{{ props.data.carNumber }}</h2>
                            <p>Total Cars</p>
                        </div>
                        <div class="dashboardIcon w-[100px]">
                            
                        </div>
                    </div>
                    <div class="dCard bg-white shadow-md rounded-lg px-8 py-6 flex items-center justify-between">
                        <div class="cardContent">
                            <h2 class="text-4xl font-bold mb-3 text-indigo-500">{{ props.data.availabilityCar }}</h2>
                            <p>Total Available Cars</p>
                        </div>
                        <div class="dashboardIcon w-[100px]">
                            
                        </div>
                    </div>
                    <div class="dCard bg-white shadow-md rounded-lg px-8 py-6 flex items-center justify-between">
                        <div class="cardContent">
                            <h2 class="text-4xl font-bold mb-3 text-indigo-500">{{ props.data.rentalNumber }}</h2>
                            <p>Total Rentals</p>
                        </div>
                        <div class="dashboardIcon w-[100px]">
                            
                        </div>
                    </div>
                    <div class="dCard bg-white shadow-md rounded-lg px-8 py-6 flex items-center justify-between">
                        <div class="cardContent">
                            <h2 class="text-4xl font-bold mb-3 text-indigo-500"> ${{ props.data.totalEarnings }}</h2>
                            <p>Total Earnings for cars rented</p>
                        </div>
                        <div class="dashboardIcon w-[100px]">
                            
                        </div>
                    </div>
                    <div class="dCard bg-white shadow-md rounded-lg px-8 py-6 flex items-center justify-between">
                        <div class="cardContent">
                            <h2 class="text-4xl font-bold mb-3 text-indigo-500"> {{ props.data.totalCustomer }}</h2>
                            <p>Total Customers</p>
                        </div>
                        <div class="dashboardIcon w-[100px]">
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </AdminLayout>
    
</template>
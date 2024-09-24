<script setup>
  import AdminLayout from '@/Layouts/AdminLayout.vue';
  import { defineProps } from 'vue';
  import { Link } from '@inertiajs/vue3';


  const props = defineProps({
    customer: Object
  });
</script>



<template>  
  <AdminLayout>
    <div class="dContent m-2 p-10 bg-white">

        <div class="flex justify-between">
          <h1 class="text-2xl font-bold text-gray-800">Customer Details</h1>
          <div>
              <Link class="btn-primary" href="/admin/customer-list">back</Link>
          </div>
        </div>
        <div class="cus_details">

            <p class="py-2 text-lg">Name: {{ props.customer.name }}</p>
            <p class="py-2 text-lg">Email: {{ props.customer.email }}</p>
            <p class="py-2 text-lg">Phone: {{ props.customer.phone }}</p>
            <p class="py-2 text-lg">Address: {{ props.customer.address }}</p>
        </div>
    </div>
  </AdminLayout>
</template>
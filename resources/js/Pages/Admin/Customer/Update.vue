<script setup>
  import AdminLayout from '@/Layouts/AdminLayout.vue';
  import { defineProps, ref } from 'vue';
  import  axios from 'axios';
  import { useToast } from 'vue-toastification';
  import { router } from '@inertiajs/vue3';


  const toast = useToast();


  const props = defineProps({
    customer: Object
  });


  const customer = ref({
    customer_id: props.customer.id,
    name: props.customer.name,
    email: props.customer.email,
    phone: props.customer.phone,
    address: props.customer.address,
    password: props.customer.password
  });


  const updateCustomer = async() => {
    let res = await axios.post('/admin/customer-update', customer.value);

    if(res.data.msg === 'success'){
      toast.success("Customer updated successfully");
      router.visit('/admin/customer-list');
    }else{
      toast.error("Something went wrong");
    }
  }
    




</script>


<template>
  <AdminLayout>
    <div class="dContent m-2 p-10 bg-white">
        <h1>Customer Update</h1>

        <div class="cus_update_form">
          <form @submit.prevent="updateCustomer">

            <input type="hidden" id="id" v-model="customer.customer_id" />

            <div class="mb-4">  
              <label for="name">Name</label>
              <input type="text" id="name" v-model="customer.name" class="input">
            </div>

            <div class="mb-4">  
              <label for="email">Email</label>
              <input type="text" id="email" v-model="customer.email" class="input">
            </div>

            <div class="mb-4">  
              <label for="phone">Phone</label>
              <input type="text" id="phone" v-model="customer.phone" class="input">
            </div>

            <div class="mb-4">  
              <label for="address">Address</label>
              <input type="text" id="address" v-model="customer.address" class="input">
            </div>

            <div class="mb-4">  
              <label for="city">Password</label>
              <input type="password" id="password" v-model="customer.password" class="input">
            </div>

            <button class="btn-primary" type="submit">Update</button>
          </form>
        </div>
    </div>
  </AdminLayout>
</template>
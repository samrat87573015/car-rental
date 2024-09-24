<script setup>
    import { Link } from '@inertiajs/vue3';

    import { onMounted, ref } from 'vue';
    import axios from 'axios';

    const userRole = ref(null);

    onMounted( async() => {
      let res = await axios.get('/user-check');
      //console.log(res.data);

      if(res.data.userRole === 'admin'){
        userRole.value = 'admin';
      }else if(res.data.userRole === 'customer'){
        userRole.value = 'customer';
      }else{
        userRole.value = null;
      }

      //console.log(userRole.value);

    });


</script>

<template>
    <header class="container mx-auto p-6 flex justify-between">
        <div>
            <div class="logo"><Link href="/">Car Rental</Link></div>
        </div>
        <div class="flex gap-5">
    
            <Link href="/">Home</Link>
            <Link href="/about">About</Link>
            <Link href="/rentals">Rentals</Link>
            <Link v-if="userRole === 'customer'" href="/rentals-history">Rentals History</Link>
            <Link href="/contact">Contact</Link>
            <Link v-if="!userRole" href="/login">Login/Sing-up</Link>
            <Link v-if="userRole === 'admin'" href="/admin/dashboard">Dashboard</Link>
            <Link v-if="userRole === 'customer'" href="/logout">Logout</Link>
        </div>
    </header>
</template>
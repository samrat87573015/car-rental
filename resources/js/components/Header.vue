<script setup>
import { Link } from '@inertiajs/vue3';
import { useAuthStore } from '@/Stores/auth';
import { onMounted } from 'vue';

const auth = useAuthStore();

onMounted(() => {
  auth.init(); // Initialize the user role on component mount
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
      <Link v-if="auth.userRole === 'customer'" href="/rentals-history">Rentals History</Link>
      <Link href="/contact">Contact</Link>
      <Link v-if="auth.userRole === null" href="/login">Login/Sign-up</Link>
      <Link v-if="auth.userRole === 'admin'" href="/admin/dashboard">Dashboard</Link>
      <Link v-if="auth.userRole === 'customer'" href="/logout">Logout</Link>
    </div>
  </header>
</template>

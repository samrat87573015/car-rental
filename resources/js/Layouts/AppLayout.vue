<script setup>

import Header from '../components/Header.vue';


</script>

<template>

    <Header />


    <slot />

    <footer class="text-center p-10 bg-gray-400">
        <p>Copyright 2024 car rentals </p>
    </footer>
</template>
<script setup>

    import DashboardHeader from '../components/DashboardHeader.vue';
    import DashboardSidenav from '../components/DashboardSidenav.vue';


</script>

<template>
    <div>

        <DashboardSidenav />
        <main class="w-full md:w-[calc(100%-256px)] md:ml-64 bg-gray-200 min-h-screen transition-all main">

        <DashboardHeader  />

        <slot />

        </main>

    </div>
</template>
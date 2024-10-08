<script setup>
    import {ref} from 'vue';

    import DashboardHeader from '../components/DashboardHeader.vue';
    import DashboardSidenav from '../components/DashboardSidenav.vue';


    const isActiveSidebar = ref(false);




</script>

<template>
    <div>

        <DashboardSidenav :isActiveSidebar="isActiveSidebar" />
        <main class="w-full md:w-[calc(100%-256px)] md:ml-64 bg-gray-200 min-h-screen transition-all main" :class="isActiveSidebar ? 'active' : ''">

        <DashboardHeader :isActiveSidebar="isActiveSidebar" @update:isActiveSidebar="isActiveSidebar = $event" />

        <slot />

        </main>

    </div>
</template>
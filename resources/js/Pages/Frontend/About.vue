<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { ref } from 'vue';

const aboutImage = ref('/image/about.jpg');
</script>


<template>
  <AppLayout>

    <div class="about bg-gray-100 py-20">

      <div class="container mx-auto px-4">

        <div class="flex gap-5">
          <div class="about_content mb-5 w-1/2">
            <h1 class="text-5xl font-bold mb-5">We Are More Than <br><span class="text-indigo-500">A Car Rental
                Company</span></h1>
            <p>Car repair quisque sodales dui ut varius vestibulum drana tortor turpis porttiton tellus eu euismod nisl
              massa nutodio in the miss volume place urna lacinia eros nunta urna mauris vehicula rutrum in the miss on
              volume interdum.</p>
            <div class="mb-10 mt-5">
              <h2 class="text-2xl font-semibold mb-4">Our Story</h2>
              <p class="text-lg leading-relaxed">
                Founded in 2010, our company started with a passion for delivering excellent services to our customers.
                Over the years, we have grown into a reputable organization with a commitment to innovation and quality.
              </p>
            </div>

            <div class="mb-10">
              <h2 class="text-2xl font-semibold mb-4">Our Mission</h2>
              <p class="text-lg leading-relaxed">
                Our mission is to provide top-notch solutions that empower businesses to reach new heights. We believe
                in
                fostering strong relationships
                with our clients through transparency, reliability, and outstanding customer support.
              </p>
            </div>
          </div>

          <div class="w-1/2">
            <div class="rounded-2xl overflow-hidden pl-[30px]">
              <img :src="aboutImage" alt="About Image" class="w-full h-full object-cover rounded-2xl">
            </div>
          </div>
        </div>

        <section class="py-20">
          <h2 class="text-2xl font-semibold mb-4">Meet Our Team</h2>
          <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white p-6 rounded-lg shadow-md">
              <img src="https://via.placeholder.com/150" alt="Team Member" class="rounded-full mx-auto mb-4">
              <h3 class="text-xl font-bold text-center">John Doe</h3>
              <p class="text-center text-gray-600">CEO & Founder</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md">
              <img src="https://via.placeholder.com/150" alt="Team Member" class="rounded-full mx-auto mb-4">
              <h3 class="text-xl font-bold text-center">Jane Smith</h3>
              <p class="text-center text-gray-600">CTO</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md">
              <img src="https://via.placeholder.com/150" alt="Team Member" class="rounded-full mx-auto mb-4">
              <h3 class="text-xl font-bold text-center">Emily Johnson</h3>
              <p class="text-center text-gray-600">Lead Designer</p>
            </div>
          </div>
        </section>

      </div>

    </div>


  </AppLayout>
</template>
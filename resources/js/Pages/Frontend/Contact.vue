<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
</script>

<template>
  <AppLayout>
    <div class="contanct bg-gray-100 py-20">
      <div class="container mx-auto px-4 py-10">
        <section class="bg-white shadow-lg rounded-lg p-8">
          <h2 class="text-3xl font-semibold text-center mb-6">Get in Touch</h2>
          <p class="text-lg text-center text-gray-600 mb-8">
            Have any questions? We'd love to hear from you! Fill out the form below and we'll get back to you as soon as
            possible.
          </p>

          <form action="#" method="POST" class="space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
              <!-- Name -->
              <div class="flex flex-col">
                <label for="name" class="text-gray-700 font-semibold mb-2">Full Name</label>
                <input type="text" id="name" name="name"
                  class="border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                  placeholder="Your Name" required>
              </div>

              <!-- Email -->
              <div class="flex flex-col">
                <label for="email" class="text-gray-700 font-semibold mb-2">Email Address</label>
                <input type="email" id="email" name="email"
                  class="border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                  placeholder="Your Email" required>
              </div>
            </div>

            <!-- Subject -->
            <div class="flex flex-col">
              <label for="subject" class="text-gray-700 font-semibold mb-2">Subject</label>
              <input type="text" id="subject" name="subject"
                class="border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                placeholder="Subject" required>
            </div>

            <!-- Message -->
            <div class="flex flex-col">
              <label for="message" class="text-gray-700 font-semibold mb-2">Message</label>
              <textarea id="message" name="message" rows="6"
                class="border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                placeholder="Your Message" required></textarea>
            </div>

            <!-- Submit Button -->
            <div class="text-center">
              <button type="submit"
                class="bg-blue-600 text-white font-semibold py-3 px-8 rounded-lg hover:bg-blue-700 transition-colors duration-300">
                Send Message
              </button>
            </div>
          </form>
        </section>

        <!-- Contact Information -->
        <section class="mt-12">
          <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="text-center bg-white shadow-lg rounded-lg p-6">
              <div class="bg-blue-600 text-white p-6 rounded-full mx-auto w-16 h-16 flex items-center justify-center">
                <!-- Phone Icon -->
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" />
              </svg>

              </div>
              <h3 class="text-xl font-semibold mt-4">Phone</h3>
              <p class="text-gray-600">(123) 456-7890</p>
            </div>

            <div class="text-center bg-white shadow-lg rounded-lg p-6">
              <div class="bg-blue-600 text-white p-6 rounded-full mx-auto w-16 h-16 flex items-center justify-center">
                <!-- Email Icon -->
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                </svg>

              </div>
              <h3 class="text-xl font-semibold mt-4">Email</h3>
              <p class="text-gray-600">contact@example.com</p>
            </div>

            <div class="text-center bg-white shadow-lg rounded-lg p-6">
              <div class="bg-blue-600 text-white p-6 rounded-full mx-auto w-16 h-16 flex items-center justify-center">
                <!-- Location Icon -->
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                  <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                </svg>

              </div>
              <h3 class="text-xl font-semibold mt-4">Location</h3>
              <p class="text-gray-600">123 Main Street, City, Country</p>
            </div>
          </div>
        </section>
      </div>

    </div>
  </AppLayout>

</template>

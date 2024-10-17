import { defineStore } from "pinia";
import { ref } from "vue";
import axios from "axios";

export const useAuthStore = defineStore("auth", () => {
  const userRole = ref(null);

  // Function to initialize the user role
  const init = async () => {
    try {
      const res = await axios.get('/user-check');

      if (res.data.userRole === 'admin') {
        userRole.value = 'admin';
      } else if (res.data.userRole === 'customer') {
        userRole.value = 'customer';
      } else {
        userRole.value = null;
      }
    } catch (error) {
      console.error('Error fetching user role:', error);
      userRole.value = null; // Set to null or handle error
    }
  };

  return {
    userRole,
    init
  };
});

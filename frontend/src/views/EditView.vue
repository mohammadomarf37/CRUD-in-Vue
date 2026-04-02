<template>
  <div class="max-w-md mx-auto my-20 bg-white shadow-lg rounded-lg overflow-hidden text-(--font-color)">
    <div class="text-2xl py-4 px-6 bg-(--secondary-color)  text-center font-bold uppercase">
      Create User
    </div>
    <form class="py-5 px-6" @submit.prevent="updateUser()">
      <p v-if="successMessage.length > 0" class="text-sm mb-5 text-green-500 bg-green-200 inline-block px-2 py-1 rounded-sm">{{ successMessage }}</p>
      <p v-if="errorMessage.length > 0" class="text-sm mb-5 text-red-500 bg-red-200 inline-block px-2 py-1 rounded-sm">{{ errorMessage }}</p>
      <div class="mb-4">
        <label class="block text-(--font-color) font-bold mb-2" for="name"> Name </label>
        <input
          class="input-field"
          id="name"
          type="text"
          @input="errorMessage = ''"
          placeholder="Enter your name"
          v-model="user.name"
        />
      </div>
      <div class="mb-4">
        <label class="block text-(--font-color) font-bold mb-2" for="email"> Email </label>
        <input
          class="input-field"
          id="email"
          type="email"
          @input="errorMessage = ''"
          placeholder="Enter your email"
          v-model="user.email"
        />
      </div>
      <div class="mb-4 relative">
        <label class="block text-(--font-color) font-bold mb-2" for="password"> Password </label>
        <input
          class="input-field"
          id="password"
          :type="isPasswordVisible ? 'text' : 'password'"
          @input="errorMessage = ''"
          placeholder="Enter your password"
          v-model="user.password"
        />
        <div 
            @click="togglePassword()"
            class="absolute pr-3 right-0 bottom-2"
        >
            <i :class="isPasswordVisible ? 'bi bi-eye-slash' : 'bi bi-eye'" class="cursor-pointer"></i>
        </div>
      </div>
      <!-- <div class="mb-5">
        <label class="block text-(--font-color) font-bold mb-2" for="phone"> Phone Number </label>
        <input
          class="input-field"
          id="phone"
          type="tel"
          placeholder="Enter your phone number"
        />
      </div> -->
      <div class="flex items-center justify-center mb-4">
        <button
          class="py-2 px-4 rounded hover:bg-(--primary-color) hover:text-(--hover-color) font-semibold focus:outline-none focus:shadow-outline transition-all duration-300"
          :class="isUpdating ? 'bg-(--primary-color) text-(--hover-color) pointer-events-none' : 'bg-(--secondary-color) text-(--font-color) cursor-pointer'"
        >
          {{ isUpdating ? 'Updating...' : 'Update User' }}
          <i v-if="isUpdating" class="bi bi-hourglass-split animate-spin inline-block"></i>
        </button>
      </div>
    </form>
  </div>
</template>

<script setup lang="ts">
import { onMounted, ref } from 'vue';
import axios from 'axios';
import router from '@/router';
import { useRoute } from 'vue-router';

const user = ref({
  name: '',
  email: '',
  password: '',
});
const isUpdating = ref(false);
const successMessage = ref('');
const errorMessage = ref('');
const isPasswordVisible = ref(false);
const route = useRoute();
const userId = route.params.id;

// Get User by ID
async function getUserById() {
    try{
        const response = await axios.get(`http://localhost:8000/api/get/${userId}/user`);
        user.value = response.data;
    }
    catch(error){
        console.error("Error: ", error);
    }
}

// Toggle Password
function togglePassword(){
    isPasswordVisible.value = !isPasswordVisible.value;
}

// Update User
async function  updateUser() {
    try{
        isUpdating.value = true;

        // Validation
        if(!user.value.name || !user.value.email || !user.value.password){
          errorMessage.value = 'Please fill all the fields';
          setTimeout(() => {
            errorMessage.value = '';
          }, 3000);
          return;
        }

        const response = await axios.put(`http://localhost:8000/api/update/${userId}/user`, user.value);
        successMessage.value = response.data.message;
        setTimeout(() => {
          successMessage.value = '';
          router.push('/read');
        }, 1000);
    }
    catch(error){
        console.error("Error: ", error.response?.data?.error);
        errorMessage.value = error.response?.data?.error;
        setTimeout(() => {
          errorMessage.value = '';
        }, 2000);
    }
}

onMounted(() => {
    getUserById();
});
</script>

<style scoped>

</style>
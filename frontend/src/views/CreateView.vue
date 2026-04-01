<template>
  <div class="max-w-md mx-auto my-20 bg-white shadow-lg rounded-lg overflow-hidden text-(--font-color)">
    <div class="text-2xl py-4 px-6 bg-(--secondary-color)  text-center font-bold uppercase">
      Create User
    </div>
    <form class="py-5 px-6" @submit.prevent="createUser">
      <p v-if="successMessage.length > 0" class="text-sm mb-5 text-green-500 bg-green-200 inline-block px-2 py-1 rounded-sm">{{ successMessage }}</p>
      <p v-if="errorMessage.length > 0" class="text-sm mb-5 text-red-500 bg-red-200 inline-block px-2 py-1 rounded-sm">{{ errorMessage }}</p>
      <div class="mb-4">
        <label class="block text-(--font-color) font-bold mb-2" for="name"> Name </label>
        <input
          class="input-field"
          id="name"
          type="text"
          placeholder="Enter your name"
          v-model="newUser.name"
        />
      </div>
      <div class="mb-4">
        <label class="block text-(--font-color) font-bold mb-2" for="email"> Email </label>
        <input
          class="input-field"
          id="email"
          type="email"
          placeholder="Enter your email"
          v-model="newUser.email"
        />
      </div>
      <div class="mb-4 relative">
        <label class="block text-(--font-color) font-bold mb-2" for="password"> Password </label>
        <input
          class="input-field"
          id="password"
          :type="isPasswordVisible ? 'text' : 'password'"
          placeholder="Enter your password"
          v-model="newUser.password"
        />
        <button 
            type="submit"
            @click="togglePassword"
            class="absolute pr-3 right-0 bottom-2"
        >
            <i :class="isPasswordVisible ? 'bi bi-eye-slash' : 'bi bi-eye'" class="cursor-pointer"></i>
        </button>
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
          class="bg-(--secondary-color) text-(--font-color) py-2 px-4 rounded hover:bg-(--primary-color) hover:text-(--hover-color) font-semibold focus:outline-none focus:shadow-outline transition-all duration-300 cursor-pointer"
        >
          {{ isCreating ? 'Creating...' : 'Create User' }}
        </button>
      </div>
    </form>
  </div>
</template>

<script setup lang="ts">
import { ref } from 'vue';
import axios from 'axios';
import router from '@/router';

const newUser = ref({
  name: '',
  email: '',
  password: ''
});
const isCreating = ref(false);
const isPasswordVisible = ref(false);
const successMessage = ref('');
const errorMessage = ref('');

// Toggle Password
function togglePassword(){
    isPasswordVisible.value = !isPasswordVisible.value;
}

// Create User
async function createUser() {
  try{
    isCreating.value = true;

    if(!newUser.value.name || !newUser.value.email || !newUser.value.password){
      errorMessage.value = 'Please fill all the fields';
      setTimeout(() => {
        errorMessage.value = '';
      }, 3000);
      return;
    }
    
    const response = await axios.post('http://localhost:8000/api/create/user', newUser.value);
    newUser.value = { name: '', email: '', password: '' };
    successMessage.value = response.data.message;
  }
  catch (error){
    console.error('Error', error);
    errorMessage.value = error.response?.data?.error;
  }
  finally{
    isCreating.value = false;
    setTimeout(() => {
      successMessage.value = '';
      errorMessage.value = '';
      router.push('/read');
    }, 3000);
  }
}
</script>

<style scoped></style>

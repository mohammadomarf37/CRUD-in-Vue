<template>
  <div class="max-w-md mx-auto my-20 bg-white shadow-lg rounded-lg overflow-hidden text-(--font-color)">
    <div class="text-2xl py-4 px-6 bg-(--secondary-color)  text-center font-bold uppercase">
      Create User
    </div>
    <form class="py-5 px-6">
      <div class="mb-4">
        <label class="block text-(--font-color) font-bold mb-2" for="name"> Name </label>
        <input
          class="input-field"
          id="name"
          type="text"
          placeholder="Enter your name"
        />
      </div>
      <div class="mb-4">
        <label class="block text-(--font-color) font-bold mb-2" for="email"> Email </label>
        <input
          class="input-field"
          id="email"
          type="email"
          placeholder="Enter your email"
        />
      </div>
      <div class="mb-4 relative">
        <label class="block text-(--font-color) font-bold mb-2" for="password"> Password </label>
        <input
          class="input-field"
          id="password"
          :type="isPasswordVisible ? 'text' : 'password'"
          placeholder="Enter your password"
        />
        <button 
            type="button"
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
          type="submit"
        >
          Book Appointment
        </button>
      </div>
    </form>
  </div>
</template>

<script setup lang="ts">
import { ref } from 'vue';

const isPasswordVisible = ref(false);
function togglePassword(){
    isPasswordVisible.value = !isPasswordVisible.value;
}
</script>

<style scoped></style>

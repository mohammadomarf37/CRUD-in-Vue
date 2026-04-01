<template>
    <!-- Table -->
  <div class="max-w-4xl mx-auto mt-20">
    <div
      class="overflow-x-auto [&::-webkit-scrollbar]:h-2 [&::-webkit-scrollbar-thumb]:rounded-none [&::-webkit-scrollbar-track]:bg-scrollbar-track [&::-webkit-scrollbar-thumb]:bg-scrollbar-thumb"
    >
      <table class="min-w-full divide-y divide-table-line">
        <thead class="bg-(--secondary-color) text-(--font-color) transition-colors duration-300">
          <tr class="italic">
            <th
              scope="col"
              class="px-3 py-3 text-center text-xs font-bold text-muted-foreground-1 uppercase border-r"
            >
              #
            </th>
            <th
              scope="col"
              class="px-6 py-3 text-center text-xs font-semibold text-muted-foreground-1 uppercase"
            >
              Name
            </th>
            <th
              scope="col"
              class="px-6 py-3 text-center text-xs font-semibold text-muted-foreground-1 uppercase"
            >
              Email
            </th>
            <th
              scope="col"
              class="px-6 py-3 text-center text-xs font-semibold text-muted-foreground-1 uppercase"
            >
              Password
            </th>
            <th
              scope="col"
              class="px-6 py-3 text-center text-xs font-semibold text-muted-foreground-1 uppercase"
            >
              Created_at
            </th>
            <th
              scope="col"
              class="px-6 py-3 text-center text-xs font-semibold text-muted-foreground-1 uppercase"
            >
              Actions
            </th>
          </tr>
        </thead>

        <tbody class="divide-y divide-table-line text-(--font-color)">
          <tr v-if="usersData.length === 0 && !loader">
            <td colspan="5" class="text-center py-5">No Data Found!</td>
          </tr>
          <tr v-if="loader">
            <td colspan="5" class="text-center py-5">Loading Users..</td>
          </tr>
          <tr v-for="(user, index) in usersData" :key="index" class="hover:bg-(--secondary-color) transition-colors duration-300">
            <td
              class="px-3 py-4 whitespace-nowrap text-sm font-semibold italic text-foreground text-center border-r bg-(--secondary-color)"
            >
              {{ user.id }}
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-foreground">
              {{ user.name }}
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-foreground">
              {{ user.email }}
            </td>
            <td
              class="px-6 py-4 whitespace-nowrap text-sm"
            >
              {{ user.password }}
            </td>
            <td
              class="px-6 py-4 whitespace-nowrap text-sm"
            >
              {{ user.created_at.slice(0, 10) }}
            </td>
            <td
              class="px-6 py-4 whitespace-nowrap text-sm flex items-center justify-center gap-5"
            >
                <i class="bi bi-pen-fill text-gray-400 cursor-pointer hover:text-gray-600 transition-colors duration-300"></i>
                <i class="bi bi-trash cursor-pointer text-red-400 hover:text-red-600 transition-colors duration-300"></i>
            </td>
          </tr>
        </tbody>

      </table>
    </div>
  </div>
  <!-- End Table -->
</template>

<script setup lang="ts">
import { onMounted, ref } from 'vue';
import axios from 'axios';

const usersData =ref<any[]>([]);
const loader = ref(false);

// Get Users
async function getUsers() {
    try{
        loader.value = true;
        const response = await axios.get('http://localhost:8000/api/get/users');
        usersData.value = response.data;
    }catch(error){
        console.error("Error: ", error);
    }finally{
        loader.value = false;
    }
}

onMounted(() => {
    getUsers();
});
</script>
<style scoped>

</style>
<template>
    <!-- Table -->
  <div class="max-w-4xl max-h-[35.54rem] overflow-auto mx-auto my-17">
    <div
      class="[&::-webkit-scrollbar]:h-2 [&::-webkit-scrollbar-thumb]:rounded-none [&::-webkit-scrollbar-track]:bg-scrollbar-track [&::-webkit-scrollbar-thumb]:bg-scrollbar-thumb"
    >
      <table class="min-w-full divide-y divide-table-line border-separate border-spacing-0">
        <thead class="sticky top-0 z-10 border-b bg-(--secondary-color) text-(--font-color) transition-colors duration-300">
          <tr class="italic">
            <th
              scope="col"
              class="px-3 py-3 text-center border-r border-b border-(--font-color) text-xs font-bold text-muted-foreground-1 uppercase"
            >
              #
            </th>
            <th
              scope="col"
              class="px-6 py-3 text-center border-b border-(--font-color) text-xs font-semibold text-muted-foreground-1 uppercase"
            >
              Name
            </th>
            <th
              scope="col"
              class="px-6 py-3 text-center border-b border-(--font-color) text-xs font-semibold text-muted-foreground-1 uppercase"
            >
              Email
            </th>
            <th
              scope="col"
              class="px-6 py-3 text-center border-b border-(--font-color) text-xs font-semibold text-muted-foreground-1 uppercase"
            >
              Password
            </th>
            <th
              scope="col"
              class="px-6 py-3 text-center border-b border-(--font-color) text-xs font-semibold text-muted-foreground-1 uppercase"
            >
              Created_at
            </th>
            <th
              scope="col"
              class="px-6 py-3 text-center border-b border-(--font-color) text-xs font-semibold text-muted-foreground-1 uppercase"
            >
              Actions
            </th>
          </tr>
        </thead>

        <tbody class="divide-y divide-table-line text-(--font-color)">
          <tr v-if="usersData.length === 0 && !loader">
            <td colspan="6" class="text-center py-5">No Data Found!</td>
          </tr>
          <tr v-if="loader">
            <td colspan="6" class="text-center py-5">Loading Users..</td>
          </tr>
          <tr v-for="(user, index) in usersData" :key="index" class="hover:bg-(--secondary-color) transition-colors duration-300">
            <td
              class="px-3 py-4 whitespace-nowrap text-sm border-b border-(--font-color) font-semibold italic text-foreground text-center border-r bg-(--secondary-color)"
            >
              {{ user.id }}
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm border-b border-(--font-color) text-foreground">
              {{ user.name }}
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm border-b border-(--font-color) text-foreground">
              {{ user.email }}
            </td>
            <td
              class="px-6 py-4 whitespace-nowrap text-sm border-b border-(--font-color)"
            >
              {{ user.password }}
            </td>
            <td
              class="px-6 py-4 whitespace-nowrap text-sm border-b border-(--font-color)"
            >
              {{ user.created_at.slice(0, 10) }}
            </td>
            <td
              class="px-6 py-4 whitespace-nowrap text-sm border-b border-(--font-color) flex items-center justify-center gap-5"
            >
                <i @click="goToEdit(user.id)" class="bi bi-pen-fill text-gray-400 cursor-pointer hover:text-gray-600 transition-colors duration-300"></i>
                <i 
                  @click="deleteUser(user.id)" 
                  :class="[
                    isDeleting === user.id ? 'bi-hourglass-split animate-spin text-gray-400 pointer-events-none' : 'bi bi-trash-fill text-red-400 hover:text-red-600 cursor-pointer',
                  ]" 
                  class="bi transition-colors duration-300"
                ></i>
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
import router from '@/router';

const usersData =ref<any[]>([]);
const loader = ref(false);
const isDeleting = ref< number | null>(null);

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

// Edit User
async function goToEdit(id: number) {
  router.push(`/${id}/edit`);
}

// Delete User
async function deleteUser(id: number) {
  const confirm = window.confirm('Are you sure you want to delete this user?');

  if(confirm){
    try{
      isDeleting.value  = id;

      await axios.delete(`http://localhost:8000/api/delete/${id}/user`);
      usersData.value = usersData.value.filter(user => user.id !== id);
    }
    catch(error){
      console.error("Error: ", error || error.response?.data?.error);
    }
    finally{
      isDeleting.value = null;
    }
  }
  else{
    return;
  }
  
}

onMounted(() => {
    getUsers();
});
</script>
<style scoped>

</style>
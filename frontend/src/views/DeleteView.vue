<template>
    <section>
        <h1>Delete!</h1>
    </section>
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
        const response = await axios.get("");
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
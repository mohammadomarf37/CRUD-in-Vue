<template>
  <header class="text-(--font-color) bg-(--primary-color) body-font">
    <div
      class="container mx-auto flex flex-wrap p-5 flex-col md:flex-row items-center"
    >
      <a
        class="flex title-font font-medium items-center text-indigo-700 mb-4 md:mb-0"
      >
        <span class="ml-3 text-xl font-bold text-(--font-color)">Application</span>
      </a>
      <nav
        class="md:ml-auto md:mr-auto flex flex-wrap items-center text-base justify-center relative"
      >
        <RouterLink class="nav-link" to="/">Create</RouterLink>
        <RouterLink class="nav-link" to="/read">Read</RouterLink>
        <RouterLink class="nav-link" to="/update">Update</RouterLink>
        <RouterLink class="nav-link" to="/delete">Delete</RouterLink>
      </nav>
    </div>
  </header>
</template>

<script setup lang="ts">

</script>

<style lang="scss" scoped>
  .router-link-active{
    color: var(--hover-color);
    font-weight: 600;
  }
</style>

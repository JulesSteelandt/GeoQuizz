<script setup>
import { RouterLink, RouterView } from 'vue-router'
</script>

<template>
  <header>

    <div class="wrapper">
      <nav>
        <RouterLink to="/">Home</RouterLink>
        <RouterLink to="/about">About</RouterLink>
        <RouterLink to="/map">MapTest</RouterLink>
        <RouterLink to="/guess">Guess</RouterLink>
        <RouterLink to="/inscription">Inscription</RouterLink>
        <RouterLink to="/map">Map</RouterLink>
      </nav>
    </div>
  </header>

  <RouterView />
</template>

<style scoped>

</style>

<script setup>
import {RouterLink, RouterView} from 'vue-router'
</script>

<template>
  <header>
    <nav class="flex flex-col border-2">
      <RouterLink to="/">Home</RouterLink>
      <RouterLink to="/map">Map</RouterLink>
      <RouterLink to="/inscription">Inscription</RouterLink>
      <RouterLink to="/connexion">Connexion</RouterLink>
    </nav>
  </header>

  <RouterView/>
</template>

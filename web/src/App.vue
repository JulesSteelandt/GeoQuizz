<script setup>
import {RouterLink, RouterView} from 'vue-router'
</script>

<template>
  <header class="border-r-2 w-2/12 bg-geoBlue bg-opacity-10">
    <nav class="flex flex-col items-center">
      <div class="w-full hover:bg-geoGreen hover:bg-opacity-20 p-2">
        <RouterLink to="/">Home</RouterLink>
        <RouterLink to="/about">About</RouterLink>
        <RouterLink to="/map">MapTest</RouterLink>
        <RouterLink to="/guess">Guess</RouterLink>
      </div>
      <div class="w-full hover:bg-geoGreen hover:bg-opacity-20 p-2">
        <RouterLink to="/map">Map</RouterLink>
      </div>
      <div class="w-full hover:bg-geoGreen hover:bg-opacity-20 p-2">
        <RouterLink to="/inscription">Inscription</RouterLink>
      </div>
      <div class="w-full hover:bg-geoGreen hover:bg-opacity-20 p-2">
        <RouterLink to="/connexion">Connexion</RouterLink>
      </div>
    </nav>
  </header>

  <RouterView/>
</template>

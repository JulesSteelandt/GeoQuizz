<script>
export default {
  data() {
    return {}
  }
}
</script>

<template>
  <div class="h-screen flex flex-row justify-around">
    <router-link to="/selectgame" tag="button">
      <button class="border-8 border-gray-600 hover:border-gray-500 p-20 mt-20 text-gray-600 hover:text-gray-500 font-bold text-xl">Commencer une nouvelle partie</button>
    </router-link>
    <router-link to="/restartgame" tag="button">
      <button class="border-8 border-gray-600 hover:border-gray-500 p-20 mt-20 text-gray-600 hover:text-gray-500 font-bold text-xl">Redémarrer une partie</button>
    </router-link>
  </div>
</template>
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
      <button class="bg-red-700 p-20 mt-20 text-white">Commencer une nouvelle partie</button>
    </router-link>
    <router-link to="/restartgame" tag="button">
      <button class="bg-red-700 p-20 mt-20 ">Redémarrer une ancienne partie</button>
    </router-link>
  </div>
</template>
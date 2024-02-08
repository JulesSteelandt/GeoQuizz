<script>
export default {
  data() {
    return {}
  }
}
</script>

<template>
  <div class="h-screen flex flex-row justify-around">
    <div class="bg-white w-2/5 m-4">
      <RouterLink tag="div" to="/selectgame">Commencer une nouvelle partie</RouterLink>
    </div>
    <div class="bg-white w-2/5 m-4">
      <RouterLink tag="div" to="/restartgame">Redémarrer une ancienne partie</RouterLink>
    </div>
  </div>
</template>
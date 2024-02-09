<script >

export default {
  data() {
    return {
      score: 0

    }
  },


}

</script>

<template>
<section class="py-8">

  <div class="border border-gray-400 rounded-lg mx-28 bg-gray-50 justify-center">
    <label>
      Votre score est de
      <label>{{ score }} </label>
    </label>
  </div>
  <div>
    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" @click="this.$router.push('/selectgame')">Rejouer</button>
  </div>
</section>


</template>

<style scoped>

</style>
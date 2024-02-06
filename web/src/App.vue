<script>
import { computed } from 'vue';
import { useRoute, RouterView, RouterLink } from 'vue-router';
import PlayGeoQuizz from "@/components/playGeoQuizz.vue";

export default {
  components: {PlayGeoQuizz},
  data() {
    return {
      isHomeRoute: true,
    };
  },


  /**
   * Vérifie si la route actuelle est la page d'accueil
   * @returns {{isHomeRoute: ComputedRef<boolean>}} - true si la route actuelle est la page d'accueil, false sinon
   */
  setup() {
    const route = useRoute();
    const isHomeRoute = computed(() => route.path === '/');

    return { isHomeRoute };
  },

};
</script>

<template>
  <header>
    <div class="header flex flex-row flex-wrap justify-between p-1">
      <div class="headerLogoText flex flex-row flex-wrap">
        <!-- Logo à gauche -->
        <img class="w-28" src="@/components/icons/globe.png" alt="logo">

        <!-- Textes à gauche -->
        <div class="flex-col ml-4 w-20">
          <div>
            <h1 class="text-7xl font-extrabold text-blue-500">
              Geo
            </h1>
          </div>
          <div>
            <h1 class="text-5xl font-extrabold text-gray-400">
              Quizz
            </h1>
          </div>
        </div>
      </div>
      <div class="flex flex-row items-center" >
        <div class="bg-blue-500 text-white text-2xl font-bold py-2 px-4 rounded-xl hover:bg-stone-400 hover:text-gray-700 mr-3">
          <RouterLink to="/">
            <button class="h-full w-full">Home</button>
          </RouterLink>
        </div>
        <div class="bg-blue-500 text-white text-2xl font-bold py-2 px-4 rounded-xl hover:bg-stone-400 hover:text-gray-700 mr-3">
          <RouterLink to="/selectgame">
            <button class="h-full w-full">Jouer</button>
          </RouterLink>
        </div>
        <div class="bg-blue-500 text-white text-2xl font-bold py-2 px-4 rounded-xl hover:bg-stone-400 hover:text-gray-700 mr-3">
          <RouterLink to="/inscription">
            <button class="h-full w-full">Inscription</button>
          </RouterLink>
        </div>
        <div class="bg-blue-500 text-white text-2xl font-bold py-2 px-4 rounded-xl hover:bg-stone-400 hover:text-gray-700 mr-3">
          <RouterLink to="/connexion">
            <button class="h-full w-full">Connexion</button>
          </RouterLink>
        </div>
      </div>
    </div>

    <div class="wrapper">

    </div>
    <playGeoQuizz v-if="isHomeRoute"/>
    <div class ="flex justify-center" v-if="isHomeRoute">
      <!-- Bouton à droite -->
      <RouterLink to="/guess">
        <button class="bg-blue-500 hover:bg-blue-900 text-white text-2xl font-bold py-2 px-4 rounded-xl mb-14 ">
          Lancer le Quiz !
        </button>
      </RouterLink>

    </div>

  </header>

  <RouterView />

  <footer class="bg-stone-400 text-zinc-500 text-center p-4 flex flex-row justify-between" >
    <p>GeoQuizz - 2024</p>
    <p>Copyrigtht IUT-Charlemagne</p>
  </footer>
</template>

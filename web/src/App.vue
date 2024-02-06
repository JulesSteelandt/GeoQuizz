<script>
import {computed} from 'vue';
import {useRoute, RouterView, RouterLink} from 'vue-router';
import PlayGeoQuizz from "@/components/playGeoQuizz.vue";
import HeaderContent from "@/components/HeaderContent.vue";

export default {
  components: {HeaderContent, PlayGeoQuizz},
  data() {
    return {
      isHomeRoute: true,
    };
  },

  /**
   * Vérifie si la route actuelle est la page d'accueil
   * @returns boolean - true si la route actuelle est la page d'accueil, false sinon
   */
  setup() {
    const route = useRoute();
    const isHomeRoute = computed(() => route.path === '/');

    return {isHomeRoute};
  },

};
</script>

<template>
  <div v-if="isHomeRoute" class="flex flex-col">
    <header class="bg-gray-700 w-screen w-1/5 flex flex-row items-center">
      <!--
      <div class="flex flex-row flex-wrap">
        <img class="w-28" src="@/components/icons/globe.png" alt="logo">

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
      -->

      <header-content/>
    </header>

    <div class="flex flex-col justify-center w-full">
      <playGeoQuizz/>
      <div class="flex justify-center">
        <!-- Bouton à droite -->
        <RouterLink to="/map">
          <button class="bg-blue-500 hover:bg-blue-900 text-white text-2xl font-bold py-2 px-4 rounded-xl mb-14 ">
            Lancer le Quiz !
          </button>
        </RouterLink>

      </div>

      <RouterView/>

      <footer class="bg-stone-400 text-zinc-500 text-center p-4 flex flex-row justify-between w-full">
        <p>GeoQuizz - 2024</p>
        <p>Copyright IUT-Charlemagne</p>
      </footer>
    </div>
  </div>

  <div v-else class="flex flex-row">
    <header class="bg-gray-700 h-screen w-1/5 flex flex-col items-center">
      <header-content/>
    </header>

    <div class="flex flex-col justify-center w-full">
      <playGeoQuizz v-if="isHomeRoute"/>
      <div class="flex justify-center" v-if="isHomeRoute">
        <!-- Bouton à droite -->
        <RouterLink to="/map">
          <button class="bg-blue-500 hover:bg-blue-900 text-white text-2xl font-bold py-2 px-4 rounded-xl mb-14 ">
            Lancer le Quiz !
          </button>
        </RouterLink>

      </div>

      <RouterView/>

      <footer class="bg-stone-400 text-zinc-500 text-center p-4 flex flex-row justify-between w-full">
        <p>GeoQuizz - 2024</p>
        <p>Copyright IUT-Charlemagne</p>
      </footer>
    </div>
  </div>
</template>

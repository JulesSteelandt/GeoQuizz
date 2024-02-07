<script>
import {computed} from 'vue';
import {useRoute, RouterView, RouterLink} from 'vue-router';
import PlayGeoQuizz from "@/components/playGeoQuizz.vue";
import Cookies from "js-cookie";

export default {
  components: {PlayGeoQuizz},
  data() {
    return {
      isHomeRoute: true,
      isConnected: false,
    };
  },

  methods: {
    /**
     * Permet de vérifier si l'utilisateur est connecté
     * @returns {void} - return true si l'utilisateur est connecté, false sinon
     */
    async checkAuthStatus() {
      const token = Cookies.get('accessToken');

        if (token === undefined) {
          // Si le token est expiré, déconnecter l'utilisateur et supprimer le cookie
          this.isConnected = false;
          Cookies.remove('accessToken');
          return;
        }
        this.isConnected = true;
      }
  },



  /**
   * Vérifie si la route actuelle est la page d'accueil ou non
   * @returns {{isHomeRoute: ComputedRef<boolean>}} - true si la route actuelle est la page d'accueil, false sinon
   */
  setup() {
    const route = useRoute();
    const isHomeRoute = computed(() => route.path === '/');

    return {isHomeRoute};
  },
  mounted() {
    this.checkAuthStatus();
  },

};
</script>

<template>
  <header class="bg-neutral-800">
    <div class="header flex flex-wrap p-1 m-2 lg:flex-row lg:justify-between max-lg:flex-col max-lg:items-center">
      <div class="headerLogoText flex flex-row flex-wrap max-lg:mb-8 max-lg:mr-20">
        <!-- Logo à gauche -->

        <router-link to="/" class="logo">
        <img class="w-28" src="@/components/icons/globe.png" alt="logo">
        </router-link>

        <!-- Textes à gauche -->
        <div class="flex-col ml-4 w-20">
          <div>
            <h1 class="text-7xl font-extrabold drop-shadow-[0_8px_4px_rgba(34,0,4,6)] text-blue-500">
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
      <div class="flex flex-row items-center">
        <div
            class="text-white text-2xl font-bold py-2 px-4 rounded-xl bg-gradient-to-r from-blue-400 via-blue-500 to-blue-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 shadow-lg shadow-blue-500/50 dark:shadow-lg dark:shadow-blue-800/80 mr-3 hover:transition duration-300 ease-in-out transform hover:scale-105">
          <RouterLink to="/">
            <button class="h-full w-full max-sm:text-base">Home</button>
          </RouterLink>
        </div>
        <div class="text-white text-2xl font-bold py-2 px-4 rounded-xl bg-gradient-to-r from-blue-400 via-blue-500 to-blue-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 shadow-lg shadow-blue-500/50 dark:shadow-lg dark:shadow-blue-800/80 mr-3 hover:transition duration-300 ease-in-out transform hover:scale-105">
            <RouterLink to="/selectgame">
              <button class="h-full w-full max-sm:text-base max-sm:h-full">Jouer</button>

            </RouterLink>
        </div>

        <div class="notConnected flex flex-row items-center">

          <div v-if="isConnected === false"
              class="bg-blue-500 text-white text-2xl font-bold py-2 px-4 rounded-xl bg-gradient-to-r from-blue-400 via-blue-500 to-blue-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 shadow-lg shadow-blue-500/50 dark:shadow-lg dark:shadow-blue-800/80 mr-3 hover:transition duration-300 ease-in-out transform hover:scale-105">
            <RouterLink to="/inscription">
              <button class="h-full w-full max-sm:text-base">Inscription</button>
            </RouterLink>
          </div>
          <div
              v-else class="bg-blue-500 text-white text-2xl font-bold py-2 px-4 rounded-xl bg-gradient-to-r from-blue-400 via-blue-500 to-blue-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 shadow-lg shadow-blue-500/50 dark:shadow-lg dark:shadow-blue-800/80 mr-3 hover:transition duration-300 ease-in-out transform hover:scale-105">
            <RouterLink to="/connexion">
              <button class="h-full w-full max-sm:text-base">Déconnexion</button>
            </RouterLink>
          </div>
          <div
              v-if="isConnected === false" class="bg-blue-500 text-white text-2xl font-bold py-2 px-4 rounded-xl bg-gradient-to-r from-blue-400 via-blue-500 to-blue-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 shadow-lg shadow-blue-500/50 dark:shadow-lg dark:shadow-blue-800/80 mr-3 hover:transition duration-300 ease-in-out transform hover:scale-105">
            <RouterLink to="/connexion">
              <button class="h-full w-full max-sm:text-base">Connexion</button>
            </RouterLink>
          </div>
          <div
              v-else class="bg-blue-500 text-white text-2xl font-bold py-2 px-4 rounded-xl bg-gradient-to-r from-blue-400 via-blue-500 to-blue-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 shadow-lg shadow-blue-500/50 dark:shadow-lg dark:shadow-blue-800/80 mr-3 hover:transition duration-300 ease-in-out transform hover:scale-105">
            <RouterLink to="/connexion">
              <img class="h-8 w-8" src="@/components/icons/user.png" alt="logoUser">
            </RouterLink>
          </div>
        </div>

        <div class="connected flex flex-row items-center">
        </div>
      </div>
    </div>
  </header>

  <playGeoQuizz v-if="isHomeRoute"/>
  <div class="flex justify-center" v-if="isHomeRoute">
    <!-- Bouton à droite -->
    <RouterLink to="/selectgame">
      <button class="bg-blue-500 hover:bg-blue-900 text-white text-2xl font-bold py-2 px-4 rounded-xl mb-14 ">
        Choisir le Quiz !
      </button>
    </RouterLink>

  </div>



  <RouterView/>

  <footer class="bg-stone-400 text-zinc-500 text-center p-4 flex flex-row justify-between">
    <p>GeoQuizz - 2024</p>
    <p>Copyrigtht IUT-Charlemagne</p>
  </footer>
</template>

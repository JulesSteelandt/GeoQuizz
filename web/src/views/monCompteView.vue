<script>
// Importez la bibliothèque js-cookie pour récupérer le token JWT du cookie
import Cookies from 'js-cookie';
import {VALIDATE_USER} from "@/apiLiens.js";

export default {
  data() {
    return {
      user: {
        pseudo: '', // Initialisez le pseudo de l'utilisateur à une chaîne vide
      },
    };
  },
  created() {
    // Appel de la fonction pour récupérer les informations de l'utilisateur lors du chargement du composant
    this.fetchUserData();
  },
  methods: {
    async fetchUserData() {
      const token = Cookies.get('accessToken'); // Récupérez le token du cookie

      if(token === undefined){

      }
      try {
        const response = await fetch(VALIDATE_USER, {
          headers: {
            Authorization: `Bearer ${token}`, // Ajoutez le token comme en-tête d'autorisation
          },
        });

        if (!response.ok) {
          throw new Error('Erreur lors de la récupération des informations de l\'utilisateur');
        }
        // Récupérez le pseudo de l'utilisateur depuis la réponse de l'API
        const userData = await response.json();
        this.user.pseudo = userData.username;
        console.log(this.user.pseudo);
        console.log(userData);
      } catch (error) {
        console.error('Erreur:', error.message);
      }
    },
  },
};
</script>

<template>
  <div>
  <section class="h-full w-full min-h-screen pt-6">
    <div v-if="user.pseudo !== ''" class="w-1/2 rounded-xl flex flex-col overflow-hidden border-2 border-gray-100 mx-auto my-10 bg-stone-400 text-zinc-900">
      <div class="flex flex-row items-center m-2 justify-evenly ml-auto mr-auto">
        <p class="text-4xl font-bold m-1 mr-2">Compte de :</p>
        <p class="text-4xl font-bold">{{ user.pseudo }}</p>
      </div>
    </div>
    <div v-else class="flex justify-center mt-4">
      <p> Vous avez été déconnecté. Veuillez vous reconnecter pour accéder à votre compte.</p>
      <router-link to="/connexion">
        <button class="text-white text-2xl font-bold py-2 px-4 rounded-xl bg-gradient-to-r from-blue-400 via-blue-500 to-blue-600 hover:bg-gradient-to-br shadow-lg shadow-blue-500/50 dark:shadow-lg dark:shadow-blue-800/80 mr-3 hover:transition duration-300 ease-in-out transform hover:scale-105">
        >Se connecter</button>
      </router-link>
    </div>
  </section>
  </div>
</template>
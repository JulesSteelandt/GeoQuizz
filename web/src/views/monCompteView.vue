<script>
import Cookies from 'js-cookie';
import { VALIDATE_USER } from "@/apiLiens.js";

export default {
  data() {
    return {
      user: {
        pseudo: '',
      },
    };
  },

  /**
   * Méthode appelée lors de la création du composant
   */
  created() {
    // Appel de la fonction pour récupérer les informations de l'utilisateur lors du chargement du composant
    this.fetchUserData();
  },
  methods: {
    fetchUserData() {
      const token = Cookies.get('accessToken'); // Récupérez le token du cookie

      fetch(VALIDATE_USER, {
        headers: {
          Authorization: `Bearer ${token}`, // Ajoutez le token comme en-tête d'autorisation
        },
      })
          .then(response => {
            console.log('Réponse de l\'API:', response);
            if (!response.ok) {
              throw new Error('Erreur lors de la récupération des informations de l\'utilisateur, la requète n\'a pas aboutie');
            }
            console.log(response.json());
            return response.json();

          })
          .then(userData => {
            // Récupérez le pseudo de l'utilisateur depuis la réponse de l'API
            this.user.pseudo = userData.username;
            console.log('Pseudo de l\'utilisateur:', this.user.pseudo);
            // Récupérez les scores de l'utilisateur depuis la réponse de l'API
          })
          .catch(error => {
            console.error('Erreur lors de la récupération des informations de l\'utilisateur lié au token du cookie:', error);
          })
    },
  },
};
</script>

<template>
  <section class="h-full w-full min-h-screen pt-6">
    <div class=" w-1/2 rounded-xl flex flex-col overflow-hidden border-2 border-gray-100 mx-auto my-10 bg-stone-400 text-zinc-900">


      <div class="flex flex-row m-2">
        <h2 class="text-4xl font-bold "> Compte de  </h2>
        <p class="text-4xl font-bold">{{ user.pseudo }}</p>
    </div>
    </div>
  </section>

</template>
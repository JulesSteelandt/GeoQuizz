<script>
export default {
  data() {
    return {
      isConnecte: true,
    };
  },
  methods:{
    async login() {
      // Récupérer les valeurs des champs d'entrée
      const email = this.$refs.emailInput.value;
      const password = this.$refs.passwordInput.value;

      //const credentials = btoa(`${email}:${password}`);

      // Envoyer les données d'identification au serveur pour authentification
      try {
        const response = await fetch('http://docketu.iutnc.univ-lorraine.fr:35200/signin', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'Authorization': 'Basic ' + btoa(email + ':' + password)

          },
        });

        // Vérifier la réponse du serveur
        if (response.message === 401) {
          const data = await response.json();
          console.log('Réponse du serveur:', data);
          // Authentification réussie
          console.log('Connexion réussie');
          this.isConnect = true;
        } else {
          // Authentification échouée
          console.error('Échec de la connexion');
          console.log("Authentification a échoué, le nom utilisateur ou le mot de passe sont erronés");
          this.isConnect = false;
        }
      } catch (error) {
        console.error('Erreur lors de la connexion:', error);
      }
    }
  }
}
</script>


<template>
  <div class="bg-gray-700 flex flex-col justify-center p-8 rounded-2xl m-auto">
    <div>
      <p class="text-white">Votre e-mail :</p>
      <input ref="emailInput" class="w-60 mb-2.5 p-1" type="text" placeholder="Votre e-mail ...">
    </div>
    <div>
      <p class="text-white">Mot de passe :</p>
      <input ref="passwordInput" class="w-60 mb-2.5 p-1 rounded-lg" type="password" placeholder="Votre mot de passe ...">
    </div>
      <button @click="login" class="text-white text-2xl font-bold py-2 px-4 rounded-xl bg-gradient-to-r from-blue-400 via-blue-500 to-blue-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 shadow-lg shadow-blue-500/50 dark:shadow-lg dark:shadow-blue-800/80">
         Je me connecte
      </button>
    </div>
  <div class="flex flex-col justify-center p-8 rounded-2xl m-auto">
    <p v-if="!isConnected" class="text-red-500">La connexion a échoué, le nom d'utilisateur ou le mot de passe ne sont pas corrects.</p>
  </div>
</template>
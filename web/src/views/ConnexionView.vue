<script>
export default {
  data() {
    return {
      isConnected: false,
      showError: false,
      showPassword: false,
      email: '',
      password: '',
      isMail: true,
      isFill: true,
      emailTouched: false
    };
  },
  methods: {
    /**
     * Permet de basculer entre l'affichage du mot de passe en clair et masqué
     * @returns {void} - return true si le passeport est valide, false sinon
     */
    togglePasswordVisibility() {
      this.showPassword = !this.showPassword;
      const passwordInput = this.$refs.passwordInput;
      passwordInput.type = this.showPassword ? 'text' : 'password';
    },
    /**
     * Permet de se connecter à l'application fetch l'api d'autehntification
     * @returns {void} - return true si connecté et false sinon
     */
    async login() {
      const email = this.email;
      const password = this.password;

      if (email.trim() === '' || password.trim() === '') {
        console.error('Veuillez entrer votre email et votre mot de passe');
        this.isFill = false;
        return;
      }

      try {
        const response = await fetch('http://docketu.iutnc.univ-lorraine.fr:35200/signin', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'Authorization': 'Basic ' + btoa(`${email}:${password}`),
          },
        });

        if (response.status !== 200) {
          this.showError = true;
        }else {
          const responseData = await response.json();

          if (responseData && responseData.message === "401 Authentification failed") {
            console.error('Échec de la connexion');
            this.isConnected = false;
            this.showError = true;
          } else {
            this.isConnected = true;
            this.showError = false;
            this.resetFields();
          }

        }
      }catch (error) {
        console.error('Erreur lors de la connexion:', error);
      }
    },
    /**
     * Permet de réinitialiser les champs email et password
     * @returns {void}
     */
    resetFields() {
      this.email = '';
      this.password = '';
    },
    /**
     * Permet de vérifier si l'email est valide
     * @param {string} email - email à vérifier
     * @returns {boolean} - return true si l'email est valide, false sinon
     */
    verifEmail(email) {
      if (this.emailTouched && email.trim() !== '') {
        const emailRegex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
        return emailRegex.test(email);
      }
      return true;
    },
  },
}
</script>

<template>
  <div class="bg-gray-700 flex flex-col justify-center p-8 rounded-2xl m-auto mb-8 mt-8">
    <div>
      <p class="text-white mb-1">Votre e-mail :</p>
      <input v-model="email" class="w-60 mb-2.5 p-1 rounded-lg" type="text" placeholder="Votre e-mail ..."
             @input="emailTouched = true">
    </div>
    <div>
      <p class="text-white mb-1">Mot de passe :</p>
      <input ref="passwordInput" v-model="password" class="w-60 mb-2.5 p-1 rounded-lg" type="password"
             placeholder="Votre mot de passe ..." @keyup.enter="login">
      <button @click="togglePasswordVisibility" class="flex items-start ml-52 focus:outline-none">
        <img v-if="!showPassword" src="@/components/icons/invisible.png" alt="Masquer mot de passe"
             class="h-5 w-5 bg-transparent">
        <img v-else src="@/components/icons/visible.png" alt="Afficher mot de passe" class="h-5 w-5 bg-transparent">
      </button>
      <p v-if="!verifEmail(email)" class="text-green-700 font-bold mb-2">L'email est invalide</p>
    </div>
    <button :disabled="!verifEmail(email) || password === ''" @click="login" class="text-white text-2xl font-bold mt-4 py-2 px-4 rounded-xl bg-gradient-to-r from-blue-400 via-blue-500 to-blue-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 shadow-lg shadow-blue-500/50 dark:shadow-lg dark:shadow-blue-800/80 disabled:opacity-50 disabled:bg-gray-400 disabled:hover:bg-gray-400 disabled:cursor-not-allowed">      Je me connecte
    </button>
    <RouterLink to="/inscription">
      <button class="bg-stone-400 text-zinc-600 hover:bg-blue-500 hover:text-zinc-900  py-2 px-4 rounded-xl mt-10 ml-14">
        Je n'ai pas de compte
      </button>
    </RouterLink>
  </div>
  <div v-if="showError" class="flex flex-col items-center p-2 rounded-2xl mb-2">
    <p class="text-red-700 text-xl font-bold ">La connexion a échoué, le nom d'utilisateur</p>
    <p class="text-red-700 text-xl font-bold ">ou le mot de passe sont erronés</p>
  </div>
  <div v-else-if="isConnected" class="flex flex-col items-center p-8 rounded-2xl m-auto">
    <p class="text-green-600 text-xl font-bold ">Connexion réussie</p>
  </div>
  <div v-else-if="!isConnected && !isFill" class="flex flex-col items-center p-8 rounded-2xl m-auto">
    <p class="text-gray-400 text-xl font-bold ">Veuillez rentrer un email et un mot de passe</p>
  </div>
</template>

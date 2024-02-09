<script>
import Cookies from 'js-cookie';
import { SIGNIN } from "@/apiLiens.js";
import togglePassword from '@/components/togglePasseword.vue';
import App from "@/App.vue";


export default {
  components: {
    togglePassword,
    App
  },

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
        const response = await fetch(SIGNIN, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'Authorization': 'Basic ' + btoa(`${email}:${password}`),
          },
        });
        const responseData = await response.json();
        if (response.status !== 200) {
          this.showError = true;
        } else {

          if (responseData && responseData.message === "401 Authentification failed") {
            console.error('Échec de la connexion');
            this.isConnected = false;
            state.isConnected = false;
            console.log("connexion false 1")
            this.showError = true;
          } else {
            // Récupérer l'expiration du cookie de la réponse si elle est disponible
            const expiresIn = (((responseData.expiration)/3600)/24);//expire au bout de 12h
            //const expiresIn = (((60)/3600)/24); //expire au bout de 2 min

            const accessToken = responseData.access_token;
            if (!accessToken) {
              console.error('Erreur lors de la récupération de l\'access token');
              this.showError = true;
              return;
            }
            Cookies.set('accessToken', accessToken, { expires: expiresIn });

            this.isConnected = true;
            state.isConnected = false;
            this.showError = false;
            this.resetFields();
            console.log("connexion true");
            console.log(state.isConnected);
            console.log(this.isConnected);
          }

        }
      } catch (error) {
        console.error('Erreur lors de la connexion:', error);
      }
    },
    /**
     * Méthode qui permet de réinitialiser les champs email et mot de passe
     * return {void}
     */
    resetFields() {
      this.email = '';
      this.password = '';
    },

    /**
     * Permet de basculer entre l'affichage du mot de passe en clair et masqué
     * @returns {void} - return true si le passeport est valide, false sinon
     */
    togglePassword() {
      this.showPassword = !this.showPassword;
    },

    /**
     * Méthode qui vérifie le format de l'email saisi par l'utilisateur
     * @param email email saisi par l'utilisateur
     * @return {boolean} vrai si email correspond au format tout en étant non null, faux sinon
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
  <div class="bg-gray-700 flex flex-col justify-center p-8 drop-shadow-[0_8px_4px_rgba(34,0,4,6)] rounded-xl m-auto mb-8 mt-8">
    <div v-if="isConnected" class="flex flex-col items-center rounded-2xl mb-3">
      <p class="text-green-400 text-xl font-bold ">Connexion réussie</p>
    </div>
    <div>
      <p class="text-white mb-1">Votre e-mail :</p>
      <input v-model="email" class="w-60 mb-2.5 p-1 rounded-lg border-4" type="text" placeholder="Votre e-mail ..."
             @input="emailTouched = true">
    </div>
    <div>
      <p class="text-white mb-1">Mot de passe :</p>
      <div>
        <input v-if="!showPassword" ref="passwordInput" v-model="password" class="w-60 mb-2.5 p-1 rounded-lg border-4" type="password" placeholder="Votre mot de passe ..." @keyup.enter="login">
        <input v-else ref="passwordInput" v-model="password" class="w-60 mb-2.5 p-1 rounded-lg border-4" type="text" placeholder="Votre mot de passe ..." @keyup.enter="login">
        <div>
          <togglePassword :showPassword="showPassword" @toggle="togglePassword" />
        </div>
      </div>
      <p v-if="!verifEmail(email)" class="text-green-700 font-bold mb-2">L'email est invalide</p>
    </div>
    <button :disabled="!verifEmail(email) || password === ''" @click="login" class="text-white text-2xl font-bold mt-4 py-2 px-4 rounded-xl bg-gradient-to-r from-blue-400 via-blue-500 to-blue-600 hover:bg-gradient-to-br shadow-lg shadow-blue-500/50 dark:shadow-lg dark:shadow-blue-800/80 disabled:opacity-50 disabled:bg-gray-400 disabled:hover:bg-gray-400 disabled:cursor-not-allowed">      Je me connecte
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

  <div v-else-if="!isConnected && !isFill" class="flex flex-col items-center p-8 rounded-2xl m-auto">
    <p class="text-gray-400 text-xl font-bold ">Veuillez rentrer un email et un mot de passe</p>
  </div>
</template>

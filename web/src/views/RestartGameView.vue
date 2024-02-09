<script>
export default {
  data() {
    return {
      initialisation: this.init(),
      games: [],
      gameDifficulty: [
        {
          id: 1,
          libelle: "Facile"
        },
        {
          id: 2,
          libelle: "Médium"
        },
        {
          id: 3,
          libelle: "Difficile"
        }
      ]
    }
  },
  methods: {
    fetchOldGames() {
      fetch('http://docketu.iutnc.univ-lorraine.fr:35200/games')
          .then(response => response.json())
          .then(data => {
            this.games = data;
            console.log(data);
          })
          .catch(error => {
            throw error;
          })
    },
    init() {
      this.fetchOldGames();
      this.initialisation = true;
    }
  }
}
</script>

<template>
  <div class="mb-16">
    <h2 class="my-8 text-center text-blue-500 text-3xl font-bold">Redémarrer une partie</h2>
    <div v-for="game in games" class="bg-white p-4 m-1 bg-gray-500 flex flex-row justify-between items-center">
      <div>
        <p><strong>Série n°{{ game.serie_id }}</strong>, Difficulté {{ game.difficulte }} par <u>{{ game.user_email }}</u></p>
        <RouterLink :to="/play/ + game.id">
          <button class="mt-4 text-gray-300 hover:text-gray-400 border-2 border-gray-300 hover:border-gray-400 px-2 py-1">Rejouer</button>
        </RouterLink>
      </div>
      <div>
        <p class="text-3xl text-blue-200"><strong>{{ game.score }}</strong></p>
      </div>
    </div>
  </div>
</template>
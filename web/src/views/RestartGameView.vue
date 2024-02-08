<script>
export default {
  data() {
    return {
      initialisation: this.init(),
      games: [],
      sameEmail: true
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
  <div v-for="game in games" class="bg-white p-4">
    <p v-if="sameEmail">Score : {{ game.score }}, Difficulté {{ game.difficulte }}, Série n°{{ game.serie_id }}</p>
    <button>Rejouer</button>
  </div>
</template>
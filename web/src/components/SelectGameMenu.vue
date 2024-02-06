<script >
import {SERIES} from "@/apiLiens.js";

export default {
  name: 'SelectGameMenu',
  data() {
    return {
      serie: [
          //ex : {id: 2, nom: "Nancy", img: "https://via.placeholder.com/350x200" },
          //données d'exemple à remplacer par les données de l'API
        {id: 1, nom: "Nancy", img: "https://via.placeholder.com/350x200"  },
        {id: 2, nom: "Metz", img: "https://via.placeholder.com/350x200"  },
        {id: 3, nom: "Paris", img: "https://via.placeholder.com/350x200" },
        {id: 4, nom: "Lyon", img: "https://via.placeholder.com/350x200" },
        {id: 5, nom: "Marseille", img: "https://via.placeholder.com/350x200" },
      ],
      url : SERIES
    }
  },
  methods: {

  }
}

</script>

<template>
  <section class="h-full w-full min-h-screen  flex flex-wrap justify-center pt-6">
    <!-- Carte "Random" pour avoir un choix aléatoire -->
    <div class="max-w-xs mx-4 mb-4" v-if="serie.length > 0">
      <div class="bg-white shadow-lg rounded-lg overflow-hidden">
        <img class="w-full h-48 object-cover object-center" src="https://via.placeholder.com/350x200" alt="Image de la série">
        <div class="p-4">
          <h3 class="text-gray-900 font-semibold text-lg">Aléatoire</h3>
          <router-link to="/guess">
          <button class="mt-2 bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 focus:outline-none focus:bg-blue-600">Choisir</button>
          </router-link>
        </div>
      </div>
    </div>

    <!-- Cartes pour chaque jeu -->
    <div v-for="(item, index) in serie" :key="item.id" class="max-w-xs mx-4 mb-4" v-if="index % 5 !== 0">
      <div class="bg-white shadow-lg rounded-lg overflow-hidden">
        <img class="w-full h-48 object-cover object-center" :src="item.img" alt="Image de la série">
        <div class="p-4">
          <h3 class="text-gray-900 font-semibold text-lg">{{ item.nom }}</h3>
          <router-link to="/guess">
          <button class="mt-2 bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 focus:outline-none focus:bg-blue-600">Choisir</button>
          </router-link>
        </div>
      </div>
    </div>
  </section>
</template>

<style scoped>

</style>
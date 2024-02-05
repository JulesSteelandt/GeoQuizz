<script>
import  'leaflet/dist/leaflet.css';
import { LMap, LTileLayer, LMarker } from '@vue-leaflet/vue-leaflet';
export default {
  components: {
    LMap,
    LTileLayer,
    LMarker
  },
  data() {
    return {
      image : "",
      timerCount: 60,
      timerEnable: false,
      validate: false,
      osmURL: 'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
      center: [48.69, 6.18],
      //niveau de zoom initial
      zoom: 13,
      //niveau de zoom maximal et minimal
      maxZoom: 18,
      minZoom: 1,

      //coordonnées du marqueur placé par l'utilisateur
      userMarkerCoords: null,
      //coordonnées du Guess final
      userFinalGuess: null,

      //Jeu de données de test en attendant de récupérer les données de l'API
      imageTest: "https://www.francebleu.fr/s3/cruiser-production/2021/09/b2c29454-b2be-4658-abb5-5e7695597631/1200x680_1000x563_photo_une_pool_demange_marchi_gettyimages-124066777.jpg",
    }
  },
  watch: {

    timerEnable(value) {
      if (value) {
        setTimeout(() => {
          this.timerCount--;
        }, 1000);
      }
    },

    timerCount: {
      handler(value) {
        if (value > 0 && this.timerEnable) {
          setTimeout(() => {
              this.timerCount--;
          }, 1000);
        }

      },
      immediate: true // This ensures the watcher is triggered upon creation
    }

  },
    methods: {
      /**
       * Méthode qui démarre le chronomètre
       * @returns {void}
       */
      play() {
        this.timerEnable = true;
      },

      /**
       * Méthode qui stop le chronomètre et permet de valider la position choisie par l'utilisateur
       * @returns {void}
       */
      valider() {
        this.timerEnable = false;
        this.validate = true;
        this.userFinalGuess = this.userMarkerCoords;
      },


        /**
       * Méthode qui place le marqueur sur la carte à l'endroit où l'utilisateur a cliqué
       * @param event
       * @returns {void}
       */
      placeMarker(event) {
        this.userMarkerCoords = [event.latlng.lat, event.latlng.lng];
      }
    }
}

</script>

<template>
  <div class="flex">
    <div>
      <img :src="imageTest" alt="imageTest"  >
    </div>
    <div class="flex flex-col">
      <div class="mapbox">
        <l-map
            ref="map"
            class="map"
            v-model:zoom="zoom"
            v-model:center="center"
            :max-zoom="maxZoom"
            :min-zoom="minZoom"
            :zoom-control="false"
            :use-global-leaflet="false"
            @click="placeMarker($event)"
        >
          <l-tile-layer :url="osmURL"></l-tile-layer>

          <!--marqueur placé par l'utilisateur-->
          <l-marker v-if="userMarkerCoords" :lat-lng="userMarkerCoords"/>


        </l-map>
    </div>
    <div class="flex">
      <label class="m-8" >Temps Restant : {{ this.timerCount }}</label>
     <!-- <button class="m-8" @click="play" >Start</button> -->
      <button class="m-8" @click="valider" v-if="!validate"
      >Valider</button>
    </div>
    </div>

  </div>
</template>

<style scoped>
.mapbox {
  position: relative;
  width: 500px;
  height: 500px;
}
.map {
  position: absolute;
}
</style>
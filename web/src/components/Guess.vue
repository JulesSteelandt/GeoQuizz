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
      tempsAvantValidation : 0,
      valide : false,
      coordinatesApresValidation : "",
      osmURL: 'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
      center: [48.69, 6.18],
      //niveau de zoom initial
      zoom: 13,
      //niveau de zoom maximal et minimal
      maxZoom: 18,
      minZoom: 1,

      //Jeu de données de test en attendant de récupérer les données de l'API
      imageTest: "https://www.francebleu.fr/s3/cruiser-production/2021/09/b2c29454-b2be-4658-abb5-5e7695597631/1200x680_1000x563_photo_une_pool_demange_marchi_gettyimages-124066777.jpg",


      //
    }
  }
}

</script>

<template>
  <div class="flex">
    <div>
      <img :src="imageTest" alt="imageTest" width="700" height="500">
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
        >
          <l-tile-layer :url="osmURL"></l-tile-layer>
        </l-map>
    </div>
    <div class="flex">
      <label> Timer</label>
      <button @click="valider">Valider</button>

    </div>
    </div>

  </div>
</template>

<style scoped>
.mapbox {
  position: relative;
  width: 200px;
  height: 200px;
}
.map {
  position: absolute;
}
</style>
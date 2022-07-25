<template>
  <div class="wrapper">
    <section class="container my-5 p-5 shadow bg_trend">
      <h1 class="p-2">Effettua una nuova ricerca</h1>
      <div class="row row-cols-2">
        <div class="col">
          <label for="">Cerca</label>
          <form method="POST" @submit.prevent="getGeoPosition">
            <input type="text" v-model="query" @keyup.enter="getGeoPosition" />
            <input type="number" name="radius" id="radius" v-model="radius" />
            <button type="submit" class="btn btn-primary">Cerca</button>
          </form>
        </div>
        <!-- /.col input -->
        <div class="col">maps</div>
        <!-- /.col maps -->
      </div>
      <div class="results">
        <div class="container">
          <h4 class="d-flex justify-content-end mt-4 m-2 p-3">
            I nostri appartamenti
          </h4>
          <div class="row row-cols-5 g-4 py-3">
            <div
              class="col"
              v-for="apartment in apartments"
              :key="apartment.id"
            >
              <router-link
                :to="{ name: 'apartment', params: { slug: apartment.slug } }"
              >
                <div class="card_hover card h-100 text-start">
                  <img
                    :src="'storage/' + apartment.thumb"
                    :alt="apartment.title"
                  />
                  <div class="card-body">
                    <h4 class="card-title">{{ apartment.title }}</h4>
                    
                  </div>
                  <!-- In valutazione perché optato per la soluzione del click sull'intera card dell'appartamento-->
                  <!--  <router-link class="btn btn-primary" :to="{ name: 'apartment', params: { slug: apartment.slug } }">Visualizza</router-link>
             -->
                </div>
              </router-link>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- /ricerca avanzata -->
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "Search",
  data() {
    return {
      query: "",
      apartments: "",
      lat: "",
      lon: "",
      radius: 20000,
      response: [],
    };
  },
  methods: {
    getGeoPosition() {
      // Get Geodata from Axios based on input and radius(2000 standard)
      let query = this.query;
      console.log(query);
      let radius = 20000;
      if (query.length > 0) {
        axios
          .get(
            `https://api.tomtom.com/search/2/geocode/${query}.json?key=wwBjO0iyrGBDWYAR81J5EY7D4Y0HJGQj&limit=1&radius=${radius}`
          )
          .then((response) => {
            let lat = response.data.results[0].position.lat;
            let lon = response.data.results[0].position.lon;
            this.lat = lat;
            this.lon = lon;
          // Pass Geo data to ApiController and recieve apartements filtered as response
            axios
          .get("api/search", {
            params: { lat: this.lat, lon: this.lon, radius: this.radius },
          })
          .then((response) => {
            
          console.log(this.lat,this.lon,this.radius);
            console.log(response.data);
            this.apartments = response.data;
          })
          .catch((error) => console.error(error));
          })
          .catch((e) => console.error(e));
      }
    },
  },
  mounted() {
    this.getGeoPosition();
  },
};
</script>

<style lang='scss' scoped>
</style>
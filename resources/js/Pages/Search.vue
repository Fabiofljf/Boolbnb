<template>
  <div class="wrapper">
    <section class="container my-5 p-5 shadow bg_trend">
      <h1 class="p-2">Effettua una nuova ricerca</h1>
      <div class="row row-cols-2">
        <div class="col">

          <form method="POST" @submit.prevent="getGeoPosition">
            <div class="mb-3">
              <label for="query" class="form-label">Cerca per città o per indirizzo:</label>
              <input type="text" class="form-control" name="query" id="query" aria-describedby="helpId"
                placeholder="Milano" v-model="query" @keyup.enter="getGeoPosition" />
              <small id="helpId" class="form-text text-muted">Inserisci una città o un indirizzo anche parziale</small>
            </div>
            <div class="form-group">
              <label for="radius">Distanza dal centro:</label>
              <input type="number" class="form-control" name="radius" id="radius" aria-describedby="helpId"
                placeholder="2000" v-model="radius" @keyup.enter="getGeoPosition" />
              <small id="helpId" class="form-text text-muted">Inserisci in m il raggio dal centro</small>
            </div>

            <button type="submit" class="btn btn-primary">Cerca</button>
          </form>
        </div>
        <!-- /.col input -->
        <div class="col">maps</div>
        <!-- /.col maps -->
      </div>
      <div class="results">
        <div class="container">

          <div v-if="apartments.length > 0">
            <h4 class="d-flex justify-content-end mt-4 m-2 p-3">
              I nostri appartamenti
            </h4>
            <div class="row row-cols-5 g-4 py-3">
              <div class="col" v-for="apartment in apartments" :key="apartment.id">
                <router-link :to="{
                  name: 'apartment',
                  params: {
                    slug: apartment.slug,
                    query: query,
                    radius: radius,
                  },
                }">
                  <div class="card_hover card h-100 text-start">
                    <img :src="'storage/' + apartment.thumb" :alt="apartment.title" />
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
          <div v-else-if="loading" class="mt-5">
            <h2 class="text-center d-block">Loading:</h2>
            <div class="loader">
              <svg id="page-loader">
                <circle cx="75" cy="75" r="20"></circle>
                <circle cx="75" cy="75" r="35"></circle>
                <circle cx="75" cy="75" r="50"></circle>
                <circle cx="75" cy="75" r="65"></circle>
              </svg>
            </div>
          </div>

          <div v-else-if="!loading && lat && lon" class="mt-5">😴😴😴Nessun Risultato</div>
          <div v-else class="mt-5">🔎Inzia la tua ricerca: cerca un appartemento in base alla città o all'indirizzo🔎
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
      apartments: [],
      lat: "",
      lon: "",
      radius: 20000,
      loading: false,

    };
  },
  methods: {
    getAutocomplete() {
      //console.log('digitando');
      if (this.query) {
        axios
          .get(`https://api.tomtom.com/search/2/search/${this.query}.json?key=ZKEljqh55cAJVmD8GpeG3iI4JmV5HEDm&limit=10&countrySet=IT&language=it-IT`)
          .then((response) => {
            //console.log(response.data.results);
            const results = response.data.results;
            this.autocomplete = []
            results.forEach(result => {
              //console.log(result.address.freeformAddress);
              let address = result.address.freeformAddress
              this.autocomplete.push(address)
            });
            //console.log(this.autocomplete);
          })
          .catch((e) => {
            console.log(e);
          })
      }
    },
    getGeoPosition() {
      // Get Geodata from Axios based on input and radius(2000 standard)
      let query = this.query;

      let radius = this.radius;
      if (query) {
        this.loading = true;
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
                console.log(this.lat, this.lon, this.radius);
                console.log(response.data);
                this.apartments = response.data;
                this.loading = false;
              })
              .catch((error) => console.error(error));
          })
          .catch((e) => console.error(e));
      }
    },
  },

  created() {
    //this.query = this.$route.params.query;
  },
  mounted() {
    this.query = this.$route.params.query;
    if (this.$route.params.radius) {
      this.radius = this.$route.params.radius;
    }

    this.getGeoPosition();
  },
};
</script>

<style lang='scss' scoped>
.loader {
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  align-items: center;
  justify-content: center;
}

#page-loader {
  width: 150px;
  height: 150px;

  circle {
    fill: none;
    stroke-width: 5;
    stroke-linecap: round;
    animation-name: loader;
    animation-duration: 4s;
    animation-iteration-count: infinite;
    animation-timing-function: ease-in-out;
    transform-origin: center center;

    &:nth-child(1) {
      stroke: #ffc114;
      stroke-dasharray: 50;
      animation-delay: -0.2s;
    }

    &:nth-child(2) {
      stroke: #ff5248;
      stroke-dasharray: 100;
      animation-delay: -0.4s;
    }

    &:nth-child(3) {
      stroke: #19cdca;
      stroke-dasharray: 180;
      animation-delay: -0.6s;
    }

    &:nth-child(4) {
      stroke: #4e88e1;
      stroke-dasharray: 350;
      stroke-dashoffset: -100;
      animation-delay: -0.8s;
    }

    @keyframes loader {
      50% {
        transform: rotate(360deg);
      }
    }
  }
}
</style>
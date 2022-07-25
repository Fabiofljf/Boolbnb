<template>
  <div class="wrapper mt-5">
    <section class="container my-5 p_relative">
      <div class="row align-items-center">
        <div class="col">
          <h1>Benvenuto in boolbnb</h1>
          <h3>Lasciati ispirare dai luoghi o effettua la tua ricerca</h3>
          <div class="search d-flex align-items-center">
            <div class="dropdown flex-grow-1">
              <input type="text" id="query_address" class="w-100" placeholder="Digita un indirizzo" v-model="query"
                @keyup="getAutocomplete" @keyup.38="listUp" @keyup.40="listDown" />
              <ul class="dropdown_menu w-100" v-if="query.length > 0">
                <li v-for="(address, index) in autocomplete" :key="index">
                  <input type="text" class="w-100" readonly :value="address" @click="setQuery(address)">
                </li>
              </ul>
            </div>
            <router-link :to="{ name: 'search', params: { query: query } }">
              <button type="button" class="btn btn-sm btn-primary text-white">Cerca</button>
            </router-link>
          </div>
        </div>
        <!-- Benvenuto -->
        <div class="col d-flex justify-content-end">
          <div class="btn btn-light shadow">
            filter
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-filter"
              viewBox="0 0 16 16">
              <path
                d="M6 10.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z" />
            </svg>
          </div>
        </div>
        <!-- filter -->
      </div>
    </section>
    <!-- /welcomepages -->

    <!-- INIZIO CARD -->
    <section id="promotion" class="shadow h_400 bg_secondary">
      <div class="container">
        <h4 class="d-flex justify-content-end m-2 p-3">I trend del momento</h4>
        <div class="row row-cols-5">
          <div class="col">
            <div class="card text-start">
              <img :src="'storage/' + 'apartment_images/apartment-1.webp'" alt="" />
              <div class="card-body">
                <h4 class="card-title">title</h4>
                <p class="card-text">description</p>
              </div>
            </div>
          </div>
          <!-- .col -->
          <div class="col">
            <div class="card text-start">
              <img :src="'storage/' + 'apartment_images/apartment-1.webp'" alt="" />
              <div class="card-body">
                <h4 class="card-title">title</h4>
                <p class="card-text">description</p>
              </div>
            </div>
          </div>
          <!-- .col -->
          <div class="col">
            <div class="card text-start">
              <img :src="'storage/' + 'apartment_images/apartment-1.webp'" alt="" />
              <div class="card-body">
                <h4 class="card-title">title</h4>
                <p class="card-text">description</p>
              </div>
            </div>
          </div>
          <!-- .col -->
          <div class="col">
            <div class="card text-start">
              <img :src="'storage/' + 'apartment_images/apartment-1.webp'" alt="" />
              <div class="card-body">
                <h4 class="card-title">title</h4>
                <p class="card-text">description</p>
              </div>
            </div>
          </div>
          <!-- .col -->
          <div class="col">
            <div class="card text-start">
              <img :src="'storage/' + 'apartment_images/apartment-1.webp'" alt="" />
              <div class="card-body">
                <h4 class="card-title">title</h4>
                <p class="card-text">description</p>
              </div>
            </div>
          </div>
          <!-- .col -->
        </div>
      </div>
    </section>
    <!-- /#promotion -->

    <section id="normal" class="py-3">
      <div class="container">
        <h4 class="d-flex justify-content-end mt-4 m-2 p-3">
          I nostri appartamenti
        </h4>
        <div class="row row-cols-5 g-4 py-3">
          <div class="col" v-for="apartment in apartments" :key="apartment.id">
            <router-link :to="{
              name: 'apartment',
              params: { slug: apartment.slug, query: query },
            }">
              <div class="card_hover card h-100 text-start">
                <img :src="'storage/' + apartment.thumb" :alt="apartment.title" />
                <div class="card-body">
                  <h4 class="card-title">{{ apartment.title }}</h4>
                  <p class="card-text">{{ trimText(apartment.description) }}</p>
                </div>
                <!-- In valutazione perché optato per la soluzione del click sull'intera card dell'appartamento-->
                <!--  <router-link class="btn btn-primary" :to="{ name: 'apartment', params: { slug: apartment.slug } }">Visualizza</router-link>
             -->
              </div>
            </router-link>
          </div>
        </div>
      </div>
    </section>
    <!-- /#normal -->
    <!-- /FINE CARD -->

    <div class="
        btn btn-dark
        d-flex
        align-items-center
        shadow
        rounded-pill
        d-flex
        justify-content-center
        w_fix
        p_fixed_maps
      ">
      <p class="me-2 mb-0">
        <router-link :to="{ name: 'search' }">Mostra la mappa</router-link>
      </p>
      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-map"
        viewBox="0 0 16 16">
        <path fill-rule="evenodd"
          d="M15.817.113A.5.5 0 0 1 16 .5v14a.5.5 0 0 1-.402.49l-5 1a.502.502 0 0 1-.196 0L5.5 15.01l-4.902.98A.5.5 0 0 1 0 15.5v-14a.5.5 0 0 1 .402-.49l5-1a.5.5 0 0 1 .196 0L10.5.99l4.902-.98a.5.5 0 0 1 .415.103zM10 1.91l-4-.8v12.98l4 .8V1.91zm1 12.98 4-.8V1.11l-4 .8v12.98zm-6-.8V1.11l-4 .8v12.98l4-.8z" />
      </svg>
    </div>
    <!-- /maps -->
  </div>
</template>

<script>
import axios from "axios";
export default {
  name: "Home",
  data() {
    return {
      apartments: "",
      query: "",
      autocomplete: [],
    };
  },
  methods: {
    listDown() {
      console.log('giu');
      const list = document.getElementById('dropdown_menu'); // targets the <ul>
      const first = list.firstChild; // targets the first <li>
      const maininput = document.getElementById('query_address');  // targets the input, which triggers the functions populating the list
      if (document.activeElement == maininput) {
        // if the currently focused element is the main input --> focus the first <li>
        first.firstChild.focus();
      } else {
        // target the currently focused element -> <a>, go up a node -> <li>, select the next node, go down a node and focus it
        document.activeElement.parentNode.nextSibling.firstChild.focus();
      }
    },
    listUp() {
      console.log('su');
      const list = document.getElementById('dropdown_menu'); // targets the <ul>
      const first = list.firstChild; // targets the first <li>
      const maininput = document.getElementById('query_address');  // targets the input, which triggers the functions populating the list
      if (document.activeElement != maininput || document.activeElement != first) {
        // stop the script if the focus is on the input or first element
        // select the element before the current, and focus it
        document.activeElement.parentNode.previousSibling.firstChild.focus()
      }
    },
    setQuery(add) {
      this.query = add;
      this.autocomplete = []
    },
    getAutocomplete() {
      //console.log('digitando');
      if (this.query) {
        axios
          .get(`https://api.tomtom.com/search/2/search/${this.query}.json?key=ZKEljqh55cAJVmD8GpeG3iI4JmV5HEDm&limit=5&countrySet=IT&language=it-IT`)
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

    getCallApi() {
      axios
        .get("api/apartments")
        .then((response) => {
          this.apartments = response.data;
        })
        .catch((e) => {
          console.error(e);
        });
    },
    trimText(text) {
      if (text.length > 100) {
        return text.slice(0, 50) + "...";
      }
      return text;
    },
  },
  mounted() {
    this.getCallApi();
  },
};
</script>

<style lang='scss' scoped>
.dropdown_menu {
  position: absolute;
  width: 100%;
  z-index: 100;

  input {
    cursor: pointer;

    &:focus {
      background-color: red;
    }
  }
}
</style>
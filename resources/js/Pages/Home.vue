<template>
  <div class="wrapper mt-5">
    <section id="search" class="container my-5 position-relative">
      <img class="w-100 img-fluid hero-img" src="./../../img/hero-img.jpg" alt="" />
      <div class="">
        <div
          class=" jumbo-search w-75
            row
            row-cols-1
            align-items-center
            position-absolute
            top-50
            start-50
            translate-middle
          "
        >
          <div class="col">
            <h1>Benvenuto in boolbnb</h1>
            <h3>Lasciati ispirare dai luoghi o effettua la tua ricerca</h3>
          </div>
          <!-- Benvenuto -->
          <div class="col d-flex ">
            <div class="d-flex align-items-center w-50">
              <div class="dropdown flex-grow-1">
                <input
                  type="text"
                  id="query_address"
                  class="w-100 search-bar"
                  placeholder="Digita un indirizzo"
                  v-model="query"
                  @keyup="getAutocomplete"
                  @keyup.38="listUp"
                  @keyup.40="listDown"
                />
                <ul class="dropdown_menu w-100" v-if="autocomplete.length > 1">
                  <li v-for="(address, index) in autocomplete" :key="index">
                    <input
                      type="text"
                      class="w-100"
                      readonly
                      :value="address"
                      @click="setQuery(address)"
                    />
                  </li>
                </ul>
              </div>
              <router-link
                class="ms-1"
                :to="{ name: 'search', params: { query: query } }"
              >
                <button type="button" class="btn btn-sm btn-primary text-white">
                  Cerca
                </button>
              </router-link>
            </div>
          </div>
          <!-- filter -->
        </div>
      </div>
    </section>
    <!-- /welcomepages -->

    <section id="sponsorizate">
      <div class="container">
        <h4 class="d-flex justify-content-end mt-4 m-2 p-3">I Trend del momento</h4>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-4 row-cols-xl-5 g-4 gy-5 py-3">
          <div class="col" v-for="apartmentPublicity in apartmentPublicities" :key="apartmentPublicity.id">
            <router-link
                :to="{
                  name: 'apartment',
                  params: { slug: apartmentPublicity.slug, query: query },
                }"
            >
              <div class="card-hover card text-start">
                <div class="publicity_banner">Premium</div>
                <img class="img-fluid" :src="'storage/' + apartmentPublicity.thumb" />
                <div class="card-body">
                  <div class="header-card row">
                    <h4 class="col-8 card-title costum-title">
                      {{ apartmentPublicity.title }}
                    </h4>
                    <strong class="col-4 costum-rate costum-title">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                      <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                      </svg> | 5.0
                    </strong>
                  </div>
                  <div class="description-card">
                    <p class="card-text costum-text">{{ trimText(apartmentPublicity.description) }}</p>
                  </div>
                </div>
              </div>

            </router-link>
          </div>
          <div class="col">
            <a href="#">
            <div class="card-hover card text-start">
            <img class="img-fluid" src="./../../img/placeholder.jpg" />
            <div class="card-body">
              <div class="header-card row">
                <h4 class="col-8 card-title costum-title">
                  titolo dell'appartamento
                </h4>
                <h4 class="col-4 costum-rate costum-title">rate</h4>
              </div>
              <div class="description-card">
                <p class="card-text costum-text">descrizione appartamento</p>
              </div>
            </div>
            </div>

            </a>
          </div>
          <div class="col">
            <a href="#">
            <div class="card-hover card text-start">
            <img class="img-fluid" src="./../../img/placeholder.jpg" />
            <div class="card-body">
              <div class="header-card row">
                <h4 class="col-8 card-title costum-title">
                  titolo dell'appartamento
                </h4>
                <h4 class="col-4 costum-rate costum-title">rate</h4>
              </div>
              <div class="description-card">
                <p class="card-text costum-text">descrizione appartamento</p>
              </div>
            </div>
            </div>

            </a>
          </div>
          <div class="col">
            <a href="#">
            <div class="card-hover card text-start">
            <img class="img-fluid" src="./../../img/placeholder.jpg" />
            <div class="card-body">
              <div class="header-card row">
                <h4 class="col-8 card-title costum-title">
                  titolo dell'appartamento
                </h4>
                <h4 class="col-4 costum-rate costum-title">rate</h4>
              </div>
              <div class="description-card">
                <p class="card-text costum-text">descrizione appartamento</p>
              </div>
            </div>
            </div>

            </a>
          </div>
           <div class="col">
            <a href="#">
            <div class="card-hover card text-start">
            <img class="img-fluid" src="./../../img/placeholder.jpg" />
            <div class="card-body">
              <div class="header-card row">
                <h4 class="col-8 card-title costum-title">
                  titolo dell'appartamento
                </h4>
                <h4 class="col-4 costum-rate costum-title">rate</h4>
              </div>
              <div class="description-card">
                <p class="card-text costum-text">descrizione appartamento</p>
              </div>
            </div>
            </div>

            </a>
          </div>
          <div class="col">
            <a href="#">
            <div class="card-hover card text-start">
            <img class="img-fluid" src="./../../img/placeholder.jpg" />
            <div class="card-body">
              <div class="header-card row">
                <h4 class="col-8 card-title costum-title">
                  titolo dell'appartamento
                </h4>
                <h4 class="col-4 costum-rate costum-title">rate</h4>
              </div>
              <div class="description-card">
                <p class="card-text costum-text">descrizione appartamento</p>
              </div>
            </div>
            </div>

            </a>
          </div>

        </div>
      </div>
    </section>

    <section id="normal" class="py-3">
      <div class="container">
        <h4 class="d-flex justify-content-end mt-4 m-2 p-3">
          I nostri appartamenti
        </h4>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-4 row-cols-xl-5 g-4 py-3">
          <div
            class="col mb-3"
            v-for="apartment in apartments"
            :key="apartment.id"
          >
            <router-link
              :to="{
                name: 'apartment',
                params: { slug: apartment.slug, query: query },
              }"
            >
              <div class="card-hover card text-start">
                <img
                  :src="'storage/' + apartment.thumb"
                  :alt="apartment.title"
                />
                <div class="card-body">
                  <div class="header-card">
                    <h4 class=" card-title costum-title">
                      {{ apartment.title }}
                    </h4>
                  </div>
                  <div class="description-card">
                    <p class="costum-text">
                      {{ trimText(apartment.description) }}
                    </p>
                  </div>
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

    <div
      class="
        btn btn-dark
        d-flex
        align-items-center
        shadow
        rounded-pill
        d-flex
        justify-content-center
        w_fix
        p_fixed_maps
        text-white
      "
    >
      <p class="me-2 mb-0">
        <a href="#search">Ricerca alloggio</a>
        <!-- <router-link :to="{ name: 'search' }"></router-link> -->
      </p>
      <svg
        xmlns="http://www.w3.org/2000/svg"
        width="16"
        height="16"
        fill="currentColor"
        class="bi bi-map"
        viewBox="0 0 16 16"
      >
        <path
          fill-rule="evenodd"
          d="M15.817.113A.5.5 0 0 1 16 .5v14a.5.5 0 0 1-.402.49l-5 1a.502.502 0 0 1-.196 0L5.5 15.01l-4.902.98A.5.5 0 0 1 0 15.5v-14a.5.5 0 0 1 .402-.49l5-1a.5.5 0 0 1 .196 0L10.5.99l4.902-.98a.5.5 0 0 1 .415.103zM10 1.91l-4-.8v12.98l4 .8V1.91zm1 12.98 4-.8V1.11l-4 .8v12.98zm-6-.8V1.11l-4 .8v12.98l4-.8z"
        />
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
      apartmentPublicities: "",
    };
  },
  methods: {
    getPublicityApartment(){
      axios
      .get('/api/apartment/publicity')
      .then((response) => {
        this.apartmentPublicities = response.data;
      })
       .catch((e) => {
          console.error(e);
        });
    },
    listDown() {
      console.log("giu");
      const list = document.getElementById("dropdown_menu"); // targets the <ul>
      const first = document.getElementById("dropdown_menu").firstChild; // targets the first <li>
      const maininput = document.getElementById("query_address"); // targets the input, which triggers the functions populating the list
      if (document.activeElement == maininput) {
        // if the currently focused element is the main input --> focus the first <li>
        first.firstChild.focus();
      } else {
        // target the currently focused element -> <a>, go up a node -> <li>, select the next node, go down a node and focus it
        document.activeElement.parentNode.nextSibling.firstChild.focus();
      }
    },
    listUp() {
      console.log("su");
      const list = document.getElementById("dropdown_menu"); // targets the <ul>
      const first = list.firstChild; // targets the first <li>
      const maininput = document.getElementById("query_address"); // targets the input, which triggers the functions populating the list
      if (
        document.activeElement != maininput ||
        document.activeElement != first
      ) {
        // stop the script if the focus is on the input or first element
        // select the element before the current, and focus it
        document.activeElement.parentNode.previousSibling.firstChild.focus();
      }
    },
    setQuery(add) {
      this.query = add;
      this.autocomplete = [];
    },
    getAutocomplete() {
      //console.log('digitando');
      if (this.query) {
        axios
          .get(
            `https://api.tomtom.com/search/2/search/${this.query}.json?key=ZKEljqh55cAJVmD8GpeG3iI4JmV5HEDm&limit=5&countrySet=IT&language=it-IT`
          )
          .then((response) => {
            //console.log(response.data.results);
            const results = response.data.results;
            this.autocomplete = [];
            results.forEach((result) => {
              //console.log(result.address.freeformAddress);
              let address = result.address.freeformAddress;
              this.autocomplete.push(address);
            });
            //console.log(this.autocomplete);
          })
          .catch((e) => {
            console.log(e);
          });
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
    this.getPublicityApartment()
  },
};
</script>

<style lang='scss' scoped>
/* #search{
  height: 300px;
} */
.hero-img{
  height: 400px;
  object-fit: cover;
  border-radius: 10px;
}
.jumbo-search{
  padding: 1rem;
  border-radius: 10px;
  background-color: rgba(244, 244, 244, 0.728) !important;
  min-height: 200px;
}
.dropdown_menu {
  position: absolute;
  z-index: 100;
    width: 300px;
  border-radius: 10px;
  border: 1px solid #a5a5a5;
  border-top: none;
  padding: 0.8rem 0.3rem;
  background-color: white;

  input {
    cursor: pointer;

    &:focus {
      background-color: rgba(117, 124, 184, 0.331);
    }
  }
}

#trend img {
  fill: red;
}
.row {
  background-color: #f8fafc;
}
.card {
  position: relative;
  padding:0.5rem;
  border: none;
  height: 100%;
  background-color: #f8fafc;
  transition: border 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
  border-radius: 5px;
   transition: transform .5s;
 &:hover{
    box-shadow: 0 0 10px 4px #d0d0d0e8;
    transform: scale(1.05);
    z-index: 1;
 }
 .publicity_banner {
  padding: 0.5rem;
  background-color: #3471EB;
  color: white;
  border-radius: 6px;
  position: absolute;
  top: -5%;
  left: -5%;
  transition: transform .5s;
 }
  img {
    
    width: 100%;
    min-height: 160px;
    border-radius: 10px;
  }
  .card-body {
    height: 100px;
    padding: 0.2rem;
    max-width: 240px;
    .header-card {
      margin-top: 10px;
      height: 45px;
      padding: 0;
      display: flex;
      justify-content: space-between;

      .costum-rate {
        text-align: right;
      }
      .costum-title {
        color: #050505;
        font-size: 13px;
        font-weight: bold;
        /* white-space: nowrap; */
        /* overflow: hidden; */
        /* text-overflow: ellipsis; */
      }
    }
  }
}
.costum-text {
  color: #717171;
  font-size: 12px;
}
.search-bar {
  min-width: 200px;
  border-radius: 10px;
  border: 1px solid #c1c2c5;
  padding: 0.3rem 0.8rem;
}
.search-bar:focus-visible {
  outline: 1px solid #a5a5a5;
}
.dropdown_menu {

  li input {
    margin-bottom: 0.2rem;
    border: none;
    border-bottom: 1px solid lightgray;
    outline: none;
  }
}
a{
  color: white;
}
</style>
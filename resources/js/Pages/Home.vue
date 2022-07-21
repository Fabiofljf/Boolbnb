<template>
  <div class="wrapper mt-5">
    <div class="container my-5">
      <h1>Benvenuto in boolbnb</h1>
      <h3>Lasciati ispirare dai luoghi o effettua la tua ricerca</h3>
    </div>
    <!-- /welcomepages -->
    <div class="container">
      <div class="row row-cols-5">
        <div class="col" v-for="apartment in apartments" :key="apartment.id">
          <div class="card text-start">
            <img src="'storage/' + apartment.thumb" alt="">
            <div class="card-body">
              <h4 class="card-title">{{apartment.title}}</h4>
              <p class="card-text">{{trimText(apartment.description)}} </p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- /cards -->
    <div class="btn btn-dark shadow rounded-3 d-flex justify-content-center w_fix">
      Mostra la mappa
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
      apartments: ""
    };
  },
  methods: {
    getCallApi() {
      axios
        .get("API/Apartment")
        .then((response) => {
          console.log(response);
          //console.log(response.data);
          //console.log(response.data.data);
          //this.apartments = response.data;
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
    }
  },
  mounted() {
    this.getCallApi();
  },
};
</script>

<style lang='scss' scoped>
</style>
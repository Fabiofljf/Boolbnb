<template>
  <div id="SingleApartment" class="mt-5">
    <div id="titleAndThumb" class="container">
      <router-link
        :to="{ name: 'search', params: { query: query, radius: radius } }"
        >Torna Alla tua ricerca:</router-link
      >
      <h2 class="">{{ apartment.title }}</h2>
      <div class="row">
        <div class="col">
          <div class="details_apartment d-flex">
            <p>
              <!-- Icona stella da implementare con voto -->
              <span class="icon_color">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  width="22"
                  height="22"
                  fill="currentColor"
                  class="bi bi-star-fill"
                  viewBox="0 0 16 16"
                >
                  <path
                    d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"
                  />
                </svg>
              </span>
              &bull; <strong>5.0</strong>
              |
              <!-- Icona user -->
              <span class="icon_color">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  width="22"
                  height="22"
                  fill="currentColor"
                  class="bi bi-person-badge"
                  viewBox="0 0 16 16"
                >
                  <path
                    d="M6.5 2a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1h-3zM11 8a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"
                  />
                  <path
                    d="M4.5 0A2.5 2.5 0 0 0 2 2.5V14a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2.5A2.5 2.5 0 0 0 11.5 0h-7zM3 2.5A1.5 1.5 0 0 1 4.5 1h7A1.5 1.5 0 0 1 13 2.5v10.795a4.2 4.2 0 0 0-.776-.492C11.392 12.387 10.063 12 8 12s-3.392.387-4.224.803a4.2 4.2 0 0 0-.776.492V2.5z"
                  />
                </svg>
              </span>
              &bull;
              <strong>{{ apartment.user ? apartment.user.name : "" }}</strong>
            </p>
            <p>
              <!-- Icona location -->
              <span class="icon_color">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  width="22"
                  height="22"
                  fill="currentColor"
                  class="bi bi-geo-alt-fill"
                  viewBox="0 0 16 16"
                >
                  <path
                    d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10zm0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6z"
                  />
                </svg>
              </span>
              &bull; <strong>{{ apartment.address }}</strong>
            </p>
          </div>
        </div>
        <!-- /.col sx -->
        <div class="col">
          <div class="shareAndSave_apartment d-flex justify-content-end">
            <p>condividi</p>
            |
            <p>salva</p>
          </div>
        </div>
        <!-- /.col dx -->
      </div>

      <div class="my-3 d-flex justify-content-center align-items-center">
        <img
          style="
            width: 100%;
            height: 600px;
            object-fit: cover;
            object-position: bottom;
          "
          class="rounded-3"
          :src="'/storage/' + apartment.thumb"
          :alt="apartment.title"
        />
      </div>
      <!-- /titleAndThumb -->

      <!-- INFO APPARTAMENTO -->
      <div class="row row-cols-2 mt-4 border-bottom" id="hosting">
        <div class="col my-3">
          <div class="row border-bottom pb-1">
            <div class="d-flex justify-content-between align-items-top">
              <div
                class="
                  apartment-info
                  d-flex
                  justify-content-between
                  align-items-center
                "
              >
                <div>
                  <h3 class="font-weight-bold">
                    <strong>
                      {{ apartment.title }}
                    </strong>
                    <br />
                  </h3>
                  <p>
                    Host:
                    {{ apartment.user ? apartment.user.name : "" }}
                  </p>
                </div>
              </div>
              <div class="profile-img">
                <img
                  style="width: 100px; aspect-ratio: 1/1"
                  class="rounded-circle"
                  src="https://picsum.photos/200/300"
                  alt=""
                />
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col mt-4">
              <h5>Informazioni alloggio:</h5>
              <ul>
                <li><strong>Camere</strong> : {{ apartment.rooms }}</li>
                <li><strong>Letti</strong> : {{ apartment.beds }}</li>
                <li><strong>Bagni</strong> : {{ apartment.baths }}</li>
              </ul>
            </div>
            <div class="services mt-2">
              <h5>Servizi:</h5>
              <ul>
                <li v-for="service in apartment.services" :key="service.id">
                  <span v-html="service.icon"></span>

                  {{ service.name }}
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="map">
            <div id="map" style="width: 100%; height: 100%"></div>
          </div>
        </div>
        <!-- /.col dx-->

        <!-- /.col info hosting -->
      </div>
      <!-- /.col sx-->

      <!-- /HostingAndbooking -->
      <div class="col mt-4 border-bottom">
        <h5>Descrizione alloggio</h5>
        <p class="description">
          {{ apartment.description }}
        </p>
      </div>
      <!-- /Description -->

      <div class="message mt-4">
        <h3>Contatta il proprietario dell'appartamento:</h3>
        <form @submit.prevent="sendMessage">
          <div v-if="success" class="alert alert-success" role="alert">
            <h3>{{ message }}</h3>
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input
              v-model="email"
              required
              type="email"
              class="form-control"
              name="email"
              id="email"
              aria-describedby="emailHelpId"
              placeholder="mario.rossi@gmail.com"
            />
            <small id="emailHelpId" class="form-text text-muted"
              >inserisci la tua email</small
            >
          </div>
          <div class="mb-3">
            <label for="full_name" class="form-label">Nome e Cognome</label>
            <input
              v-model="full_name"
              required
              type="text"
              class="form-control"
              name="full_name"
              id="full_name"
              aria-describedby="full_namehelpId"
              placeholder="Mario Rossi"
            />
            <small id="full_namehelpId" class="form-text text-muted"
              >Inserisci il tuo nome completo</small
            >
          </div>
          <div class="mb-3">
            <label for="subject" class="form-label">Subject:</label>
            <input
              required
              v-model="subject"
              type="text"
              class="form-control"
              name="subject"
              id="subject"
              aria-describedby="subjecthelpId"
              placeholder="FAQ: Costi Aggiuntivi"
            />
            <small id="subjecthelpId" class="form-text text-muted"
              >Inserisci il "Subject" dell'email</small
            >
          </div>
          <div class="mb-3">
            <label for="content" class="form-label">Messaggio:</label>
            <textarea
              v-model="content"
              required
              class="form-control"
              name="content"
              id="content"
              rows="6"
            ></textarea>
          </div>
          <button type="submit" class="btn btn-primary text-white">
            Invia
          </button>
        </form>
      </div>
      <!-- /Services -->
    </div>
  </div>
  <!-- /#SingleApartment -->
</template>

<script>
import tt from "@tomtom-international/web-sdk-maps";
export default {
  name: "Apartment",

  data() {
    return {
      apartment: "",
      success: false,
      query: "",
      radius: "",
      email: "",
      full_name: "",
      content: "",
      subject: "",
      message: "",
      lat: "",
      lon: "",
    };
  },
  methods: {
    getApartment() {
      this.query = this.$route.params.query;
      this.radius = this.$route.params.radius;
      axios
        .get("/api/apartments/" + this.$route.params.slug)
        .then((response) => {
          this.apartment = response.data;
          console.log(response.data.lat);
          this.lat = response.data.lat;
          this.lon = response.data.lon;

          this.getMap();
        })
        .catch((e) => {
          console.error(e);
        });
    },
    sendMessage() {
      this.success = false;
      let data = {
        email: this.email,
        full_name: this.full_name,
        content: this.content,
        apartment_id: this.apartment.id,
        subject: this.subject,
      };

      axios
        .post("/message/create", data)
        .then((response) => {
          (this.email = ""),
            (this.full_name = ""),
            (this.content = ""),
            (this.subject = ""),
            (this.success = true);
          this.message = response.data.message;
        })
        .catch((e) => {
          console.error(e);
          this.success = true;
          this.message = "ERRORE - Messaggio Non Inviato";
        });
    },
    getMap() {
      let cordinate = [this.lon, this.lat];
      console.log(cordinate);
      var map = tt.map({
        key: "wwBjO0iyrGBDWYAR81J5EY7D4Y0HJGQj",
        container: "map",
        center: cordinate,
        zoom: 13,
      });

      let marker = new tt.Marker().setLngLat(cordinate).addTo(map);
      let popupOffsets = {
        top: [0, 0],
        bottom: [0, -45],
        "bottom-right": [0, -70],
        "bottom-left": [0, -70],
        left: [25, -35],
        right: [-25, -35],
      };

      // Show pop-up
      let popup = new tt.Popup({
        offset: popupOffsets,
      }).setHTML(this.apartment.title + "<br>" + this.apartment.address);
      marker.setPopup(popup).togglePopup();
    },
  },
  mounted() {
    this.getApartment();
    if (window.User) {
      this.email = window.User.email;
      this.full_name = window.User.name;
    }
  },
};
</script>

<style lang='scss' scoped>
.map {
  height: 500px;
  width: 100%;
  margin-bottom: 3rem;
}
</style>


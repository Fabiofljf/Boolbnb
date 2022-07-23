<template>
  <div id="SingleApartment" class="mt-5">
    <div id="titleAndThumb" class="container">
      <h2 class="">{{ apartment.title }}</h2>
      <div class="row">
        <div class="col">
          <div class="details_apartment d-flex">
            <p>
              <!-- Icona stella da implementare con voto -->
              <span class="icon_color">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                  <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                </svg> 
              </span>
              &bull; <strong>5.0</strong> 
              |
              <!-- Icona user -->
              <span class="icon_color">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-person-badge" viewBox="0 0 16 16">
                  <path d="M6.5 2a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1h-3zM11 8a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                  <path d="M4.5 0A2.5 2.5 0 0 0 2 2.5V14a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2.5A2.5 2.5 0 0 0 11.5 0h-7zM3 2.5A1.5 1.5 0 0 1 4.5 1h7A1.5 1.5 0 0 1 13 2.5v10.795a4.2 4.2 0 0 0-.776-.492C11.392 12.387 10.063 12 8 12s-3.392.387-4.224.803a4.2 4.2 0 0 0-.776.492V2.5z"/>
                </svg>
              </span>
              &bull; <strong>{{ apartment.user.name }}</strong> 
              |
            </p>           
            <p> 
              <!-- Icona location -->
              <span class="icon_color">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-geo-alt-fill" viewBox="0 0 16 16">
                  <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10zm0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6z"/>
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
          style="width: 100%; height:600px; object-fit:cover; object-position: bottom;"
          class="rounded-3"
          :src="'/storage/' + apartment.thumb"
          :alt="apartment.title"
        />
      </div>
      <!-- /titleAndThumb -->
      <div class="row row-cols-2" id="hosting">
        <div class="col d-flex my-3">
          <div class="col-10 d-flex flex-column justify-content-center">
            <h4>{{ apartment.title }} - Host: {{ apartment.user.name }}</h4>
            <p class="pb-4 m-0 border-bottom">
             <span> <strong>Camere</strong> : {{ apartment.rooms }}</span>  &bull; <span> <strong>Letti</strong> : {{ apartment.beds }} </span> &bull; <span> <strong>Bagni</strong> : {{ apartment.baths }}</span> 
            </p>
          </div>
          <!-- /.col info hosting -->
          <div class="col d-flex align-items-center justify-content-end pb-5">
            <img
              style="width: 100px; aspect-ratio: 1/1"
              class="rounded-circle"
              src="https://picsum.photos/200/300"
              alt=""
            />
          </div>
          <!-- /.col img hosting -->
        </div>
        <!-- /.col sx-->
        <div class="col"></div>
        <!-- /.col dx-->
      </div>
      <!-- /HostingAndbooking -->
      <div class="col mt-3 border-bottom">
        <h5>Descrizione alloggio</h5>
        <p class="description">
           {{ apartment.description }}
        </p>
      </div>
      <!-- /Description -->
      <div class="row">
        <h3>Da sapere</h3>
        <div class="col">
            <h5>Servizi</h5>
            <ul>
                <li>Loop here!</li>
            </ul>
        </div>
        <!-- /.col servizi sx -->
        <div class="col">
            <h5>Salute e sicurezza</h5>
            <ul>
                <li>Si applicano le pratiche di sicurezza di Airbnb per l'emergenza COVID-19</li>
                <li>Rilevatore di monossido di carbonio non segnalato</li>
                <li>Telecamera di sicurezza o dispositivo di registrazione</li>
            </ul>
        </div>
        <!-- /.col (non toccare, statica) centrale -->
        <div class="col">
            <h5>Termini di cancellazione</h5>
            <ul>
                <li>Cancellazione gratuita entro il giorno 1 mag.</li>
                <li>Leggi i termini di cancellazione completi dell'host, che si applicano anche in caso di malattia o disagi legati alla pandemia di COVID-19.</li>
            </ul>
        </div>
        <!-- /.col (non toccare, statica) dx -->
      </div>
      <!-- /Services -->
    </div>
  </div>
  <!-- /#SingleApartment -->
</template>

<script>
export default {
  name: "Apartment",
      data() {
        return {
            apartment: ''
        }
    },
    mounted() {
        axios.get('/api/apartments/' + this.$route.params.slug)
        .then(response => {
            console.log(response.data);
            this.apartment = response.data
     
        })
        .catch(e => {
            console.error(e);
        })
    } 
};
</script>

<style lang='scss' scoped>
</style>
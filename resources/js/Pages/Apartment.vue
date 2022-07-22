<template>
  <div id="SingleApartment" class="mt-5">
    <div id="titleAndThumb" class="container">
      <h2 class="">title - Vakthusøya - Nybryggen - on a small island</h2>
      <div class="row">
        <div class="col">
          <div class="details_apartment d-flex">
            <p>icona-stella 5.0</p>
            |
            <p>icona-superost superost</p>
            |
            <p>location</p>
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
      <div
        class="container my-3 d-flex justify-content-center align-items-center"
      >
        <img
          style="width: 100%"
          class="rounded-3"
          :src="'/storage/' + 'apartment_images/Senza-titolo-1.jpg'"
          alt=""
        />
      </div>
      <!-- /titleAndThumb -->
      <div class="row row-cols-2" id="hosting">
        <div class="col d-flex my-3">
          <div class="col-10 d-flex flex-column justify-content-center">
            <h3>Intero alloggio: unità in affitto - Host: X</h3>
            <p class="pb-5 border-bottom">
              X ospiti, X camere da letto, X letti, X bagno
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
      <div class="col my-3 border-bottom">
        <p class="">
          Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellat
          molestiae inventore nostrum omnis doloribus veritatis, natus libero a
          maxime similique culpa ipsum harum autem labore accusamus ducimus
          impedit dignissimos sunt voluptates. Excepturi quam rerum aperiam
          doloribus qui accusantium, dolorum illo saepe repellat dolorem alias
          libero sapiente, quibusdam, culpa ad laborum ipsum et eveniet
          temporibus eius sequi dolore unde numquam? Maiores eligendi qui
          laborum ullam adipisci nostrum dolor doloribus vitae exercitationem
          et, neque alias in omnis doloremque rerum corrupti officiis corporis
          unde vel beatae. Fugiat ullam nisi libero, autem praesentium at cumque
          est unde necessitatibus possimus suscipit in temporibus, non
          dignissimos!
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
};
</script>

<style lang='scss' scoped>
</style>
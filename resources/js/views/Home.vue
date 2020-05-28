<template>
  <div>
      <div class="col col-sm-6 mx-auto">
          <div class="card">
              <div class="card-header">
                  Menú Principal
              </div>
              <div class="card-body">
                  <div class="row">
                      <div class="col-12 col-sm-4">
                          <div class="form-group text-center">
                            <router-link to="/nuevo_registro">
                                <img class="border rounded-circle shadow p-1 imgRegistro" src="/img/imgRegistro.png" alt="imgRegistro">
                                <p class="mt-3">Nuevo Registro</p>
                            </router-link>
                          </div>
                      </div>
                      <div class="col-12 col-sm-4">
                          <div class="form-group  text-center">
                            <router-link to="/cajeros">
                                <img class="border rounded-circle shadow p-1 imgRegistro" src="/img/imgCajeros.png" alt="imgRegistro">
                                <p class="mt-3">Cajeros</p>
                            </router-link>
                          </div>
                      </div>
                      <div class="col-12 col-sm-4">
                          <div class="form-group  text-center">
                            <router-link to="/reportes">
                                <img class="border rounded-circle shadow p-1 imgRegistro" src="/img/imgReportes.png" alt="imgRegistro">
                                <p class="mt-3">Reportes</p>
                            </router-link>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
</template>

<script>
export default {
    data() {
        return {
            
        }
    },
}
</script>

<style>

@media only screen and (min-width: 768px) {
    .card{
    margin-top: 15%;
    }

    .imgRegistro{
    width: 8rem;
}
}

@media only screen and (max-width: 425px) {
    .card{
    margin-top: 5%;
    }
    .imgRegistro{
    width: 6rem;
}
}




.imgRegistro:hover{
    transform: scale(1.2);
    transition: all 0.3s;
}

</style>
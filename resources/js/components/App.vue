<template>
  <div>
      <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark">
          <a class="navbar-brand" href="#"><img id="jepLogo" src="/img/imgJep.png" alt=""></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
              aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
              <div class="navbar-nav mx-auto">
                    <div v-if="this.$route.name != 'inicio'">
                    <router-link class="btn btn-primary" :to="{name:'nuevo_registro'}">Nuevo Registro</router-link>
                    <router-link class="btn btn-primary " :to="{name:'cajeros'}">Cajeros</router-link>
                    <router-link class="btn btn-primary" :to="{name:'reportes'}">Reportes</router-link>
                    <router-link class="btn btn-primary" :to="{name:'zona'}">Zonas</router-link>
                    </div>
              </div>
          </div>
      </nav>
      <div class="container">
          <router-view></router-view>
      </div>

  </div>
</template>

<script>
export default {
    data() {
      return {
        
      }
    },
    mounted () {

    },

}
</script>

<style>
#jepLogo{
  height:  40px;
}
</style>
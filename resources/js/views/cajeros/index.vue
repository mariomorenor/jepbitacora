<template>
  <div>
      <div class="col-10 mt-4 mx-auto">
          <h2>Listado de Cajeros</h2>
          <div class="contenedor_cajeros">
              <div class="row mt-4">
                
                <div class="ml-4 col-3">
                  <router-link :to="{name: 'nuevo_cajero'}" class="btn btn-primary  shadow">AGREGAR</router-link>
                </div>
                  <div class="col-4 ml-auto" >
                    <div class="d-flex">

                      <button @click="changeType()" class="btn btn-primary mr-2">Buscar</button>
                      <input @keyup="changeType()" v-model="codigo" type="text" class="form-control" placeholder="Buscar...">
                    </div>
                  </div>
              </div>
              <div class="row">
                  <div class="col-3" v-for="cajero in cajeros" :key="cajero.id">
                      <router-link class="router_link_sin_estilo"
                          :to="{name:'editar_cajero', params:{cajero_id: cajero.id}}">
                          <div class="card cajero shadow text-justify">
                              <div class="card-header">
                                  <label class="font-weight-bold">Código Cajero: <span
                                          class="font-weight-normal text-success">{{cajero.codigo}}</span></label>
                              </div>
                              <div class="car-body pt-1 px-3">
                                  <div class="form-group mb-0">
                                      <label class="font-weight-bold">Zona:</label>
                                      <label>{{cajero.zona.numero}} - {{cajero.zona.descripcion}} </label>
                                  </div>
                                  <div class="form-group">
                                      <label class="font-weight-bold">Dirección:</label>
                                      <label>{{cajero.direccion}}</label>
                                  </div>
                              </div>
                          </div>
                      </router-link>
                  </div>
              </div>
          </div>
      </div>

      <infinite-loading :identifier="infiniteId" @infinite="infiniteHandler"></infinite-loading>
  </div>
</template>

<script>

import InfiniteLoading from 'vue-infinite-loading';

export default {
  components: {
    InfiniteLoading,
  },
    data() {
        return {
              infiniteId: +new Date(),
            cajeros: [],
            page:1,
            codigo:'',
            
        }
    },
    mounted() {
  
    },
    methods: {
      infiniteHandler($state){
          axios.get('/cajeros',{
            params:{
              page: this.page,
              codigo:this.codigo
            }
          }).then(({data})=>{
            if(data.data.length){
              this.page += 1;
              this.cajeros.push(...data.data)
              $state.loaded();
        } else {
          $state.complete();
        }
            
          });
      },
          changeType() {
      this.page = 1;
      this.cajeros = [];
      this.infiniteId += 1;
    },
      
    }
}
</script>

<style>
.cajero{
  height: 220px;
}
.cajero:hover{
  transform: scale(1.2);
  transition: all 0.3s;
  cursor: pointer;
}


.router_link_sin_estilo:link, .router_link_sin_estilo:visited, .router_link_sin_estilo:active, .router_link_sin_estilo * {
color: black;
text-decoration: none;
  cursor: pointer;
}


</style>
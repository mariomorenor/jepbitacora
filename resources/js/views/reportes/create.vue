<template>
  <div>
      <div class="container">
          <div class="row mt-5">
              <div class="col mt-5">
                  <h2>Nueva Observación</h2>
                  <form action="#" class="bg-white shadow border border dark rounded p-3 mt-3" method="post">
                      <div class="row p-4">
                          <div class="col-4">
                              <div class="form-group">
                                  <label for="fecha">Fecha: <span>{{fecha_texto}}</span></label>
                                  <input type="date" required focus name="fecha" v-model="fecha" id="fecha" class="form-control">
                              </div>
                          </div>
                          <div class="col-4">
                              <div class="form-group">
                                  <label for="marcacion_1">Marcacion 1:</label>
                                  <div class="">
                                      <div class="d-flex mb-2 pr-5">
                                          <label class="my-auto" for="Hora">Hora:</label>
                                          <input required type="number" placeholder="Ingrese Solo Números" name="hora_1" min="0"
                                              max="23" step="1" id="hora_1" class="form-control ml-2">
                                      </div>
                                      <div class="d-flex  pr-5">
                                          <label class="my-auto" for="Minutos">Minutos:</label>
                                          <input required type="number" name="minuto_1" placeholder="Ingrese Solo Números"
                                              min="0" max="60" step="1" id="minuto_1" class="form-control ml-2">
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <div class="col-4">
                              <div class="form-group">
                                  <label for="marcacion_2">Marcación 2:</label>
                                  <input type="checkbox" class="ml-2 my-auto" v-model="existeMarcacion2">
                                  <div class="" v-if="existeMarcacion2">
                                      <div class="d-flex mb-2 pr-5">
                                          <label class="my-auto" for="Hora">Hora:</label>
                                          <input required type="number" placeholder="Ingrese Solo Números" name="hora_2" min="0"
                                              max="23" step="1" id="hora_2" class="form-control ml-2">
                                      </div>
                                      <div class="d-flex  pr-5">
                                          <label class="my-auto" for="Minutos">Minutos:</label>
                                          <input required type="number" name="minuto_2" placeholder="Ingrese Solo Números"
                                              min="0" max="60" step="1" id="minuto_2" class="form-control ml-2">
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <div class="row">
                        <div class="col-3 ml-5">
                            <div class="form-group">
                                <label >Código Cajero: </label>
                                <div class="d-flex">

                            <select class="form-control" name="cajero_id" id="cajero">
                                <option :value="cajero.id" v-for="cajero in cajeros_filtro" :key="cajero.id">{{cajero.codigo}}</option>
                            </select>
                            <label for="Buscar" class="ml-2 my-auto">Buscar:</label>
                            <input class="form-control ml-2" placeholder="Ingrese el código a buscar" type="number" @change="buscar(code)" v-model="code">
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label>Observación:</label>
                                <select name="descripcion" id="descripcion">
                                    <option :value="observacion.descripcion">{{observacion.descripcion}}</option>
                                </select>
                            </div>
                        </div>
                      </div>
                  </form>
              </div>
          </div>
      </div>
  </div>
</template>

<script>
import moment from 'moment';
require('moment/locale/es')
export default {
data() {
  return {
    existeMarcacion2:false,
    fecha:'',
    cajeros: [],
    cajeros_filtro: [],
    code:'',
  }
},
mounted(){
    this.fecha = moment().format('YYYY-MM-DD');
    this.obtenerCajeros();
},
methods:{
        obtenerCajeros(){
            axios.get('cajeros',{
                params:{
                    sin_paginar:true
                }
            })
                .then(({data})=>{
                    // console.log(data);
                    this.cajeros = data
                    this.cajeros_filtro = data
                })
                .catch((error)=>{
                    console.log(error)
                });
        },
        buscar(cod){
            
            this.cajeros_filtro = this.cajeros.filter(cajero => cajero.codigo.toString().startsWith(cod))
        },
        obtenerObservaciones(){
            axios.get('')
        }
},
computed:{
    fecha_texto(){
        return moment(this.fecha).format('LL');
    },
}
}
</script>

<style>

</style>
<template>
  <div>
      <div class="container">
          <div class="row mt-5">
              <div class="col mt-5">
                  <h2>Nueva Observación</h2>
                  <form action="/reportes" id="form_reporte" class="bg-white shadow border border dark rounded p-3 mt-3" method="post">
                      <div class="row pt-4 px-4">
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
                                          <input type="number" placeholder="Ingrese Solo Números" name="hora_1" min="0"
                                              max="23" step="1" id="hora_1" v-model="hora_1" class="form-control ml-2">
                                      </div>
                                      <div class="d-flex  pr-5">
                                          <label class="my-auto" for="Minutos">Minutos:</label>
                                          <input type="number" name="minuto_1" placeholder="Ingrese Solo Números"
                                              min="0" max="59" step="1" v-model="minuto_1" id="minuto_1" class="form-control ml-2">
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <div class="col-4">
                              <div class="form-group">
                                  <label for="marcacion_2">Marcación 2:</label>
                                  <input type="checkbox" name="marc_2_check" id="marcacion_2" class="ml-2 my-auto" v-model="existeMarcacion2">
                                  <div class="" v-if="existeMarcacion2">
                                      <div class="d-flex mb-2 pr-5">
                                          <label class="my-auto" for="Hora">Hora:</label>
                                          <input type="number" placeholder="Ingrese Solo Números" name="hora_2" min="0"
                                              max="23" step="1" id="hora_2" v-model="hora_2" class="form-control ml-2">
                                      </div>
                                      <div class="d-flex  pr-5">
                                          <label class="my-auto" for="Minutos">Minutos:</label>
                                          <input type="number" name="minuto_2" placeholder="Ingrese Solo Números"
                                              min="0" max="60" step="1" v-model="minuto_2" id="minuto_2" class="form-control ml-2">
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <div class="row mb-1">
                        <div class="col-5 ml-5">
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
                        <div class="col-4">
                            <div class="form-group">
                                <label>Observación:</label>
                                <div class="d-flex">
                                <select name="observacion_id" class="form-control" id="descripcion">
                                    <option :value="observacion.id" v-for="observacion in observaciones" :key="observacion.id">{{observacion.nombre}}</option>
                                </select>
                                <button data-toggle="modal" data-target="#agregar_observacion" type="button" class="btn btn-success btn-sm ml-2">
                                    <i class="fa fa-plus-circle fa-2x"></i>
                                </button>
                                </div>
                            </div>
                        </div>
                      </div>
                      <div class="row">
                          <div class="col-3 mx-auto">
                              <div class="form-group">
                                  <button type="button" @click="guardarReporte()" class="btn shadow btn-primary btn-block">GUARDAR</button>
                              </div>
                          </div>
                      </div>
                  </form>
              </div>
          </div>
      </div>

<!-- Modal -->
<div class="modal fade" id="agregar_observacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Nueva Observación</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="container">
            <div class="row">
                <div class="col">
                    <form action="#" id="form_observacion" method="post">
                        <div class="form-group">
                            <label for="nombre">Observación:</label>
                            <input type="text" name="nombre" class="form-control" v-model="nueva_observacion" placeholder="Ingrese la observación">
                        </div>
                        <div class="form-group">
                            <label for="desc">Descripción:</label>
                            <input type="text" name="descripcion" class="form-control" v-model="observacion_descripcion" placeholder="Deje en Blanco si lo desea...">
                        </div>
                    </form>
                </div>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" @click="guardarNuevaObservacion()" class="btn btn-primary">Guardar</button>
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
    existeMarcacion2:false,
    fecha:'',
    cajeros: [],
    cajeros_filtro: [],
    code:'',
    observaciones:[],
    nueva_observacion:'',
    observacion_descripcion:'',
    hora_1:'',
    minuto_1:'',
    hora_2:'',
    minuto_2:'',

  }
},
mounted(){
    this.fecha = moment().format('YYYY-MM-DD');
    this.obtenerCajeros();
    this.obtenerObservaciones();
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
            axios.get('observaciones')
                    .then(({data})=>{
                        // console.log(data);
                        this.observaciones = data;

                    })
                    .catch((e)=>{
                        console.log(e)
                    })
        },
        guardarNuevaObservacion(){
            let form = $('#form_observacion').serialize();
            axios.post('observaciones',form)
                    .then((data)=>{
                        // console.log(data)
                        if (data.status == 200) {
                            this.obtenerObservaciones();
                            $('#agregar_observacion').modal('hide');
                            this.observacion_descripcion = '';
                            this.nueva_observacion='';
                        }
                    })
                    .catch((e)=>{
                        console.log(e)
                    })
        },
        guardarReporte(){
            let form_reporte = $('#form_reporte').serialize();
            axios.post('reportes',form_reporte)
                    .then((data)=>{
                        // console.log(data);
                        if(data.status == 200){
                            this.resetInputs();
                        Swal.fire({
                            icon:'success',
                            title:'Operación Realizada Correctamente!',
                            timer: 1000,
                        })
                        }
                    })
                    .catch((e)=>{
                        console.log(e);
                        Swal.fire({
                            icon: 'error',
                            title: 'Operación Fallida!',
                            text: 'Por favor verifique los campos que estén ingresados correctamente.',
                            
                        });
                    })
        },
        resetInputs(){
            this.hora_1 = '';
            this.hora_2 = '';
            this.minuto_1 = '';
            this.minuto_2 = '';
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
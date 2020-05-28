<template>
  <div>
      <div id="content" class="container">
          <div class="row">
              <h2 class="mx-auto mb-2">Detalles Cajero</h2>
          </div>
          <div class="row">
              <div class="col-5 mx-auto">
                  <form :action="'/cajeros/'+cajero.id" id="form_actualizar_cajero" class="shadow bg-white border border-dark rounded p-4">
                    <button @click="eliminarCajero(cajero.id)" type="button"  class="btn btn-danger btnEliminar">    
                         <i  class="fas fa-trash-alt fa-lg"></i>
                      </button>
                      <div class="form-group mt-3">
                          <label for="codigo">Código</label>
                          <input type="text" name="codigo" readonly class="form-control" v-model="cajero.codigo">
                      </div>
                      <div class="form-group" v-if="!edit_mode">
                          <label for="zona">Zona</label>
                          <div class="d-flex">
                              <input type="text" class="form-control" :readonly="!edit_mode"
                                  :value="cajero_zona.numero+' - ' + cajero_zona.descripcion ">
                              <button @click="mode_edit(false)" type="button" class="btn btn-primary btn-sm ml-3">
                                  <i  class="fas fa-edit fa-lg"></i>
                              </button>
                          </div>
                      </div>
                      <div v-else-if="edit_mode" class="form-group">
                          <label for="codigo">Zona</label>
                          <div class="d-flex">
                              <select name="zona_id" class="form-control" id="zona">
                                  <option v-for="zona in zonas" :key="zona.id" :value="zona.id">{{zona.numero}} -
                                      {{zona.descripcion}}</option>
                              </select>
                              <button type="button" @click="mode_edit(true)" class="btn btn-danger ml-3">
                                
                                    <i  class="fas fa-window-close fa-lg"></i>
                                    
                              </button>
                              <button type="button" data-toggle="modal" data-target="#modal_agregar_zona"
                                  data-backdrop="static" class="btn btn-primary ml-1 ">
                                  <i class="fas fa-plus-circle fa-lg"></i>
                              </button>
                          </div>
                      </div>
                      <div class="form-group">
                          <label for="codigo">Dirección</label>
                          <textarea name="direccion" v-model="cajero.direccion" id="direccion" cols="30" rows="3" class="form-control"></textarea>
                      </div>
                      <div class="form-group">
                          <button type="button" @click="actualizarCajero(cajero.id)" class="btn btn-success btn-block shadow">ACTUALIZAR</button>
                      </div>
                  </form>
              </div>
          </div>
      </div>

<!-- Modal -->
<div class="modal fade" id="modal_agregar_zona" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Nueva Zona</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-6 mx-auto">
            <form id="form_agregar_zona" action="/zonas" method="post">
              <div class="form-group">
                <label for="numero">Número:</label>
                <input type="text" class="form-control" v-model="zona_numero" name="numero" id="numero">
              </div>
              <div class="form-group">
                <label for="descripcion">Descripción:</label>
                <input type="text" class="form-control" v-model="zona_descripcion" name="descripcion" id="descripcion">
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" @click="resetInputModal()" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" @click="agregarZona()" class="btn btn-success">Guardar</button>
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
      cajero: '',
      zonas:[],
      cajero_zona: '',
      zona_numero:'',
      zona_descripcion:'',
      edit_mode: false
    }
  },
  created(){
    this.obtenerCajero();
  },
  methods: {
      obtenerCajero(){
              axios.get('/cajeros/'+this.$route.params.cajero_id)
            .then(({data})=>{
              // console.log(data)
              this.cajero = data.cajero;
              this.cajero_zona = data.zona;
            });
      },
      obtenerZonas(){
                      axios.get('/zonas')
            .then(({data})=>{
              // console.log(data)
              this.zonas = data;
            });
      },
      agregarZona() {
        let datos = $('#form_agregar_zona').serialize();
          axios.post('/zonas',datos)
                .then((response)=>{
                  // console.log(response.status)
                  if (response.status == 200) {
                    this.obtenerZonas();
                    $('#modal_agregar_zona').modal('hide');
                    this.zona_numero = '',
                    this.zona_descripcion = ''
                  }
                })
                .catch(function (error) {
                });
      },
      resetInputModal(){
          this.zona_numero = ''
          this.zona_descripcion = ''
      },
      mode_edit(mode){
        this.edit_mode = !mode;
        this.obtenerZonas();
      },
      actualizarCajero(cajero_id){
        let that = this;
        $.ajax({
          type: "put",
          url: "/cajeros/"+cajero_id,
          data: $('#form_actualizar_cajero').serialize(),
          success: function (response) {
            // console.log(response)
            Swal.fire({
              icon:'success',
              title:'La Operación Se Realizó Correctamente!',
              timer:'1500'
            })
            
          },
          error: function(error){
            console.log(error)
          }
        });
      },
      eliminarCajero(id) {
          Swal.fire({
            icon: 'warning',
            title: 'Está Seguro de Realizar esta Acción?',
            text: 'La información no podrá ser recuperada.',
            showCancelButton: true,
            confirmButtonText: 'Simón, elimina nomás',
            cancelButtonText: 'Cancelar, cancelar'
          }).then((result)=>{
            if (result.value) {
              axios.delete('/cajeros/' + id)
              .then((data) => {
                  // console.log(data)
                  if (data.status == 200) {
                      Swal.fire({
                          icon: 'success',
                          title: 'La Operación Se Realizó Correctamente!',
                          timer: '1500'
                      }).then((result) => {
                          this.$router.push('/cajeros')
                      })
                  }
              })
              .catch(function (e) {
                  console.log(e)
                  Swal.fire({
                      icon: 'error',
                      title: 'Operación Fallida!',
                      text: 'Existió un error al Realizar la Operación, Intente más Tarde'
                  })
              });
            }
          })
          }
      

  }
}
</script>

<style>
#content{
  margin-top: 5rem;
}
.btnEliminar{
  margin-left: 70%;
  position: absolute;
}
</style>
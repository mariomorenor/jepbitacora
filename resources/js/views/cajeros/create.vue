<template>
  <div>
      <div id="content" class="container">
          <div class="row">
              <h2 class="mx-auto mb-2">Nuevo Cajero</h2>
          </div>
          <div class="row">
              <div class="col-5 mx-auto">
                  <form action="#" id="form_nuevo_cajero" class="shadow bg-white border border-dark rounded p-4">
                      <div class="form-group">
                          <label for="codigo">Código</label>
                          <input type="text" name="codigo" placeholder="Ingrese Solo Números" class="form-control" v-model="codigo">
                      </div>
                      <div class="form-group">
                          <label for="codigo">Zona</label>
                          <div class="d-flex">
                              <select name="zona_id" class="form-control" id="zona">
                                  <option v-for="zona in zonas" :key="zona.id" :value="zona.id">{{zona.numero}} -
                                      {{zona.descripcion}}</option>
                              </select>
                              <button type="button" data-toggle="modal" data-target="#modal_agregar_zona"
                                  data-backdrop="static" class="btn btn-primary ml-1 ">
                                  <i class="fas fa-plus-circle fa-lg"></i>
                              </button>
                          </div>
                      </div>
                      <div class="form-group">
                          <label for="codigo">Dirección</label>
                          <textarea name="direccion" placeholder="Ingrese La Dirección del Cajero..." v-model="direccion" id="direccion" cols="30" rows="3" class="form-control"></textarea>
                      </div>
                      <div class="form-group">
                          <button type="button" :disabled="codigo == '' ? true:false" @click="agregarCajero()" class="btn btn-success btn-block shadow">ACTUALIZAR</button>
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
     
      zonas:[],
      zona_numero:'',
      zona_descripcion:'',
      codigo:'',
      direccion:'',

    }
  },
  created(){
    this.obtenerZonas();
  },
  methods: {

      obtenerZonas(){
                      axios.get('/zonas')
            .then(({data})=>{
              // console.log(data.rows)
              this.zonas = data.rows;
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
          this.zona_numero = '';
          this.zona_descripcion = '';
                this.codigo='';
      this.direccion='';
      },
      agregarCajero(){
        let that = this;
        $.ajax({
          type: "post",
          url: "/cajeros",
          data: $('#form_nuevo_cajero').serialize(),
          success: function (response) {
            console.log(response)
            if(response == 200){
              that.resetInputModal();
              Swal.fire({
                icon: 'success',
                title: 'Operación Realizada Correctamente!',
                timer: 1000
              })
            }
          },
          error: function(e){
            // console.log(e)
            if (e.responseText == '23000') {
              Swal.fire({
                icon: 'error',
                title: 'Operación Fallida!',
                text: 'El código de cajero ya existe o los campos están vacíos.'
              })
            }else if (e.responseText === 'HY000') {
                Swal.fire({
                icon: 'error',
                title: 'Operación Fallida!',
                text: 'El código No debe contener letras.'
              })
            }
          }
        });
      }
  }
}
</script>

<style>
#content{
  margin-top: 5rem;
}
</style>
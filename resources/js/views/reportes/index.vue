<template>
  <div>
      <div class="container">
        <div class="row mt-5">
          <h1 class="my-4 mx-auto">Reportes</h1>
        </div>
        
        <div class="row">
          <div class="col mx-auto">
              <div class="table-container">
                <div id="toolbar" class="">
                  <div class="col">
                    <div class="d-flex">
                    <label for="desde" class="my-auto mr-2">Desde:</label>
                    <input type="date" v-model="desde" id="desde" name="desde" class="form-control">
                    <label for="hasta" class="my-auto mr-2">Hasta:</label>
                    <input type="date" id="hasta" v-model="hasta" name="hasta" class="form-control">
                    <button type="button" v-if="!filtroFecha" :disabled=" (desde == '' || hasta == '') ? true:false" @click="filtrarPorFecha()" class=" ml-2 btn btn-primary">Buscar</button>
                    <button type="button" @click="resetFiltro()" v-else  class=" ml-2 btn btn-warning">Reset</button>
                    <form method="get" action="/pdf">
                    <label hidden for="desde" class="my-auto mr-2">Desde:</label>
                    <input hidden  type="date" v-model="desde" name="desde" class="form-control">
                    <label hidden for="hasta" class="my-auto mr-2">Hasta:</label>
                    <input hidden type="date"  v-model="hasta" name="hasta" class="form-control">
                      <button type="submit"  class="btn btn-secondary ml-2">GenerarReporte</button>
                      </form>
                    </div>
                  </div>
                </div>
                
                <table id="table" class="table" data-show-columns="true" data-toolbar="#toolbar"  data-show-export="true" data-search="true" data-pagination="true" data-height="500" data-page-size="50" data-custom-search="buscar"  >
                  <thead class="bg-success">
                    <tr>
                      <th data-align="center" data-width="10" data-field="cajero" data-events="operateEvents" data-sortable="true" data-formatter="cajeroFormatter">Cajero</th>
                      <th data-field="direccion" data-width="420" data-formatter="direccionFormatter">Direccion</th>
                      <th data-field="marcacion_1" data-align="center" data-width="10" >Marcacion 1</th>
                      <th data-field="marcacion_2" data-align="center" data-width="10" >Marcacion 2</th>
                      <th data-field="fecha" data-sortable="true" data-formatter="fechaFormatter">Fecha</th>
                      <th data-field="observacion" data-formatter="observacionFormatter" class="ancho">Observacion</th>
                    </tr>
                  </thead>
                </table>
              </div>
          </div>
        </div>
      </div>
  </div>
</template>

<script>

window.operateEvents={
  'click .detalles': function(e, value, row, index){
    app.__vue__.$router.push('/reportes/'+row.id)
  },
  'click .codigo_link': function (e, value,row ,index) {
    app.__vue__.$router.push('/cajeros/editar/'+row.cajero.id)
    }
}
  
export default {
    data() {
      return {
        desde:'',
        hasta:'',
        filtroFecha: false
      }
    },
    created() {
      
    },
    methods: {
      filtrarPorFecha(){
        this.filtroFecha = true;
        var table = $('#table');
        let d = this.desde;
        let h = this.hasta;
        table.bootstrapTable('refreshOptions',{
          queryParams:{
            desde: d,
            hasta: h,
          }
        })
      },
      resetFiltro(){
        this.filtroFecha = false;
        this.desde = '';
        this.hasta ='';
        var table = $('#table');
        table.bootstrapTable('refreshOptions',{
            url: "/reportes",
             queryParams:{},
        });
      },
      generarPDF(){

        axios.get('pdf').then((result)=>{console.log(result)}).catch((e)=>{console.log(e.response)})
      }
    },
    mounted() {
        var table = $('#table');
        table.bootstrapTable({
            url: "/reportes",
            // exportTypes: ['xlsx', 'pdf'],
            responseHandler: function(res){
              // console.log(res)
              return res;
            }
        });

    },

}


 
</script>


<style>
.table-container{
margin-top: -30px;
}
.ancho{
  height: auto;
}
</style>
<template>
  <div>
      <div class="container">
        <div class="row mt-5">
          <h1 class="mt-5 mx-auto">Reportes</h1>
        </div>
        <div class="row">
          <div class="col mx-auto">
              <div class="table-container">
                <div id="toolbar" class="">
                </div>
                <table id="table" class="table" data-show-export="true" data-search="true" data-pagination="true" data-height="500" data-page-size="50" data-custom-search="buscar"  >
                  <thead class="bg-success">
                    <tr>
                      <th data-field="cajero" data-events="operateEvents" data-sortable="true" data-formatter="cajeroFormatter">Cajero</th>
                      <th data-field="direccion" data-formatter="direccionFormatter">Dirección</th>
                      <th data-field="marcacion_1">Marcación 1</th>
                      <th data-field="marcacion_2">Marcación 2</th>
                      <th data-field="observacion" data-formatter="observacionFormatter">Observación</th>
                      <th data-field="fecha" data-sortable="true" data-formatter="fechaFormatter">Fecha</th>
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
    console.log(value);
    app.__vue__.$router.push('/cajeros/editar/'+row.cajero.id)
    }
}
  
export default {
    created() {
      
    },
    methods: {
      
    },
    mounted() {
        var table = $('#table');
        table.bootstrapTable({
            url: "/reportes",
        });

    },

}


 
</script>


<style>
.table-container{
margin-top: -30px;
}
</style>
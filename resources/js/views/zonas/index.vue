<template>
  <div class="view">
      <div class="container">
          <h2 class="mt-5">Zonas y Observaciones</h2>
          <div class="row">
              <div class="col">
                  <div>
                      <table id="ZonasTable">
                          <thead>
                              <tr>
                                  <th data-field="numero" >Zona</th>
                                  <th data-field="descripcion" data-formatter="">Descripción</th>
                                  <th data-field="" data-formatter="detallesFormatter" data-events="operateEvents"></th>
                              </tr>
                          </thead>
                      </table>
                  </div>
              </div>
              <div class="col">
                  <div>
                      <table id="ObservacionTable">
                          <thead>
                              <tr>
                                  <th data-field="nombre" data-formatter="observacionTableFormatterO">Observaciones</th>
                                  <th data-field="descripcion" data-formatter="">Descripción</th>
                                  <th data-field="deta" data-formatter="detallesFormatterO" data-events="operateEventsO"></th>
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

window.operateEvents = {
    'click .btnDelete': function(e, value, row) {
        var tb = $('#ZonasTable');
    Swal.fire({
            icon: 'warning',
            title: 'Eliminar?',
            showCancelButton: true,

        }).then((result)=>{
            if (result.value) {
               axios.delete('zonas/'+row.id)
                    .then((data)=>{
                        // console.log(data)
                        Swal.fire({
                            icon: 'success',
                            title: 'Operación Finalizada con Exito!',
                            timer: 1000
                        });
                        if (data.status == 200) {
                            tb.bootstrapTable('refresh');
                        }
                    })
                    .catch((e)=>{
                        // console.log(e)
                        Swal.fire({
                            icon: 'error',
                            title: 'No se puede eliminar una zona en uso.',
                            text: 'Por favor, actualice la zona para que no pertenezca a ningún cajero antes de eliminarla.'
                        })
                    })
            }
        });
    }
}
window.operateEventsO = {
    'click .btnDeleteO': function(e, value, row) {
        var Otb = $('#ObservacionTable');
    Swal.fire({
            icon: 'warning',
            title: 'Eliminar?',
            showCancelButton: true,

        }).then((result)=>{
            if (result.value) {
               axios.delete('observaciones/'+row.id)
                    .then((data)=>{
                        // console.log(data)
                        Swal.fire({
                            icon: 'success',
                            title: 'Operación Finalizada con Exito!',
                            timer: 1000
                        });
                        if (data.status == 200) {
                            Otb.bootstrapTable('refresh');
                        }
                    })
                    .catch((e)=>{
                        // console.log(e)
                        Swal.fire({
                            icon: 'error',
                            title: 'No se puede eliminar una Observación en uso.',
                        })
                    })
            }
        });
    }
}

export default {
    mounted() {
        var zonasT = $('#ZonasTable');
        var ObT = $('#ObservacionTable');

        zonasT.bootstrapTable({
            url: 'zonas',
            height: '400',
            
        });
        ObT.bootstrapTable({
            url: 'observaciones',
            height: '400',
        });
    },
}
</script>

<style>
.view{
    margin-top: 10%;
}
</style>
<template>
  <div>
      <div>
          <div class="row mt-5">
              <div class="col">
                  <div class="card">
                      <div class="card-header d-flex">
                          <label for="">Reporte Cajero:</label>
                          <span>{{reporte.cajero.codigo}}</span> 
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
            reporte:''
        }
    },
    mounted(){
        this.obtenerReporte()
    },
    methods: {
        obtenerReporte(){
       
            axios.get('/reportes/'+this.$route.params.reporte_id)
                    .then(({data})=>{
                        console.log(data);
                        this.reporte = data;
                    })
                    .then((e)=>{
                        console.log(e)
                    });
        }
    },
}
</script>

<style>

</style>
<template>
  <div class="card">
    <div class="card-header">
      <i class="fa fa-list-ol" aria-hidden="true"></i>Actividades del Seguimiento
    </div>
    <div class="card-body">
      <div class="form-row">
        <div class="form-group col-md-4" v-if="allTracings.length">
          <label class="font-weight-bold" for="inputProvince">Seguimiento</label>
          <v-select
            :options="allTracings"
            :reduce="tracing => tracing.id"
            label="identification"
            placeholder="Seleccionar Productor"
            v-model="tracing_id"
            @input="changeTracing(tracing_id)"
            class="vs_select_custom"
            >
            <template v-slot:option="option">
              {{ option.identification }} - {{option.producer}}
            </template>
            <div slot="no-options">No hay Resultados!</div>
          </v-select>
        </div>
        <div class="form-group col-md-4" v-if="linea !== undefined">
          <label class="font-weight-bold" for="inputIdent">Linea Productiva</label>
          <label class="form-control" id="inputIdent">{{linea.name}}</label>
        </div>
        <div class="form-group col-md-4 my-auto" v-if="linea !== undefined">
          <button
            @click="$emit('speak', 'addActivity'), sendData(tracing_id)"
            class="btn btn-primary"
            >
            <i class="fa fa-plus-circle" aria-hidden="true"></i> Agregar Actividad
          </button>
        </div>
      </div>
      <div class="table-responsive">
        <table class="table table-striped table-sm" v-if="allDevelopedActivities.developed_activities">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Actividad</th>
              <th scope="col">Fecha</th>
              <th scope="col">Limitantes Fitosanitarias</th>
              <th scope="col">Producto</th>
              <th scope="col">Dosis</th>
              <th scope="col">Total Producto</th>
              <th scope="col">Mano de Obra</th>
              <th scope="col">Imágenes</th>
            </tr>
          </thead>
          <tbody class="body_table">
            <tr v-if="!allDevelopedActivities.developed_activities.length">
              <td colspan="8">
                <div class="alert alert-danger text-center" role="alert">
                 Sin Resultados!
                </div>
              </td>
            </tr>
            <tr v-else v-for="(item, index) in allDevelopedActivities.developed_activities" :key="index">
              <th>{{ item.id }}</th>
              <th>{{ item.activity.name }}</th>
              <th>{{ item.date_performed }}</th>
              <th>{{ item.phytosanitary_limitation ? item.phytosanitary_limitation : 'N/A'}}</th>
              <th>{{ item.product ? item.product : 'N/A'}}</th>
              <th>{{ item.dose ? item.dose + item.dose_type : 'N/A'}}</th>
              <th>{{ item.quantity ? item.quantity : 'N/A'}}</th>
              <th>{{ item.employees }}</th>
              <th v-if="item.activity_image.length">
                <div class="block">
                  <el-carousel height="60px" arrow="never">
                    <el-carousel-item v-for="(image, indexImage) in item.activity_image" :key="indexImage">
                      <img @click="openModal(item.activity_image)" :src="urlHost+'/uploads/'+image.image_path" class="img-fluid">
                    </el-carousel-item>
                  </el-carousel>
                </div>
              </th>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <!-- Section Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="block" v-if="listImages.length">
              <el-carousel height="350px">
                <el-carousel-item v-for="(img, i) in listImages" :key="i">
                  <img :src="urlHost+'/uploads/'+img.image_path" class="img-fluid">
                </el-carousel-item>
              </el-carousel>
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
      tracing_id: '',
      listImages: []
    }
  },
  computed: {
    urlHost(){
      return window.location.origin
    },
    allTracings(){
      return this.$store.state.allTracings
    },
    linea(){
      return this.$store.state.allDevelopedActivities.production_line
    },
    allDevelopedActivities(){
      return this.$store.state.allDevelopedActivities
    },
  },
  methods: {
    changeTracing(e){
      this.$store.dispatch('getDevelopedActivities', e)
    },
    sendData(tracing_id){
      this.$store.state.allDevelopedActivities = {}
      this.$store.dispatch('saveTracingId', tracing_id);
    },
    //Metodos para que funcione el modal Imagenes
    openModal(images) {
      this.listImages = images
      $('#myModal').modal('show')
    },
    closeModal() {
      $('#myModal').modal('hide')
    }
  }
}
</script>
<style lang="scss" scoped>
  .body_table{
    th{
      font-weight: 300;
    }
    th img{
      &:hover{
        cursor: pointer;
      }
    }

  }
</style>
<style lang="scss">
  .el-carousel__item h3 {
    color: #475669;
    font-size: 14px;
    opacity: 0.75;
    line-height: 150px;
    margin: 0;
  }

  .el-carousel__item:nth-child(2n) {
    background-color: #99a9bf;
  }

  .el-carousel__item:nth-child(2n+1) {
    background-color: #d3dce6;
  }
  .el-carousel__indicators--horizontal{
    display: none;
  }
  /* .el-carousel__arrow{
    display: none;
    &:hover{
      display: none;
    }
  } */
</style>

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
        <div class="form-group col-md-4">
          <button class="btn btn-primary">Crear Actividad</button>
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
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      tracing_id: ''
    }
  },
  computed: {
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
  created() {

  },
  methods: {
    changeTracing(e){
      this.$store.dispatch('getDevelopedActivities', e)
    },
  }
}
</script>
<style lang="scss" scoped>
  .body_table{
    th{
      font-weight: 300;
    }
  }
</style>

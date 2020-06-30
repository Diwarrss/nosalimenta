<template>
  <div class="col-md-12">
    <!-- Options -->
    <section>
      <button class="btn btn-primary" @click.prevent="changeForm(true)">Crear Seguimiento</button>
      <button class="btn btn-primary" @click.prevent="changeForm(false)">Agregar Actividad</button>
    </section>
    <!-- Show forms -->
    <section class="my-3">
      <div class="row">
        <div v-if="showActivity" class="col-md-12">
          <div class="card">
            <div class="card-header">
              <i class="fa fa-list-alt" aria-hidden="true"></i> Crear Seguimiento
            </div>
            <div class="card-body">
              <form>
                <div class="form-row">
                  <div class="form-group col-md-4">
                    <label class="font-weight-bold" for="inputProvince">Provincia</label>
                    <select v-model="formCreate.province_id" id="inputProvince" class="form-control" @change="getMunicipalities()">
                      <option selected value="">Seleccionar...</option>
                      <option :value="item.id" v-for="(item, index) in allProvinces" :key="index">
                        {{item.name}}
                      </option>
                    </select>
                  </div>
                  <div class="form-group col-md-4">
                    <label class="font-weight-bold" for="inputMunicipality">Municipio</label>
                    <select v-model="formCreate.municipality_id" id="inputMunicipality" class="form-control">
                      <option selected value="">Seleccionar...</option>
                      <option :value="item.id" v-for="(item, index) in allMunicipalities" :key="index">
                        {{item.name}}
                      </option>
                    </select>
                  </div>
                  <div class="form-group col-md-4">
                    <label class="font-weight-bold" for="inputZone">Vereda</label>
                    <input v-model="formCreate.zone" @input="formCreate.zone = $event.target.value.toUpperCase()" type="text" class="form-control" id="inputZone">
                  </div>
                  <div class="form-group col-md-4">
                    <label class="font-weight-bold" for="inputIdent">No. Identificación</label>
                    <input v-model="formCreate.identification" type="text" class="form-control" id="inputIdent">
                  </div>
                  <div class="form-group col-md-5">
                    <label class="font-weight-bold" for="inputName">Nombres y Apellidos <span class="font-weight-light">(Productor)</span></label>
                    <input v-model="formCreate.producer" @input="formCreate.producer = $event.target.value.toUpperCase()" type="text" class="form-control" id="inputName">
                  </div>
                  <div class="form-group col-md-3">
                    <label class="font-weight-bold" for="inputphone">Celular</label>
                    <input v-model="formCreate.phone" type="text" class="form-control" id="inputphone">
                  </div>
                  <div class="form-group col-md-4">
                    <label class="font-weight-bold" for="inputProdLine">Linea de produccion</label>
                    <select v-model="formCreate.production_line_id" id="inputProdLine" class="form-control">
                      <option selected value="">Seleccionar...</option>
                      <option :value="item.id" v-for="(item, index) in allProdLines" :key="index">
                        {{item.name}}
                      </option>
                    </select>
                  </div>
                </div>
              </form>
            </div>
            <div class="card-footer text-right">
              <button @click.prevent="saveTracing" class="btn btn-success"><i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar</button>
            </div>
          </div>
        </div>
        <div v-else class="col-md-12">
          <div class="card">
            <div class="card-header">
              <i class="fa fa-list-ol" aria-hidden="true"></i> Agregar Actividad
            </div>
            <div class="card-body">
              <form>
                <div class="form-row">
                  <div class="form-group col-md-4" v-if="allTracings.length">
                    <label class="font-weight-bold" for="inputProvince">Seguimiento</label>
                    <!-- @input="selectTracing(tracing)" -->
                    <v-select

                      :options="allTracings"
                      label="identification"
                      placeholder="Seleccionar Productor"
                      v-model="formActivity.tracing"
                      class="vs_select_custom"
                      >
                      <template v-slot:option="option">
                        {{ option.identification }} - {{option.producer}}
                      </template>
                      <div slot="no-options">No hay Resultados!</div>
                    </v-select>
                  </div>
                  <div class="form-group col-md-8">
                    <label class="font-weight-bold" for="activity">Actividad</label>
                    <select v-model="formActivity.activity" @change="selectActivity()" id="activity" class="form-control">
                      <option selected value="">Seleccionar...</option>
                      <option :value="item" v-for="(item, index) in allActivities" :key="index">
                        {{item.name}}
                      </option>
                    </select>
                  </div>
                  <div class="form-group col-md-4">
                    <label class="font-weight-bold" for="date">Fecha</label>
                    <input v-model="formActivity.date_performed" class="form-control" type="date" id="date">
                  </div>
                  <div class="form-group col-md-12">
                    <label class="font-weight-bold" for="inputphone">Descripción</label>
                    <textarea v-model="formActivity.description" class="form-control" id="imputdesc" cols="12" rows="3"></textarea>
                  </div>
                  <div class="form-group col-md-2">
                    <label class="font-weight-bold" for="inputdose">Dosis</label>
                    <input type="text" class="form-control" id="inputdose">
                  </div>
                  <div class="form-group col-md-1" v-if="showStatus">
                    <label class="font-weight-bold" for="inputunity">Unidad</label>
                    <select id="unity" class="form-control">
                      <option selected value="">g</option>
                      <option selected value="">L</option>
                      <option selected value="">Kg</option>
                    </select>
                  </div>
                </div>
              </form>
            </div>
            <div class="card-footer text-right">
              <button type="submit" class="btn btn-success"><i class="fa fa-plus-square" aria-hidden="true"></i> Agregar</button>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>
<script>
export default {
  data() {
    return {
      showActivity: true,
      formCreate:{
        province_id: '',
        municipality_id: '',
        zone: '',
        producer: '',
        identification: '',
        phone: '',
        production_line_id: ''
      },
      allMunicipalities: [],
      formActivity:{
        tracing: '',
        activity: '',
        activity_id: '',
        date_performed: '',
        description: '',
      },
      showStatus: false
    }
  },
  computed: {
    allTracings(){
      return this.$store.state.allTracings
    },
    allProvinces(){
      return this.$store.state.allProvinces
    },
    allActivities(){
      return this.$store.state.allActivities
    },
    allProdLines(){
      return this.$store.state.allProdLines
    }
  },
  created() {
    this.$store.dispatch('getProvinces')
    this.$store.dispatch('getActivities')
    this.$store.dispatch('getProdLines')
  },
  methods: {
    changeForm(value){
      this.showActivity = value
      if (!value) {
        this.$store.dispatch('getTracings')
      }
    },
    saveTracing(){
      let me = this
      axios.post('saveTracing', this.formCreate)
      .then(res => {
        me.$swal({
          position: 'top',
          icon: 'success',
          title: res.data.message,
          showConfirmButton: true,
          confirmButtonText: 'Aceptar'
          //timer: 1500
        })
        me.$store.dispatch('getTracings')
        me.formActivity.tracing = res.data.data
        me.changeForm(false)
        console.log(res)
      })
      .catch(err => {
        console.error(err);
      })
    },
    getMunicipalities(){
      let me = this
      me.formCreate.municipality_id = ""
      axios.get('municipalities', {
        params: {
          id: me.formCreate.province_id
        }
      })
      .then(res => {
        me.allMunicipalities = res.data
        console.log(res);
      })
    },
    selectActivity(){
      let me = this
      me.formActivity.activity_id = me.formActivity.activity.id
      if (me.formActivity.activity.phytosanitary_limitation_status) {
        me.showStatus = true
      }else{
        me.showStatus = false
      }
    }
  },
}
</script>
<style lang="scss">
  .vs_select_custom .vs__dropdown-toggle {
    height: calc(1.6em + 0.75rem + 2px);
  }
</style>

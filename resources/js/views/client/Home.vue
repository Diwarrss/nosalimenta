<template>
  <div class="col-md-12 form_cliente">
    <!-- Options -->
    <section>
      <button class="btn btn-success" @click.prevent="changeForm('create')"><i class="fa fa-file-text-o" aria-hidden="true"></i> Crear Seguimiento</button>
      <button class="btn btn-primary" @click.prevent="changeForm('addActivity')"><i class="fa fa-plus-circle" aria-hidden="true"></i> Agregar Actividad</button>
      <button class="btn btn-info" @click.prevent="changeForm('search')"><i class="fa fa-list" aria-hidden="true"></i> Actividades del Seguimiento</button>
    </section>
    <!-- Show forms -->
    <section class="my-3">
      <div class="row">
        <div v-if="showActivity === 'create'" class="col-md-12">
          <div class="card">
            <div class="card-header">
              <i class="fa fa-list-alt" aria-hidden="true"></i> Crear Seguimiento
            </div>
            <div class="card-body">
              <form>
                <div class="form-row">
                  <div class="form-group col-md-4">
                    <label class="font-weight-bold" for="inputProvince">Provincia</label>
                    <select
                      v-model="formCreate.province_id"
                        id="inputProvince"
                        class="form-control"
                        :class="{'is-invalid': $v.formCreate.province_id.$error }"
                        @change="getMunicipalities()">
                      <option selected value="">Seleccionar...</option>
                      <option :value="item.id" v-for="(item, index) in allProvinces" :key="index">
                        {{item.name}}
                      </option>
                    </select>
                    <template v-if="$v.formCreate.province_id.$error">
                      <div class="invalid-feedback" v-if="!$v.formCreate.province_id.required">
                        Seleccione una Provincia
                      </div>
                    </template>
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
                    <input
                      v-model="formCreate.identification"
                      type="text"
                      class="form-control"
                      :class="{'is-invalid': $v.formCreate.identification.$error }"
                      id="inputIdent">
                    <template v-if="$v.formCreate.identification.$error">
                      <div class="invalid-feedback" v-if="!$v.formCreate.identification.required">
                        Digite el No. Identificación
                      </div>
                      <div class="invalid-feedback" v-if="!$v.formCreate.identification.minLength">
                        Máximo 15 dígitos
                      </div>
                    </template>
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
        <div v-else-if="showActivity === 'addActivity'" class="col-md-12">
          <div class="card" v-if="allTracings.length">
            <div class="card-header">
              <i class="fa fa-list-ol" aria-hidden="true"></i> Agregar Actividad
            </div>
            <div class="card-body">
              <form>
                <div class="form-row">
                  <div class="form-group col-md-4" v-if="allTracings.length">
                    <label class="font-weight-bold" for="inputProvince">Seguimiento</label>
                    <v-select
                      :reduce="tracing => tracing.id"
                      v-model="formActivity.tracing_id"
                      :options="allTracings"
                      label="identification"
                      placeholder="Seleccionar Productor"
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
                    <select v-model="activity" @change="selectActivity()" id="activity" class="form-control">
                      <option selected value="" disabled>Seleccionar...</option>
                      <option :value="item" v-for="(item, index) in allActivities" :key="index">
                        {{item.name}}
                      </option>
                    </select>
                  </div>
                  <div class="form-group col-md-4" v-if="showDescription">
                    <label class="font-weight-bold" for="date">Fecha</label>
                    <input v-model="formActivity.date_performed" class="form-control" type="date" id="date">
                  </div>
                  <div class="form-group col-md-2" v-if="showDescription">
                    <label class="font-weight-bold" for="date">Mano de obra</label>
                    <input v-model="formActivity.employees" class="form-control" type="number" id="date">
                  </div>
                  <div class="form-group col-md-4" v-if="phytosanitaryLimitationStatus">
                    <label class="font-weight-bold" for="inputphylimi">Limitantes Fitosanitarias <span class="text_limit font-weight-light">(Plaga, Arvense, Enfermedad)</span></label>
                    <input v-model="formActivity.phytosanitary_limitation" type="text" class="form-control" id="inputphylimi">
                  </div>
                  <div class="form-group col-md-2" v-if="doseStatus">
                    <label class="font-weight-bold" for="inputdose">Dosis <span class="font-weight-light">{{activity.dose_unity ? `(${activity.dose_unity})` : ''}}</span></label>
                    <input v-model="formActivity.dose" type="number" class="form-control" id="inputdose">
                  </div>
                  <div class="form-group col-md-4" v-if="productStatus">
                    <label class="font-weight-bold" for="inputproduct">Producto <span class="font-weight-light">(Nombre)</span></label>
                    <input v-model="formActivity.product" type="text" class="form-control" id="inputproduct">
                  </div>
                  <div class="form-group col-md-2" v-if="quantityStatus">
                    <label class="font-weight-bold" for="inputquantity">Total Producto <span class="font-weight-light">{{activity.quantity_unity ? `(${activity.quantity_unity})` : ''}}</span></label>
                    <input v-model="formActivity.quantity" type="number" class="form-control" id="inputquantity">
                  </div>
                  <div class="form-group col-md-2" v-if="showTipo">
                    <label class="font-weight-bold" for="Metod">Metodo </label>
                    <select  v-model="formActivity.metod" id="Metod" class="form-control">
                      <option selected value="" disabled>Seleccionar...</option>
                      <option selected value="Manual">Manual</option>
                      <option selected value="Mecánico">Mecánico</option>
                    </select>
                  </div>
                  <div class="form-group col-md-12" v-if="showDescription">
                    <label class="font-weight-bold" for="inputphone">Descripción</label>
                    <textarea v-model="formActivity.description" class="form-control" id="imputdesc" cols="12" rows="3"></textarea>
                  </div>
                </div>
              </form>
            </div>
            <div class="card-footer text-right">
              <button type="submit" @click.prevent="saveActivity()" class="btn btn-success"><i class="fa fa-plus-square" aria-hidden="true"></i> Agregar</button>
            </div>
          </div>
        </div>
        <div v-else class="col-md-12">
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
                    v-model="formActivity.tracing_id"
                    class="vs_select_custom"
                    >
                    <template v-slot:option="option">
                      {{ option.identification }} - {{option.producer}}
                    </template>
                    <div slot="no-options">No hay Resultados!</div>
                  </v-select>
                </div>
              </div>
              <div>
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">First</th>
                      <th scope="col">Last</th>
                      <th scope="col">Handle</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <th scope="row">1</th>
                      <td>Mark</td>
                      <td>Otto</td>
                      <td>@mdo</td>
                    </tr>
                    <tr>
                      <th scope="row">2</th>
                      <td>Jacob</td>
                      <td>Thornton</td>
                      <td>@fat</td>
                    </tr>
                    <tr>
                      <th scope="row">3</th>
                      <td>Larry</td>
                      <td>the Bird</td>
                      <td>@twitter</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>
<script>
import { required, minLength, maxLength, integer } from 'vuelidate/lib/validators'
export default {
  data() {
    return {
      showActivity: 'create',
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
        date_performed: '',
        phytosanitary_limitation: '',
        employees: 0,
        dose: '',
        dose_type: '',
        product: '',
        quantity: 0,
        measure_type: '',
        description: '',
        images: '',
        metod: '',
        tracing_id: '',
        activity_id: '',
      },
      activity: '',
      showDescription: false,
      doseStatus: false,
      phytosanitaryLimitationStatus: false,
      productStatus: false,
      quantityStatus: false,
      showTipo: false
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
  validations: {
    formCreate: {
      province_id: {
        required
      },
      municipality_id: {
        required
      },
      zone: {
        required
      },
      producer: {
        required
      },
      identification: {
        required,
        maxLength: maxLength(15)
      },
      phone: {
        required,
        minLength: minLength(10),
        maxLength: maxLength(10)
      },
      production_line_id: {
        required
      }
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
      if (value !== 'create') {
        this.$store.dispatch('getTracings')
      }
    },
    saveTracing(){
      let me = this
      me.$v.$touch()
      if (!this.$v.$invalid) {
        axios.post('saveTracing', me.formCreate)
        .then(res => {
          me.$swal({
            position: 'top',
            icon: 'success',
            title: res.data.message,
            showConfirmButton: true,
            confirmButtonText: 'Aceptar',
            timer: 1500
          })
          me.$store.dispatch('getTracings')
          me.formActivity.tracing_id = res.data.data.id
          me.resetForm('tracing')
          me.changeForm('addActivity')
          console.log(res)
        })
        .catch(err => {
          console.error(err);
        })
      }else{
        me.$swal({
          position: 'top',
          icon: 'error',
          title: 'Error en el formulario',
          showConfirmButton: true,
          confirmButtonText: 'Aceptar',
          timer: 1500
        })
      }
    },
    saveActivity(){
      let me = this
      axios.post('saveActivity', me.formActivity)
      .then(res => {
        me.$swal({
          position: 'top',
          icon: 'success',
          title: res.data.message,
          showConfirmButton: true,
          confirmButtonText: 'Aceptar',
          timer: 1500
        })
        me.resetForm('activity')
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
        //console.log(res);
      })
    },
    selectActivity(){
      let me = this
      me.formActivity.activity_id = me.activity.id
      me.formActivity.dose_type = me.activity.dose_unity
      me.formActivity.measure_type = me.activity.quantity_unity

      if (me.formActivity.activity_id) {
        me.showDescription = true
        me.showDatePerformed = true
      }else{
        me.showDescription = false
        me.showDatePerformed = false
      }
      if (me.activity.id === 2) {
        me.showTipo = true
      }else{
        me.showTipo = false
      }
      if (me.activity.phytosanitary_limitation_status) {
        me.phytosanitaryLimitationStatus = true
      }else{
        me.phytosanitaryLimitationStatus = false
      }
      if (me.activity.product_status) {
        me.productStatus = true
      }else{
        me.productStatus = false
      }
      if (me.activity.quantity_status) {
        me.quantityStatus = true
      }else{
        me.quantityStatus = false
      }
      if (me.activity.dose_status) {
        me.doseStatus = true
      }else{
        me.doseStatus = false
      }
    },
    resetForm(value){
      if (value === 'tracing') {
        this.formCreate.municipality_id = ''
        this.formCreate.zone = ''
        this.formCreate.province_id = ''
        this.formCreate.producer = ''
        this.formCreate.identification = ''
        this.formCreate.phone = ''
        this.formCreate.production_line_id = ''
      }
      if (value === 'activity') {
        this.activity = ''
        this.showDescription = false
        this.doseStatus = false
        this.phytosanitaryLimitationStatus = false
        this.productStatus = false
        this.quantityStatus = false
        this.showTipo = false
        this.formActivity.date_performed = ''
        this.formActivity.phytosanitary_limitation = ''
        this.formActivity.employees = 0
        this.formActivity.dose = ''
        this.formActivity.dose_type = ''
        this.formActivity.product = ''
        this.formActivity.quantity = 0
        this.formActivity.measure_type = ''
        this.formActivity.description = ''
        this.formActivity.images = ''
        this.formActivity.metod = ''
        this.formActivity.tracing_id = ''
        this.formActivity.activity_id = ''
      }
    }
  },
}
</script>
<style lang="scss">
.form_cliente{
  .text_limit{
    font-size: 11px;
  }
}
  .vs_select_custom .vs__dropdown-toggle {
    height: calc(1.6em + 0.75rem + 2px);
  }

</style>

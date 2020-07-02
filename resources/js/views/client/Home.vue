<template>
  <div class="col-md-12 form_cliente" v-if="user">
    <!-- Options -->
    <section class="container">
      <button class="m-2 btn btn-success" @click.prevent="changeForm('seeTracings')" v-if="user.rol_id === 1">
        <i class="fa fa-file-text-o" aria-hidden="true"></i> Seguimientos
      </button>
      <button class="m-2 btn btn-success" @click.prevent="changeForm('create')">
        <i class="fa fa-file-text-o" aria-hidden="true"></i> Crear Seguimiento
      </button>
      <button class="m-2 btn btn-primary" @click.prevent="changeForm('addActivity')">
        <i class="fa fa-plus-circle" aria-hidden="true"></i> Agregar Actividad
      </button>
      <button class="m-2 btn btn-info" @click.prevent="changeForm('search')">
        <i class="fa fa-list" aria-hidden="true"></i> Actividades del Seguimiento
      </button>
    </section>
    <!-- Show forms -->
    <section class="my-3">
      <div class="row">
        <div v-if="showActivity === 'seeTracings'" class="col-md-12">
          <SeeTracings/>
        </div>
        <div v-else-if="showActivity === 'create'" class="container">
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
                    <select
                      v-model="formCreate.municipality_id"
                        id="inputMunicipality"
                        class="form-control"
                        :class="{'is-invalid': $v.formCreate.municipality_id.$error }">
                      <option selected value="">Seleccionar...</option>
                      <option :value="item.id" v-for="(item, index) in allMunicipalities" :key="index">
                        {{item.name}}
                      </option>
                    </select>
                    <template v-if="$v.formCreate.municipality_id.$error">
                      <div class="invalid-feedback" v-if="!$v.formCreate.municipality_id.required">
                        Seleccione un Municipio
                      </div>
                    </template>
                  </div>
                  <div class="form-group col-md-4">
                    <label class="font-weight-bold" for="inputZone">Vereda</label>
                    <input
                      v-model="formCreate.zone"
                        @input="formCreate.zone = $event.target.value.toUpperCase()"
                        type="text"
                        class="form-control"
                        id="inputZone"
                        :class="{'is-invalid': $v.formCreate.zone.$error }">
                    <template v-if="$v.formCreate.zone.$error">
                      <div class="invalid-feedback" v-if="!$v.formCreate.zone.required">
                        Digite la Vereda
                      </div>
                    </template>
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
                      <div class="invalid-feedback" v-else-if="!$v.formCreate.identification.maxLength">
                        Máximo 15 dígitos
                      </div>
                    </template>
                  </div>
                  <div class="form-group col-md-5">
                    <label class="font-weight-bold" for="inputName">Nombres y Apellidos <span class="font-weight-light">(Productor)</span></label>
                    <input
                      v-model="formCreate.producer"
                      @input="formCreate.producer = $event.target.value.toUpperCase()"
                      type="text"
                      class="form-control"
                      :class="{'is-invalid': $v.formCreate.producer.$error }"
                      id="inputName"
                      >
                    <template v-if="$v.formCreate.producer.$error">
                      <div class="invalid-feedback" v-if="!$v.formCreate.producer.required">
                        Digite Nombres y Apellidos
                      </div>
                    </template>
                  </div>
                  <div class="form-group col-md-3">
                    <label class="font-weight-bold" for="inputphone">Celular</label>
                    <input
                      v-model="formCreate.phone"
                      type="text"
                      class="form-control"
                      :class="{'is-invalid': $v.formCreate.phone.$error }"
                      id="inputphone">
                    <template v-if="$v.formCreate.phone.$error">
                      <div class="invalid-feedback" v-if="!$v.formCreate.phone.required">
                        Digite el No. Celular
                      </div>
                      <div class="invalid-feedback" v-else-if="!$v.formCreate.phone.maxLength">
                        Máximo 15 dígitos
                      </div>
                      <div class="invalid-feedback" v-else-if="!$v.formCreate.phone.minLength">
                        Mínimo 15 dígitos
                      </div>
                    </template>
                  </div>
                  <div class="form-group col-md-4">
                    <label class="font-weight-bold" for="inputProdLine">Linea de producción</label>
                    <select
                      v-model="formCreate.production_line_id"
                      id="inputProdLine"
                      class="form-control"
                      :class="{'is-invalid': $v.formCreate.production_line_id.$error }">
                      <option selected value="">Seleccionar...</option>
                      <option :value="item.id" v-for="(item, index) in allProdLines" :key="index">
                        {{item.name}}
                      </option>
                    </select>
                    <template v-if="$v.formCreate.production_line_id.$error">
                      <div class="invalid-feedback" v-if="!$v.formCreate.production_line_id.required">
                        Seleccione la Linea de Producción
                      </div>
                    </template>
                  </div>
                </div>
              </form>
            </div>
            <div class="card-footer text-right">
              <button @click.prevent="saveTracing" class="btn btn-success"><i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar</button>
            </div>
          </div>
        </div>
        <div v-else-if="showActivity === 'addActivity'" class="container">
          <AddActivity :tracingId="tracing_id"/>
        </div>
        <div v-else class="col-md-12">
          <SeeActivity/>
        </div>
      </div>
    </section>
  </div>
</template>
<script>
import AddActivity from '../../Components/AddActivity'
import SeeActivity from '../../Components/SeeActivity'
import SeeTracings from '../../Components/SeeTracings'
import { required, minLength, maxLength, integer } from 'vuelidate/lib/validators'
export default {
  components: {AddActivity, SeeActivity, SeeTracings},
  data() {
    return {
      user: '',
      showActivity: '',
      formCreate:{
        province_id: '',
        municipality_id: '',
        zone: '',
        producer: '',
        identification: '',
        phone: '',
        production_line_id: ''
      },
      tracing_id: 0
    }
  },
  computed: {
    /* showActivity(e){
      if (e) {
        return e
      }else{
        return this.user.rol_id == 1 ? 'seeTracings' : 'create'
      }
    }, */
    /* user(){
      return this.$store.state.user
    }, */
    allTracings(){
      return this.$store.state.allTracings
    },
    allProvinces(){
      return this.$store.state.allProvinces
    },
    allProdLines(){
      return this.$store.state.allProdLines
    },
    allMunicipalities(){
      return  this.$store.state.allMunicipalities
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
  /* beforeCreate(){
    this.$store.dispatch('getUser')
  }, */
  created() {
    /* this.$store.dispatch('getUser') */
    /* setTimeout(() => {
      if (this.user.rol_id === 1) {
        this.showActivity = 'seeTracings'
      }else{
        this.showActivity = 'create'
      }
    }, 500); */
    this.$store.dispatch('getProvinces')
    this.$store.dispatch('getProdLines')

    axios.get('user')
    .then(res => {
      this.user = res.data
      let user = res.data
      if (user.rol_id === 1) {
        this.showActivity = 'seeTracings'
        /* this.changeForm('seeTracings') */
      }else{
        this.showActivity = 'create'
        /* this.changeForm('create') */
      }
      console.log(res)
    })
    .catch(err => {
      console.error(err);
    })
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
          me.tracing_id = res.data.data.id
          me.resetForm()
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
    getMunicipalities(){
      let me = this
      me.formCreate.municipality_id = ""
      me.$store.dispatch('getMunicipalities', me.formCreate.province_id)
    },
    resetForm(){
      this.formCreate.municipality_id = ''
      this.formCreate.zone = ''
      this.formCreate.province_id = ''
      this.formCreate.producer = ''
      this.formCreate.identification = ''
      this.formCreate.phone = ''
      this.formCreate.production_line_id = ''
    }
  }
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

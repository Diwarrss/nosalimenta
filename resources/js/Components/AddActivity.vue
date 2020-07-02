<template>
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
              :class="{'is-invalid': $v.formActivity.tracing_id.$error }"
              >
              <template v-slot:option="option">
                {{ option.identification }} - {{option.producer}}
              </template>
              <div slot="no-options">No hay Resultados!</div>
            </v-select>
            <template v-if="$v.formActivity.tracing_id.$error">
              <div class="invalid-feedback" v-if="!$v.formActivity.tracing_id.required">
                Seleccione el Segumiento
              </div>
            </template>
          </div>
          <div class="form-group col-md-8">
            <label class="font-weight-bold" for="activity">Actividad</label>
            <select
              v-model="activity"
              @change="selectActivity()"
              id="activity"
              class="form-control"
              :class="{'is-invalid': $v.formActivity.activity_id.$error }">
              <option selected value="" disabled>Seleccionar...</option>
              <option :value="item" v-for="(item, index) in allActivities" :key="index">
                {{item.name}}
              </option>
            </select>
            <template v-if="$v.formActivity.activity_id.$error">
              <div class="invalid-feedback" v-if="!$v.formActivity.activity_id.required">
                Seleccione la Actividad
              </div>
            </template>
          </div>
          <div class="form-group col-md-4" v-if="showDescription">
            <label class="font-weight-bold" for="date">Fecha</label>
            <input
            v-model="formActivity.date_performed"
            class="form-control"
            :class="{'is-invalid': $v.formActivity.date_performed.$error }"
            type="date"
            id="date">
            <template v-if="$v.formActivity.date_performed.$error">
              <div class="invalid-feedback" v-if="!$v.formActivity.date_performed.required">
                Seleccione la Fecha
              </div>
            </template>
          </div>
          <div class="form-group col-md-2" v-if="showTipo">
            <label class="font-weight-bold" for="Metod">Metodo </label>
            <select
              v-model="formActivity.metod"
              id="Metod"
              class="form-control"
              :class="{'is-invalid': $v.formActivity.metod.$error }">
              <option selected value="" disabled>Seleccionar...</option>
              <option selected value="Manual">Manual</option>
              <option selected value="Mecánico">Mecánico</option>
            </select>
            <template v-if="$v.formActivity.metod.$error">
              <div class="invalid-feedback" v-if="!$v.formActivity.metod.required">
                Seleccione el Metodo
              </div>
            </template>
          </div>
          <div class="form-group col-md-2" v-if="showDescription">
            <label class="font-weight-bold" for="date">Mano de obra</label>
            <input
              v-model="formActivity.employees"
              class="form-control"
              :class="{'is-invalid': $v.formActivity.employees.$error }"
              type="number"
              id="date">
            <template v-if="$v.formActivity.employees.$error">
              <div class="invalid-feedback" v-if="!$v.formActivity.employees.required">
                Digite Mano de Obra
              </div>
            </template>
          </div>
          <div class="form-group col-md-4" v-if="phytosanitaryLimitationStatus">
            <label class="font-weight-bold" for="inputphylimi">Limitantes Fitosanitarias <span class="text_limit font-weight-light">(Plaga, Arvense, Enfermedad)</span></label>
            <input
              v-model="formActivity.phytosanitary_limitation"
              type="text"
              class="form-control"
              :class="{'is-invalid': $v.formActivity.phytosanitary_limitation.$error }"
              id="inputphylimi">
            <template v-if="$v.formActivity.phytosanitary_limitation.$error">
              <div class="invalid-feedback" v-if="!$v.formActivity.phytosanitary_limitation.required">
                Digite las Limitantes Fitosanitarias
              </div>
            </template>
          </div>
          <div class="form-group col-md-2" v-if="doseStatus">
            <label class="font-weight-bold" for="inputdose">Dosis <span class="text_limit font-weight-light">{{activity.dose_unity ? `(${activity.dose_unity})` : ''}}</span></label>
            <input
              v-model="formActivity.dose"
              type="number"
              class="form-control"
              :class="{'is-invalid': $v.formActivity.dose.$error }"
              id="inputdose">
            <template v-if="$v.formActivity.dose.$error">
              <div class="invalid-feedback" v-if="!$v.formActivity.dose.required">
                Digite la Dosis
              </div>
            </template>
          </div>
          <div class="form-group col-md-4" v-if="productStatus">
            <label class="font-weight-bold" for="inputproduct">Producto <span class="font-weight-light">(Nombre)</span></label>
            <input
              v-model="formActivity.product"
              type="text"
              class="form-control"
              :class="{'is-invalid': $v.formActivity.product.$error }"
              id="inputproduct">
            <template v-if="$v.formActivity.product.$error">
              <div class="invalid-feedback" v-if="!$v.formActivity.product.required">
                Digite el Producto
              </div>
            </template>
          </div>
          <div class="form-group col-md-2" v-if="quantityStatus">
            <label class="font-weight-bold" for="inputquantity">Total Producto <span class="font-weight-light">{{activity.quantity_unity ? `(${activity.quantity_unity})` : ''}}</span></label>
            <input
              v-model="formActivity.quantity"
              type="number"
              class="form-control"
              :class="{'is-invalid': $v.formActivity.quantity.$error }"
              id="inputquantity">
            <template v-if="$v.formActivity.quantity.$error">
              <div class="invalid-feedback" v-if="!$v.formActivity.quantity.required">
                Digite la Cantidad Total
              </div>
            </template>
          </div>
          <div class="form-group col-md-12" v-if="showDescription">
            <label class="font-weight-bold" for="inputphone">Descripción</label>
            <textarea
              v-model="formActivity.description"
              class="form-control"
              :class="{'is-invalid': $v.formActivity.description.$error }"
              id="imputdesc"
              cols="12"
              rows="3">
            </textarea>
            <template v-if="$v.formActivity.description.$error">
              <div class="invalid-feedback" v-if="!$v.formActivity.description.required">
                Digite la Cantidad Total
              </div>
            </template>
          </div>
        </div>
      </form>
    </div>
    <div class="card-footer text-right" v-if="formActivity.tracing_id != 0 || formActivity.tracing_id ">
      <button type="submit" @click.prevent="saveActivity()" class="btn btn-success"><i class="fa fa-plus-square" aria-hidden="true"></i> Agregar</button>
    </div>
  </div>
</template>
<script>
import { required, minLength, maxLength, integer } from 'vuelidate/lib/validators'
export default {
  props:{
    tracingId: Number
  },
  data(){
    return {
      formActivity:{
        date_performed: '',
        phytosanitary_limitation: '',
        employees: '',
        dose: '',
        dose_type: '',
        product: '',
        quantity: '',
        measure_type: '',
        description: '',
        images: '',
        metod: '',
        tracing_id: this.tracingId,
        activity_id: '',
      },
      activity: '',
      showDescription: false,
      doseStatus: false,
      phytosanitaryLimitationStatus: false,
      productStatus: false,
      quantityStatus: false,
      showTipo: false,
    }

  },
  validations() {
    let formActivity = {
      formActivity: {
        date_performed: {
          required
        },
        employees:{
          required,
        },
        tracing_id: {
          required,
        },
        activity_id: {
          required,
        },
        description: {
          required,
        }
      }
    }
    if ((!this.showTipo) && (!this.phytosanitaryLimitationStatus) && (this.productStatus) && (!this.doseStatus) && (this.quantityStatus)) {
      formActivity = {
        formActivity: {
          ...formActivity.formActivity,
          product: {
            required,
          },
          quantity: {
            required,
          },
          measure_type: {
            required,
          }
        }
      }
      return formActivity
    }
    else if ((!this.showTipo) && (!this.phytosanitaryLimitationStatus) && (this.productStatus) && (this.doseStatus) && (this.quantityStatus)) {
      formActivity = {
        formActivity: {
          ...formActivity.formActivity,
          product: {
            required,
          },
          dose: {
            required,
          },
          dose_type: {
            required,
          },
          quantity: {
            required,
          },
          measure_type: {
            required,
          }
        }
      }
      return formActivity
    }
    else if ((!this.showTipo) && (this.phytosanitaryLimitationStatus) && (this.productStatus) && (this.doseStatus) && (this.quantityStatus)) {
      formActivity = {
        formActivity: {
          ...formActivity.formActivity,
          product: {
            required,
          },
          dose: {
            required,
          },
          dose_type: {
            required,
          },
          quantity: {
            required,
          },
          measure_type: {
            required,
          },
          phytosanitary_limitation: {
            required,
          }
        }
      }
      return formActivity
    }
    else if ((!this.showTipo) && (!this.phytosanitaryLimitationStatus) && (!this.productStatus) && (!this.doseStatus) && (this.quantityStatus)) {
      formActivity = {
        formActivity: {
          ...formActivity.formActivity,
          quantity: {
            required,
          },
          measure_type: {
            required,
          }
        }
      }
      return formActivity
    }
    else if ((this.showTipo) && (!this.phytosanitaryLimitationStatus) && (this.productStatus) && (!this.doseStatus) && (this.quantityStatus)) {
      formActivity = {
        formActivity: {
          ...formActivity.formActivity,
          metod: {
            required,
          },
          product: {
            required,
          },
          quantity: {
            required,
          },
          measure_type: {
            required,
          }
        }
      }
      return formActivity
    }
    else {
      return formActivity
    }
  },
  computed: {
    allTracings(){
      return this.$store.state.allTracings
    },
    allActivities(){
      return this.$store.state.allActivities
    }
  },
  created() {
    this.$store.dispatch('getProvinces')
    this.$store.dispatch('getActivities')
  },
  watch: {
    /* cuando la variable sea afectada o tenga algun cambio ejecuta el proceso */
    /* tracingId(){
      this.formActivity.tracing_id = this.tracingId
    } */
  },
  methods: {
    saveActivity(){
      let me = this
      me.$v.$touch()
      if (!this.$v.$invalid) {
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
          me.resetForm()
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
    selectActivity(){
      let me = this
      me.formActivity.activity_id = me.activity.id
      me.formActivity.dose_type = me.activity.dose_unity
      me.formActivity.measure_type = me.activity.quantity_unity

      if (me.formActivity.activity_id) {
        me.showDescription = true
      }else{
        me.showDescription = false
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
    resetForm(){
      this.activity = ''
      this.showDescription = false
      this.doseStatus = false
      this.phytosanitaryLimitationStatus = false
      this.productStatus = false
      this.quantityStatus = false
      this.showTipo = false
      this.formActivity.date_performed = ''
      this.formActivity.phytosanitary_limitation = ''
      this.formActivity.employees = ''
      this.formActivity.dose = ''
      this.formActivity.dose_type = ''
      this.formActivity.product = ''
      this.formActivity.quantity = ''
      this.formActivity.measure_type = ''
      this.formActivity.description = ''
      this.formActivity.images = ''
      this.formActivity.metod = ''
      this.formActivity.tracing_id = ''
      this.formActivity.activity_id = ''
    }
  }
}
</script>
<style lang="scss">
  .vs_select_custom .vs__dropdown-toggle {
    height: calc(1.6em + 0.75rem + 2px);
  }
</style>

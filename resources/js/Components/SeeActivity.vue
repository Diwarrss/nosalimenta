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
              <th scope="col">Visita Técnica</th>
              <th scope="col">Metodo</th>
              <th scope="col">Imágenes</th>
              <th scope="col">Acciones</th>
            </tr>
          </thead>
          <tbody class="body_table">
            <tr v-if="!allDevelopedActivities.developed_activities.length">
              <td colspan="12">
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
              <th>{{ item.technical_visit ? item.technical_visit : 'N/A'}}</th>
              <th>{{ item.metod ? item.metod : 'N/A'}}</th>
              <th>
                <div class="block">
                  <el-carousel height="60px" arrow="never">
                    <el-carousel-item v-for="(image, indexImage) in item.activity_image" :key="indexImage">
                      <img @click="openModal(item.activity_image)" :src="urlHost+'/uploads/'+image.image_path" class="img-fluid">
                    </el-carousel-item>
                  </el-carousel>
                </div>
              </th>
              <th>
                <button class="btn btn-info" @click="infoModal(item, index, true)"><i class="fa fa-eye" aria-hidden="true"></i> Ver</button>
                <button class="btn btn-warning" @click="infoModal(item, index, false)"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</button>
                <button class="btn btn-danger" @click="deletefiel(item)"><i class="fa fa-trash" aria-hidden="true"></i> Eliminar</button>
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
              <el-carousel height="500px">
                <el-carousel-item v-for="(img, i) in listImages" :key="i">
                  <img :src="urlHost+'/uploads/'+img.image_path" class="img-fluid">
                </el-carousel-item>
              </el-carousel>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- info modal -->
    <div class="modal" id="modal-view" tabindex="-1" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" v-if="viewOnlly"><i class="fa fa-eye" aria-hidden="true"></i> {{ tittleModal }}</h5>
            <h5 class="modal-title" v-else><i class="fa fa-pencil-square-o" aria-hidden="true"></i> {{ tittleModal }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <b-form @submit="saveData" v-if="show" class="was-validated">
              <div class="mb-3">
                <label class="form-group" for="date">Fecha</label>
                <input
                v-model="form.date_performed"
                :disabled="viewOnlly ? true : false"
                class="form-control"
                type="date"
                id="date"
                required>
                <div class="invalid-feedback">
                  Seleccione la fecha
                </div>
              </div>


              <!-- <div>
                <label for="example-input">Fecha:</label>
                <b-input-group class="mb-3">
                  <b-form-input
                    id="example-input"
                    v-model="form.date_performed"
                    type="text"
                    placeholder="YYYY-MM-DD"
                    autocomplete="off"
                  ></b-form-input>
                  <b-input-group-append>
                    <b-form-datepicker
                      v-model="form.date_performed"
                      button-only
                      right
                      locale="en-US"
                      aria-controls="example-input"
                      @context="onContext"
                    ></b-form-datepicker>
                  </b-input-group-append>
                </b-input-group>
              </div> -->

              <!-- <div>
                <label for="input-date">Fecha</label>
                <b-form-datepicker id="input-date" v-model="form.date_performed" class="mb-2"></b-form-datepicker>
              </div> -->

              <b-form-group v-if="showTipo" id="input-group-metod" label="Metodo:" label-for="input-metod">
                <b-form-select
                  id="input-metod"
                  :disabled="viewOnlly ? true : false"
                  v-model="form.metod"
                  required>
                <b-form-select-option :value="null">Seleccionar...</b-form-select-option>
                <b-form-select-option :value="'Manual'">Manual</b-form-select-option>
                <b-form-select-option :value="'Mecánico'">Mecánico</b-form-select-option>
                </b-form-select>
                <div class="invalid-feedback">
                  Seleccione el método
                </div>
              </b-form-group>

              <b-form-group id="input-group-employees" label="Mano de obra:" label-for="input-employees">
                <b-form-input
                  id="input-employees"
                  :disabled="viewOnlly ? true : false"
                  v-model="form.employees"
                  placeholder="Cantidad mano de obra"
                  required
                ></b-form-input>
                <div class="invalid-feedback">
                  Digite la mano de obra
                </div>
              </b-form-group>

              <b-form-group id="input-group-technical_visit" label="Visita Técnica:" label-for="input-technical_visit">
                <b-form-select
                  id="input-technical_visit"
                  :disabled="viewOnlly ? true : false"
                  v-model="form.technical_visit"
                  required>
                <b-form-select-option :value="null">Seleccionar...</b-form-select-option>
                <b-form-select-option :value="'Si'">Si</b-form-select-option>
                <b-form-select-option :value="'No'">No</b-form-select-option>
                </b-form-select>
                <div class="invalid-feedback">
                  Seleccione la visita técnica
                </div>
              </b-form-group>

              <b-form-group v-if="phytosanitaryLimitationStatus" id="input-group-phytosanitary_limitation" label="Limitantes fitosanitarias:" label-for="input-phytosanitary_limitation">
                <b-form-input
                  id="input-phytosanitary_limitation"
                  :disabled="viewOnlly ? true : false"
                  v-model="form.phytosanitary_limitation"
                  placeholder="Nombre limitantes fitosanitarias"
                  required
                ></b-form-input>
                <div class="invalid-feedback">
                  Digite limitantes fitosanitarias
                </div>
              </b-form-group>

              <b-form-group v-if="doseStatus" id="input-group-dose" label="Dosis:" label-for="input-dose">
                <b-form-input
                  id="input-dose"
                  :disabled="viewOnlly ? true : false"
                  v-model="form.dose"
                  placeholder="Dosis usada"
                  required
                ></b-form-input>
                <div class="invalid-feedback">
                  Digite dosis
                </div>
              </b-form-group>

              <b-form-group v-if="productStatus" id="input-group-product" label="Producto:" label-for="input-product">
                <b-form-input
                  id="input-product"
                  :disabled="viewOnlly ? true : false"
                  v-model="form.product"
                  placeholder="Nombre del producto"
                  required
                ></b-form-input>
                <div class="invalid-feedback">
                  Digite el producto
                </div>
              </b-form-group>

              <b-form-group v-if="quantityStatus" id="input-group-quantity" label="Cantidad:" label-for="input-quantity">
                <b-form-input
                  id="input-quantity"
                  :disabled="viewOnlly ? true : false"
                  v-model="form.quantity"
                  placeholder="Cantidad del producto"
                  required
                ></b-form-input>
                <div class="invalid-feedback">
                  Digite la cantidad de producto
                </div>
              </b-form-group>

              <b-form-group id="input-group-description" label="Descripción:" label-for="input-description">
                <b-form-textarea
                  id="input-description"
                  :disabled="viewOnlly ? true : false"
                  v-model="form.description"
                  placeholder="Descripción de la actividad"
                  rows="3"
                  max-rows="6"
                  required
                ></b-form-textarea>
                <div class="invalid-feedback">
                  Digite la descripción
                </div>
              </b-form-group>
              <div
                v-if="!viewOnlly"
                class="text-center">
                <b-button
                  type="submit"
                  variant="success"><i class="fa fa-refresh" aria-hidden="true"></i> Actualizar</b-button>
                <b-button
                  variant="danger"
                  @click="hideModal"><i class="fa fa-times-circle" aria-hidden="true"></i> Cancelar</b-button>
              </div>
              <!-- <b-button type="submit" variant="primary">Submit</b-button>
              <b-button type="reset" variant="danger">Reset</b-button> -->
            </b-form>
          </div>
          <!-- <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
          </div> -->
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
      listImages: [],
      form: {
        modal: 'modal-view',
        id: null,
        date_performed: null,
        phytosanitary_limitation: null,
        employees: null,
        dose: null,
        dose_type: null,
        product: null,
        quantity: null,
        measure_type: null,
        description: null,
        metod: null,
        technical_visit: null,
      },
      tittleModal: null,
      viewOnlly: false,
      show: true,
      doseStatus: false,
      phytosanitaryLimitationStatus: false,
      productStatus: false,
      quantityStatus: false,
      showTipo: false,
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
    },
    infoModal(item, index, view) {
      console.log(item)
      console.log(index)
      let me = this
      if (view) {
        me.tittleModal = 'Ver ' + item.activity.name
        me.viewOnlly = true
      } else {
        me.viewOnlly = false
        me.tittleModal = 'Editar ' + item.activity.name
      }
      me.form.id = item.id
      me.form.date_performed = item.date_performed
      me.form.phytosanitary_limitation = item.phytosanitary_limitation
      me.form.employees = item.employees
      me.form.dose = item.dose
      me.form.dose_type = item.dose_type
      me.form.product = item.product
      me.form.quantity = item.quantity
      me.form.measure_type = item.measure_type
      me.form.description = item.description
      me.form.metod = item.metod
      me.form.technical_visit = item.technical_visit
      if (item.activity.id === 2) {
        me.showTipo = true
      }else{
        me.showTipo = false
      }
      if (item.activity.phytosanitary_limitation_status) {
        me.phytosanitaryLimitationStatus = true
      }else{
        me.phytosanitaryLimitationStatus = false
      }
      if (item.activity.product_status) {
        me.productStatus = true
      }else{
        me.productStatus = false
      }
      if (item.activity.quantity_status) {
        me.quantityStatus = true
      }else{
        me.quantityStatus = false
      }
      if (item.activity.dose_status) {
        me.doseStatus = true
      }else{
        me.doseStatus = false
      }
      $('#modal-view').modal('show')
    },
    hideModal() {
      $('#modal-view').modal('hide')
      this.viewOnlly = false
      this.form = {
        id: null,
        date_performed: null,
        phytosanitary_limitation: null,
        employees: null,
        dose: null,
        dose_type: null,
        product: null,
        quantity: null,
        measure_type: null,
        description: null,
        metod: null,
        technical_visit: null,
        description: null
      }
    },
    saveData(evt) {
      evt.preventDefault()
      axios.put( `editActivity/${this.form.id}`, this.form)
      .then(res => {
        this.$swal({
          position: 'top',
          icon: 'success',
          title: res.data.message,
          showConfirmButton: true,
          confirmButtonText: 'Aceptar',
          timer: 1500
        })
        this.changeTracing(this.tracing_id)
        this.hideModal()
      })

      /* alert(JSON.stringify(this.form)) */
    },
    deletefiel(item) {
      let me = this
      this.$swal({
        title: '¿Estás seguro?',
        text: '¡No podrás revertir esto!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, Eliminar!'
      }).then(result => {
        if (result.value) {
          //Inactivar
          if (item.id) {
            axios.delete( `deleteActivity/${item.id}`)
            .then(res => {
              me.$swal({
                position: 'top',
                icon: 'success',
                title: res.data.message,
                showConfirmButton: true,
                confirmButtonText: 'Aceptar',
                timer: 1500
              })
              me.changeTracing(me.tracing_id)
              me.hideModal()
            })
            //alert(JSON.stringify(params))
          }
          /* this.$swal(
            'Inactivado!',
            'La dependencia o persona se desactivo.',
            'success'
          ) */
        }
      })
    }
  }
}
</script>
<style lang="scss" scoped>
  .body_table{
    th{
      font-weight: 300;
      vertical-align: middle !important;
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

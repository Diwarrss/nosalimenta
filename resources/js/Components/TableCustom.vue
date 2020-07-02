<template>
  <div class="table-responsive">
    <table class="table table-striped">
      <thead>
        <tr v-if="columns">
          <th :id="item.name" scope="col" v-for="(item, index) in tableFields" :key="index">
            {{item.title}}
          </th>
        </tr>
      </thead>
      <tbody v-if="paginate">
        <tr v-if="!allData.total">
          <td
            :colspan="countVisibleFields"
            class="alert alert-info text-center"
          >Sin Datos!</td>
        </tr>
        <tr
          v-else
          v-for="(data, keyIndex) in allData.data" :key="keyIndex"
          :item-index="keyIndex"
          >
          <template>
            <td
              v-for="(field, fieldIndex) in tableFields" :key="fieldIndex"
              v-if="field.visible"
              :class="bodyClass('vuetable-td-'+field.name, field)"
              :style="{width: field.width}"
              v-html="renderNormalField(field, data)"
            ></td>
          </template>
        </tr>
      </tbody>
      <tbody v-else>
        <tr v-if="!allData.length">
          <td :colspan="countVisibleFields"
            class="alert alert-info text-center"
          >Sin Datos!</td>
        </tr>
        <tr
          v-for="(data, keyIndex) in allData" :key="keyIndex"
          :item-index="keyIndex"
          >
          <template>
            <td
              v-for="(field, fieldIndex) in tableFields" :key="fieldIndex"
              v-if="field.visible"
              :class="bodyClass('vuetable-td-'+field.name, field)"
              :style="{width: field.width}"
              v-html="renderNormalField(field, data)"
            ></td>
          </template>
        </tr>
      </tbody>
    </table>
    <!-- Implementa el vue pagination para poder cambiar pagina -->
    <pagination
      v-if="paginate"
      :data="allData"
      @pagination-change-page="getData"
      align="center"
      :limit="1"
    ></pagination>
  </div>
</template>
<script>
export default {
  props:{
    api_url: String, //url de la api method get server
    columns: {type: [Object,Array], required: true}, //El header de la tabla
    data_local: {type: [Object,Array], default: Object}, //json con la informacion local
    actions: {type: Object, default: Object},
    per_page: { type: Number, default: 5}, //datos por pagina
    paginate: { type: Boolean, default: true}, //para paginar
  },
  data() {
    return {
      allData: [Array, Object],
      tableFields: [],
    }
  },
  computed: {
    //validar si no hay datos
    countVisibleFields () {
      return this.tableFields.length
    }
  },
  created() {
    //verificamos si viene url si no igualamos la variable allData = data
    if (this.api_url) {
      this.getData()
    }else{
      this.allData = this.data_local
    }
    this.normalizeFields()
  },
  methods: {
    getData(page = 1){
      let me = this
      //si recibimos una pagina
      if (me.paginate) {
        axios.get(me.api_url +'?page=' + page,{
          params: {
            per_page: me.per_page,
            paginate: me.paginate,
            page: page
          }
        })
        .then(res => {
          me.allData = res.data
          //console.log(res);
        })
      }else{
        axios.get(me.api_url, {
          params: {
            per_page: me.per_page,
            paginate: me.paginate
          }
        })
        .then(res => {
          me.allData = res.data
          //console.log(res);
        })
      }
    },
    warn (msg) {
      if (!this.silent) {
        console.warn(msg)
      }
    },
    normalizeFields () {
      if (typeof(this.columns) === 'undefined') {
        this.warn('You need to provide "fields" prop.')
        return
      }

      this.tableFields = []

      this.columns.forEach( (field, i) => {
        this.tableFields.push(this.newField(field, i))
      })
      //console.log(this.tableFields)
    },
    newField (field, index) {
      let defaultField = {
        name: '',
        // title:
        // this allow the code to detect undefined title
        // and replace it with capitalized name instead
        titleClass: '',
        dataClass: '',
        sortField: null,
        formatter: null,
        visible: true,
        width: null,
        $_index: index,
      }

      if (typeof(field) === 'string') {
        return Object.assign({}, defaultField, {
          name: this.normalizeFieldName(field),
          title: this.makeTitle(field),
        })
      }

      let obj = Object.assign({}, defaultField, field)
      obj.name = this.normalizeFieldName(obj.name)
      if (obj.title === undefined) {
        obj.title = this.makeTitle(obj.name)
      }
      if (obj.formatter !== null && typeof(obj.formatter) !== 'function') {
        console.error(obj.name + ' field formatter must be a function')
        obj.formatter = null
      }
      return obj
    },
    normalizeFieldName (fieldName) {
      if (fieldName instanceof Object) return fieldName

      return typeof(fieldName) === 'string' && fieldName.replace('__', this.fieldPrefix)
    },
    makeTitle (str) {
      if (this.isFieldComponent(str)) {
        return ''
      }

      return this.titleCase(str.replace('.', ' '))
    },
    isFieldComponent (fieldName) {
      if (fieldName instanceof Object) {
        // let's assume it is a Vue component
        return true
      }

      return fieldName.slice(0, this.fieldPrefix.length) === this.fieldPrefix
        || fieldName.slice(0, 2) === '__'
    },
    titleCase (str) {
      return str.replace(/\w+/g, (txt) => {
        return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase()
      })
    },
    bodyClass (base, field) {
      return [ base, field.dataClass ]
    },
    renderNormalField (field, item) {
      return this.hasFormatter(field)
        ? this.callFormatter(field, item)
        : this.getObjectValue(item, field.name, '')
    },
    hasFormatter (item) {
      return typeof(item.formatter) === 'function'
    },
    callFormatter (field, item) {
      if ( ! this.hasFormatter(field)) return

      if (typeof(field.formatter) === 'function') {
       return field.formatter(this.getObjectValue(item, field.name), this)
      }
    },
    //comparamos los valores del data vs fields
    getObjectValue (object, path, defaultValue) {
      defaultValue = (typeof defaultValue === 'undefined') ? null : defaultValue

      let obj = object
      if (path.trim() != '') {
        let keys = path.split('.')
        keys.forEach( (key) => {
          if (obj !== null && typeof obj[key] !== 'undefined' && obj[key] !== null) {
            obj = obj[key]
          } else {
            obj = defaultValue
            return
          }
        })
      }
      return obj
    }
  }
}
</script>

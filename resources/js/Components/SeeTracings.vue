<template>
  <div class="card">
    <div class="card-header">
      <i class="fa fa-list-ol" aria-hidden="true"></i> Seguimientos
      <button
        type="submit"
        class="btn btn-success"
        id="descargar"
        @click="downloadData"
      >
        <i class="fa fa-file-excel-o" aria-hidden="true"></i> Descargar
      </button>
    </div>
    <div class="card-body">
      <TableCustom
        :api_url="api_url"
        :columns="columns"
        :per_page="5"
        :paginate="true" />
    </div>
  </div>
</template>
<script>
import TableCustom from '../Components/TableCustom'
import XLSX from 'xlsx'
export default {
  components: {
    TableCustom
  },
  data() {
    return {
      api_url: '/tracings',
      columns: [
        {
          name: 'id',
          title: '#'
        },
        {
          name: 'user.name',
          title: 'Encargado'
        },
        {
          name: 'municipality.province.name',
          title: 'Provincia'
        },
        {
          name: 'municipality.name',
          title: 'Municipio'
        },
        {
          name: 'zone',
          title: 'Vereda'
        },
        {
          name: 'producer',
          title: 'Productor'
        },
        {
          name: 'identification',
          title: 'Cedula'
        },
        {
          name: 'phone',
          title: 'Celular'
        },
      ],
    }
  },
  computed: {
    allTracings(){
      return this.$store.state.allTracings
    }
  },
  created() {
    this.$store.dispatch('getTracings')
  },
  methods: {
    downloadData(){
      // console.log('descarga')
      axios({
        method: 'get',
        url: 'tracings/export', /* enviamos la url de la api y la ruta con sus parametros para descargar el csv */
        /* responseType: 'blob' */
      })
      .then(res => {
        if (res.data.length) {
          // export json to Worksheet of Excel
          // only array possible
          var exportData = XLSX.utils.json_to_sheet(res.data)
          var wb = XLSX.utils.book_new() // make Workbook of Excel
          // add Worksheet to Workbook
          // Workbook contains one or more worksheets
          XLSX.utils.book_append_sheet(wb, exportData, 'Tracings') // sheetAName is name of Worksheet
          // export Excel file
          XLSX.writeFile(wb, 'Tracings.xlsx') // name of the file is 'book.xlsx'
          /* swal({
            title: "Descarga éxitosa!",
            icon: 'success',
            confirmButtonColor: '#4dbd74',
            confirmButtonText:
              '<i class="far fa-check-circle"></i> Aceptar',
            timer: 2000
          }) */
          Vue.swal({
            icon: 'success',
            title: "Descarga éxitosa!",
            confirmButtonColor: '#4dbd74',
            confirmButtonText:
              '<i class="fa fa-check-circle-o"/> Aceptar',
            timer: 2000
          })
        }
      })
      .catch(error => {
        /* me.$swal({
          title: "Error al descargar, Reintentar!",
          icon: 'error',
          confirmButtonColor: '#4dbd74',
          confirmButtonText:
            '<i class="far fa-check-circle"></i> Aceptar',
          timer: 2000
        }) */
        Vue.swal({
          title: "Error al descargar, Reintentar!",
          icon: 'error',
          confirmButtonColor: '#4dbd74',
          confirmButtonText:
            '<i class="fa fa-check-circle-o"></i> Aceptar',
          timer: 2000
        })
      })
    }
  },
}
</script>

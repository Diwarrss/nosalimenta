<template>
  <div class="card">
    <div class="card-header">
      <i class="fa fa-list-ol" aria-hidden="true"></i> Seguimientos
    </div>
    <div class="card-body">
      <TableCustom
        :api_url="api_url"
        :columns="columns"
        :per_page="8"
        :paginate="false" />
    </div>
  </div>
</template>
<script>
import TableCustom from '../Components/TableCustom'
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
  }
}
</script>

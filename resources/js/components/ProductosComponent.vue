<template>
    <table class="table table-striped table-sm">
        <thead>
        <tr>
            <th>Código</th>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Edición</th>
        </tr>
        </thead>
        <tbody>

        <tr v-for="producto in productos">
            <td>{{ producto.codigo }}</td>
            <td>{{ producto.nombre }}</td>
            <td>{{ producto.precio }}</td>
            <td></td>
        </tr>

        <tr>
            <td colspan="4">No existen registros en la base de datos.</td>
        </tr>

        </tbody>
    </table>
</template>

<script>
export default {
    data: function (){
        return {
            productos: [],
        }
    },

    mounted() {
        this.loadProductos();
    },

    methods: {
        loadProductos: function() {
            axios.get('/api/productos')
            .then((response) => {
                this.productos = response.data.data;
            })
            .catch(function(error){
                console.log(error);
            });
        }
    }
}
</script>

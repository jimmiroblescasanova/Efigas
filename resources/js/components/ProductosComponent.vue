<template>
    <div class="card">
        <div class="card-header">
            Lista de productos
        </div>
        <div class="card-body p-0">
            <div class="row pl-3 pr-3 pt-3 align-content-center">
                <div class="col-md-3 col-sm-3 col-3">
                    <div class="form-group">
                        <label for="productType" class="sr-only">Tipo</label>
                        <select v-model="productType" class="form-control" name="productType" id="productType">
                            <option value="2">Kit's</option>
                            <option value="1">Productos</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-9 col-sm-9 col-3 form-group">
                    <label for="search" class="sr-only">Buscar</label>
                    <div class="input-group">
                        <input
                            v-model="search"
                            type="text"
                            class="form-control"
                            name="search"
                            id="search"
                            placeholder="Busca por código o nombre...">
                        <span class="input-group-append">
                            <button class="btn btn-xs btn-danger" @click="clear()">Limpiar</button>
                        </span>
                    </div>
                </div>
            </div>
            <table class="table table-striped table-sm">
                <thead>
                <tr>
                    <th style="width: 15%;">Código</th>
                    <th>Nombre</th>
                    <th style="width: 10%;">Precio</th>
                    <th>Edición</th>
                </tr>
                </thead>
                <tbody>

                <tr v-for="producto in productos.data">
                    <td>{{ producto.codigo }}</td>
                    <td>{{ producto.nombre }}</td>
                    <td class="text-right">$ {{ producto.precio }}</td>
                    <td></td>
                </tr>

                <tr v-if="productos.data == null">
                    <td colspan="4">No existen registros en la base de datos.</td>
                </tr>

                </tbody>
            </table>
        </div>
        <div class="card-footer">
            <pagination :data="productos" align="right" :limit="3" @pagination-change-page="getResults"></pagination>
        </div>
    </div>
</template>

<script>
export default {
    data: function () {
        return {
            productos: {},
            search: '',
            productType: '1',
        }
    },

    mounted() {
        this.getResults();
    },

    methods: {
        clear() {
            this.search = '';
        },
        getResults(page = 1) {
            axios.get('/api/productos', {
                params: {
                    type: this.productType,
                    page,
                    search: this.search,
                }
            })
                .then((response) => {
                    this.productos = response.data;
                })
                .catch(function (error) {
                    console.log(error);
                });
        },
    },

    watch: {
        search: function () {
            if (this.search.length >= 3 || this.search.length === 0) {
                this.getResults(this.search);
            }
        },
        productType: function () {
            this.getResults(this.productType, this.search);
        }
    },
}
</script>

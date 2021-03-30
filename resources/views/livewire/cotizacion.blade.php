<div>
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form wire:submit.prevent="store">
                        <fieldset>
                            <legend>Datos generales</legend>
                            <div class="row">
                                <div class="form-group col-md-8">
                                    <label for="nombre">Nombre del cliente: </label>
                                    <input
                                        wire:model="nombre"
                                        type="text"
                                        name="nombre"
                                        id="nombre"
                                        class="form-control {{ $errors->first('nombre') ? 'is-invalid' : '' }}"
                                        placeholder=""
                                    />
                                    {!! $errors->first('nombre', '<div class="invalid-feedback">:message</div>') !!}
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="fecha">Fecha</label>
                                    <input
                                        wire:model="fecha"
                                        type="date"
                                        class="form-control {{ $errors->first('fecha') ? 'is-invalid' : '' }}"
                                        name="fecha"
                                        id="fecha"
                                    />
                                    {!! $errors->first('fecha', '<div class="invalid-feedback">:message</div>') !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="direccion">Dirección: </label>
                                <textarea wire:model="direccion" class="form-control" name="direccion" id="direccion"></textarea>
                            </div>
                        </fieldset>
                        <fieldset>
                            <legend>Productos cotizados</legend>
                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                    data-target="#exampleModal">
                                Agregar un producto o kit
                            </button>
                            <div class="row mt-3">
                                <table class="table table-sm">
                                    <thead>
                                    <tr>
                                        <th>Cantidad</th>
                                        <th>Nombre</th>
                                        <th>Precio</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if($rowInput)
                                        @foreach($rowInput as $i => $row)
                                            <tr>
                                                <td>
                                                    <input
                                                        wire:model="rowInput.{{ $i }}.cantidad"
                                                        type="number"
                                                        class="form-control form-control-sm {{ $errors->first('rowInput.'. $i .'.cantidad') ? 'is-invalid' : '' }}"
                                                        value="1"
                                                    />
                                                    {!! $errors->first('rowInput.'. $i .'.cantidad', '<div class="invalid-feedback">:message</div>') !!}
                                                </td>
                                                <td>
                                                    {{ $row['nombre'] }}
                                                    <input
                                                        wire:model="rowInput.{{ $i }}.id"
                                                        type="hidden"
                                                        value="{{ $row['id'] }}"
                                                    />
                                                </td>
                                                <td>
                                                    <input
                                                        wire:model="rowInput.{{ $i }}.precio"
                                                        type="text"
                                                        class="form-control form-control-sm {{ $errors->first('rowInput.'. $i .'.precio') ? 'is-invalid' : '' }}"
                                                        value="{{ $row['precio'] }}"
                                                    />
                                                    {!! $errors->first('rowInput.'. $i .'.precio', '<div class="invalid-feedback">:message</div>') !!}
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </fieldset>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success btn-sm">Finalizar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Búsqueda del producto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-10">
                            <input
                                class="form-control"
                                type="text"
                                name="search"
                                id="search"
                                placeholder="Buscar un producto..."
                                wire:model.defer="searchInput"
                                wire:keydown.enter="render"
                            />
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-primary btn-block" wire:click="render">Buscar</button>
                        </div>
                    </div>
                    @if ($products)
                        <div class="row">
                            {{ $products->links() }}
                        </div>
                        <div class="row">
                            <table class="table table-sm table-striped">
                                @foreach ($products as $product)
                                    <tr>
                                        <td>{{ $product->id }}</td>
                                        <td>{{ $product->nombre }}</td>
                                        <td>
                                            <button
                                                wire:click="addInput({{ $product->id }})"
                                                type="button"
                                                data-id="{{ $product->id }}"
                                                class="btn-product btn btn-primary btn-xs"
                                            >Seleccionar</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</div>

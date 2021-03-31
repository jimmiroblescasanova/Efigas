<div>
    <div class="row mb-3">
        <div class="col-md-6">
            <input wire:model.debounce.350ms="searchQuery"
                type="text"
                class="form-control border-0 shadow-sm"
                placeholder="Buscar por fecha, nombre o ID" autofocus>
        </div>
        <div class="col-md-2">
            <select wire:model="orderColumn" class="form-control border-0 shadow-sm">
                <option value="id">ID</option>
                <option value="nombre">Nombre</option>
                <option value="fecha">Fecha</option>
            </select>
        </div>
        <div class="col-md-2">
            <select wire:model="orderDesc" class="form-control border-0 shadow-sm">
                <option value="1">Descendente</option>
                <option value="0">Ascendente</option>
            </select>
        </div>
        <div class="col-md-2">
            <select wire:model="perPage" class="form-control border-0 shadow-sm">
                <option>10</option>
                <option>25</option>
                <option>50</option>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body p-0">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Fecha</th>
                                <th>Nombre del cliente</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($estimations as $estimation)
                                <tr>
                                    <td scope="row">{{ $estimation->id }}</td>
                                    <td>{{ $estimation->fecha->format('d-m-Y') }}</td>
                                    <td>{{ $estimation->nombre }}</td>
                                    <td>{{ $estimation->grand_total }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    {{ $estimations->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

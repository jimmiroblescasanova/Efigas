<div>
    <div class="row">
        <div class="col-md-6 col-6 mb-3">
            <div class="input-group">
                <span class="input-group-prepend bg-white shadow-sm rounded-left">
                    <span class="input-group-text bg-transparent border-0">
                        <i class="fas fa-search"></i>
                    </span>
                </span>
                <input wire:model.debounce.350ms="searchQuery" type="text" class="form-control border-0 shadow-sm"
                    placeholder="Buscar por fecha, nombre o ID" autofocus>

            </div>
        </div>
        <div class="col-md-2 col-6 mb-3">
                <select wire:model="orderColumn" class="form-control border-0 shadow-sm">
                <option value="id">ID</option>
                <option value="nombre">Nombre</option>
                <option value="fecha">Fecha</option>
            </select>
        </div>
        <div class="col-md-2 col-6 mb-3">
            <select wire:model="orderDesc" class="form-control border-0 shadow-sm">
                <option value="1">Descendente</option>
                <option value="0">Ascendente</option>
            </select>
        </div>
        <div class="col-md-2 col-6 mb-3">
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
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($estimations as $estimation)
                                <tr>
                                    <td scope="row">{{ $estimation->id }}</td>
                                    <td>{{ $estimation->fecha->format('d-m-Y') }}</td>
                                    <td>{{ $estimation->nombre }}</td>
                                    <td class="text-right">$ {{ $estimation->grand_total }}</td>
                                    <td>
                                        <a href="{{ route('cotizacion.print', $estimation) }}" class="btn btn-default btn-xs" target="_blank"><i class="far fa-file-pdf"></i> PDF</a>
                                        <a href="{{ route('cotizacion.send', $estimation) }}" class="btn btn-default btn-xs"><i class="far fa-paper-plane"></i> Email</a>
                                    </td>
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

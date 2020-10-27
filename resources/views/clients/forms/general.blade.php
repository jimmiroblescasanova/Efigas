<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label for="account_number">Número de cuenta</label>
            <input type="text"
                   class="form-control"
                   id="account_number"
                   placeholder="Se obtiene automáticamente"
                   value="{{ request()->routeIs('clients.show') ? $client->id : '' }}" readonly/>
        </div>
    </div>
    <div class="col-md-8">
        <div class="form-group">
            <label for="name">Nombre completo</label>
            <input type="text"
                   class="form-control {{ $errors->first('name') ? 'is-invalid' : '' }}"
                   name="name"
                   id="name"
                   placeholder="Nombre completo"
                   value="{{ old('name', $client->name) }}">
            {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label for="rfc">RFC</label>
            <input type="text"
                   class="form-control {{ $errors->first('rfc') ? 'is-invalid' : '' }}"
                   name="rfc"
                   id="rfc"
                   placeholder="RFC"
                   value="{{ old('rfc', $client->rfc) }}">
            {!! $errors->first('rfc', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div>
    <div class="col-md-8">
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email"
                   class="form-control {{ $errors->first('email') ? 'is-invalid' : '' }}"
                   name="email"
                   id="email"
                   placeholder="Ingresar email"
                   value="{{ old('email', $client->email) }}">
            {!! $errors->first('email', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label for='country_code'>País</label>
            <select id='country_code' name='country_code' class='form-control select2bs4'>
                @include('partials.country-codes')
            </select>
        </div>
    </div>
    <div class="col-md-8">
        <div class="form-group">
            <label for="phone">Teléfono</label>
            <input type="text"
                   class="form-control {{ $errors->first('phone') ? 'is-invalid' : '' }}"
                   name="phone"
                   id="phone"
                   placeholder="Número de teléfono (sin guiones ni espacios)"
                   value="{{ old('phone', $client->phone) }}">
            {!! $errors->first('phone', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label for='measurer_id'>Medidor</label>
            <select id='measurer_id' name='measurer_id' class='form-control select2bs4 {{ $errors->first('measurer_id') ? 'is-invalid' : '' }}'>
                @if ($client->measurer_id == NULL)
                    <option value="">Omitir (capturar después)</option>
                    @else
                    <option value="{{ $client->measurer_id }}" selected>{{ $client->measurer->serial_number }}</option>
                @endif
                @foreach ($measurers as $measurer)
                    <option value="{{ $measurer->id }}">{{ $measurer->serial_number }}</option>
                @endforeach
            </select>
            {!! $errors->first('measurer_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div>
    <div class="col-md-8">
        <div class="form-group">
            <label for='project_id'>Condominio</label>
            <select id='project_id' name='project_id' class='form-control select2bs4 {{ $errors->first('project_id') ? 'is-invalid' : '' }}'>
                @foreach ($projects as $id => $project)
                    <option value="{{ $id }}" {{ ($id == $client->project_id) ? 'selected' : '' }}>{{ $project }}</option>
                @endforeach
            </select>
            {!! $errors->first('project_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div>
</div>

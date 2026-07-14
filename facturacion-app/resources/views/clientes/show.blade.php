@extends('layouts.app')

@section('title', 'Detalle del cliente')

@section('content')
    <h1 class="h3 mb-4">{{ $cliente->nombre }}</h1>

    <div class="card">
        <div class="card-body">
            <dl class="row mb-0">
                <dt class="col-sm-3">NIT</dt>
                <dd class="col-sm-9">{{ $cliente->nit }}</dd>

                <dt class="col-sm-3">Email</dt>
                <dd class="col-sm-9">{{ $cliente->email ?? '—' }}</dd>

                <dt class="col-sm-3">Teléfono</dt>
                <dd class="col-sm-9">{{ $cliente->telefono ?? '—' }}</dd>

                <dt class="col-sm-3">Dirección</dt>
                <dd class="col-sm-9">{{ $cliente->direccion ?? '—' }}</dd>
            </dl>
        </div>
    </div>

    <div class="mt-3">
        <a href="{{ route('clientes.index') }}" class="btn btn-secondary">Volver</a>
        <a href="{{ route('clientes.edit', $cliente) }}" class="btn btn-primary">Editar</a>
    </div>
@endsection

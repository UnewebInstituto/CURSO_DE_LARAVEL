@extends('layouts.app')

@section('title', 'Detalle del producto')

@section('content')
    <h1 class="h3 mb-4">{{ $producto->nombre }}</h1>

    <div class="card">
        <div class="card-body">
            <dl class="row mb-0">
                <dt class="col-sm-3">Descripción</dt>
                <dd class="col-sm-9">{{ $producto->descripcion ?? '—' }}</dd>

                <dt class="col-sm-3">Precio</dt>
                <dd class="col-sm-9">${{ number_format($producto->precio, 2) }}</dd>

                <dt class="col-sm-3">Stock</dt>
                <dd class="col-sm-9">{{ $producto->stock }}</dd>
            </dl>
        </div>
    </div>

    <div class="mt-3">
        <a href="{{ route('productos.index') }}" class="btn btn-secondary">Volver</a>
        <a href="{{ route('productos.edit', $producto) }}" class="btn btn-primary">Editar</a>
    </div>
@endsection

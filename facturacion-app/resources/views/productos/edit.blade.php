@extends('layouts.app')

@section('title', 'Editar producto')

@section('content')
    <h1 class="h3 mb-4">Editar producto</h1>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('productos.update', $producto) }}" method="POST">
                @csrf
                @method('PUT')
                @include('productos._form')

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                    <a href="{{ route('productos.index') }}" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
@endsection

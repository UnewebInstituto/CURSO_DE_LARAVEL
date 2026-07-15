@extends('layouts.app')

@section('title', 'Nuevo producto')

@section('content')
    <h1 class="h3 mb-4">Nuevo producto</h1>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('productos.store') }}" method="POST">
                @csrf
                @include('productos._form')

                <div class="mt-4">
                    <button type="submit" class="btn btn-success">Guardar</button>
                    <a href="{{ route('productos.index') }}" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
@endsection

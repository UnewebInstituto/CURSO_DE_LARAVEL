@extends('layouts.app')

@section('title', 'Editar cliente')

@section('content')
    <h1 class="h3 mb-4">Editar cliente</h1>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('clientes.update', $cliente) }}" method="POST">
                @csrf
                @method('PUT')
                @include('clientes._form')

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                    <a href="{{ route('clientes.index') }}" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
@endsection

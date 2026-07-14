@extends('layouts.app')

@section('title', 'Nuevo cliente')

@section('content')
    <h1 class="h3 mb-4">Nuevo cliente</h1>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('clientes.store') }}" method="POST">
                @csrf
                @include('clientes._form')

                <div class="mt-4">
                    <button type="submit" class="btn btn-success">Guardar</button>
                    <a href="{{ route('clientes.index') }}" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
@endsection

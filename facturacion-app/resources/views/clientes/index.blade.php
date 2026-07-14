@extends('layouts.app')

@section('title', 'Clientes')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3 mb-0">Clientes</h1>
        <a href="{{ route('clientes.create') }}" class="btn btn-success">
            + Nuevo cliente
        </a>
    </div>

    <div class="card">
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Nombre</th>
                        <th>NIT</th>
                        <th>Email</th>
                        <th>Teléfono</th>
                        <th class="text-end">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($clientes as $cliente)
                        <tr>
                            <td>{{ $cliente->nombre }}</td>
                            <td>{{ $cliente->nit }}</td>
                            <td>{{ $cliente->email ?? '—' }}</td>
                            <td>{{ $cliente->telefono ?? '—' }}</td>
                            <td class="text-end">
                                <a href="{{ route('clientes.show', $cliente) }}" class="btn btn-sm btn-outline-secondary">
                                    Ver
                                </a>
                                <a href="{{ route('clientes.edit', $cliente) }}" class="btn btn-sm btn-outline-primary">
                                    Editar
                                </a>
                                <form action="{{ route('clientes.destroy', $cliente) }}" method="POST" class="d-inline"
                                      onsubmit="return confirm('¿Eliminar este cliente?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                        Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">
                                No hay clientes registrados todavía.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">
        {{ $clientes->links() }}
    </div>
@endsection

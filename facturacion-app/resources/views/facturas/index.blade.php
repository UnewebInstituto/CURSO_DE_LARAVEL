@extends('layouts.app')

@section('title', 'Facturas')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3 mb-0">Facturas</h1>
        <a href="{{ route('facturas.create') }}" class="btn btn-success">
            + Nueva factura
        </a>
    </div>

    <div class="card">
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Número</th>
                        <th>Cliente</th>
                        <th>Fecha</th>
                        <th>Total</th>
                        <th>Estado</th>
                        <th class="text-end">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($facturas as $factura)
                        <tr>
                            <td>{{ $factura->numero }}</td>
                            <td>{{ $factura->cliente->nombre }}</td>
                            <td>{{ $factura->fecha->format('d/m/Y') }}</td>
                            <td>${{ number_format($factura->total, 2) }}</td>
                            <td>
                                @php
                                    $badge = match($factura->estado) {
                                        'pagada' => 'success',
                                        'anulada' => 'danger',
                                        default => 'warning',
                                    };
                                @endphp
                                <span class="badge bg-{{ $badge }}">{{ ucfirst($factura->estado) }}</span>
                            </td>
                            <td class="text-end">
                                <a href="{{ route('facturas.show', $factura) }}" class="btn btn-sm btn-outline-secondary">Ver</a>
                                <a href="{{ route('facturas.edit', $factura) }}" class="btn btn-sm btn-outline-primary">Editar</a>
                                <form action="{{ route('facturas.destroy', $factura) }}" method="POST" class="d-inline"
                                      onsubmit="return confirm('¿Eliminar esta factura? El stock de los productos será restituido.');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">No hay facturas registradas todavía.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">
        {{ $facturas->links() }}
    </div>
@endsection

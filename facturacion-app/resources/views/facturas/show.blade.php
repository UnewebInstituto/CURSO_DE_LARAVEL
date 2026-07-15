@extends('layouts.app')

@section('title', 'Detalle de factura')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Factura {{ $factura->numero }}</h1>
        @php
            $badge = match($factura->estado) {
                'pagada' => 'success',
                'anulada' => 'danger',
                default => 'warning',
            };
        @endphp
        <span class="badge bg-{{ $badge }} fs-6">{{ ucfirst($factura->estado) }}</span>
    </div>

    <div class="card mb-3">
        <div class="card-body">
            <dl class="row mb-0">
                <dt class="col-sm-2">Cliente</dt>
                <dd class="col-sm-4">{{ $factura->cliente->nombre }}</dd>

                <dt class="col-sm-2">NIT</dt>
                <dd class="col-sm-4">{{ $factura->cliente->nit }}</dd>

                <dt class="col-sm-2">Fecha</dt>
                <dd class="col-sm-4">{{ $factura->fecha->format('d/m/Y') }}</dd>
            </dl>
        </div>
    </div>

    <div class="card">
        <div class="card-header">Productos</div>
        <div class="card-body p-0">
            <table class="table mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Precio unitario</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($factura->detalles as $detalle)
                        <tr>
                            <td>{{ $detalle->producto->nombre }}</td>
                            <td>{{ $detalle->cantidad }}</td>
                            <td>${{ number_format($detalle->precio_unitario, 2) }}</td>
                            <td>${{ number_format($detalle->subtotal, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr class="table-light">
                        <th colspan="3" class="text-end">Total</th>
                        <th>${{ number_format($factura->total, 2) }}</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <div class="mt-3">
        <a href="{{ route('facturas.index') }}" class="btn btn-secondary">Volver</a>
        <a href="{{ route('facturas.edit', $factura) }}" class="btn btn-primary">Editar</a>
    </div>
@endsection

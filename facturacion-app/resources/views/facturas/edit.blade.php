@extends('layouts.app')

@section('title', 'Editar factura')

@section('content')
    <h1 class="h3 mb-4">Editar factura {{ $factura->numero }}</h1>

    <div class="alert alert-info">
        Solo se pueden modificar el cliente, la fecha y el estado. Las líneas de productos no son editables una vez facturadas.
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('facturas.update', $factura) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="cliente_id" class="form-label">Cliente</label>
                    <select name="cliente_id" id="cliente_id" class="form-select @error('cliente_id') is-invalid @enderror">
                        @foreach ($clientes as $cliente)
                            <option value="{{ $cliente->id }}" {{ old('cliente_id', $factura->cliente_id) == $cliente->id ? 'selected' : '' }}>
                                {{ $cliente->nombre }}
                            </option>
                        @endforeach
                    </select>
                    @error('cliente_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="fecha" class="form-label">Fecha</label>
                    <input type="date" name="fecha" id="fecha"
                           class="form-control @error('fecha') is-invalid @enderror"
                           value="{{ old('fecha', $factura->fecha->format('Y-m-d')) }}">
                    @error('fecha')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="estado" class="form-label">Estado</label>
                    <select name="estado" id="estado" class="form-select @error('estado') is-invalid @enderror">
                        @foreach (['pendiente', 'pagada', 'anulada'] as $estado)
                            <option value="{{ $estado }}" {{ old('estado', $factura->estado) == $estado ? 'selected' : '' }}>
                                {{ ucfirst($estado) }}
                            </option>
                        @endforeach
                    </select>
                    @error('estado')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                    <a href="{{ route('facturas.index') }}" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
@endsection

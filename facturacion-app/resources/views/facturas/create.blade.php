@extends('layouts.app')

@section('title', 'Nueva factura')

@section('content')
    <h1 class="h3 mb-4">Nueva factura</h1>

    <form action="{{ route('facturas.store') }}" method="POST">
        @csrf

        <div class="card mb-3">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="cliente_id" class="form-label">Cliente</label>
                        <select name="cliente_id" id="cliente_id"
                                class="form-select @error('cliente_id') is-invalid @enderror">
                            <option value="">-- Seleccione --</option>
                            @foreach ($clientes as $cliente)
                                <option value="{{ $cliente->id }}" {{ old('cliente_id') == $cliente->id ? 'selected' : '' }}>
                                    {{ $cliente->nombre }} ({{ $cliente->nit }})
                                </option>
                            @endforeach
                        </select>
                        @error('cliente_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="fecha" class="form-label">Fecha</label>
                        <input type="date" name="fecha" id="fecha"
                               class="form-control @error('fecha') is-invalid @enderror"
                               value="{{ old('fecha', date('Y-m-d')) }}">
                        @error('fecha')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span>Productos</span>
                <button type="button" class="btn btn-sm btn-success" onclick="agregarLinea()">+ Agregar producto</button>
            </div>
            <div class="card-body">
                <table class="table" id="tabla-productos">
                    <thead>
                        <tr>
                            <th style="width: 50%">Producto</th>
                            <th style="width: 20%">Cantidad</th>
                            <th style="width: 20%">Subtotal</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="lineas-productos"></tbody>
                </table>
                <p class="text-muted small mb-0" id="mensaje-vacio">Agrega al menos un producto.</p>
            </div>
        </div>

        <div class="mt-4">
            <button type="submit" class="btn btn-success">Guardar factura</button>
            <a href="{{ route('facturas.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>

    <!-- Preparamos el array de productos en un bloque PHP aislado, -->
    <!-- para no mezclar la expresion con la misma linea del script -->
    @php
        $productosJson = $productos->map(fn ($p) => [
            'id' => $p->id,
            'nombre' => $p->nombre,
            'precio' => $p->precio,
            'stock' => $p->stock,
        ]);
    @endphp

    <script>
        const productosDisponibles = {!! json_encode($productosJson) !!};

        @verbatim
        let contador = 0;

        function agregarLinea() {
            const tbody = document.getElementById('lineas-productos');
            const fila = document.createElement('tr');
            fila.id = 'fila-' + contador;

            let opciones = '<option value="">-- Producto --</option>';
            productosDisponibles.forEach(p => {
                opciones += `<option value="${p.id}" data-precio="${p.precio}" data-stock="${p.stock}">${p.nombre} — $${p.precio} (stock: ${p.stock})</option>`;
            });

            fila.innerHTML = `
                <td>
                    <select name="productos[${contador}][producto_id]" class="form-select" onchange="calcularSubtotal(${contador})" required>
                        ${opciones}
                    </select>
                </td>
                <td>
                    <input type="number" name="productos[${contador}][cantidad]" class="form-control" min="1" value="1" onchange="calcularSubtotal(${contador})" required>
                </td>
                <td>
                    <span id="subtotal-${contador}">$0.00</span>
                </td>
                <td>
                    <button type="button" class="btn btn-sm btn-outline-danger" onclick="quitarLinea(${contador})">✕</button>
                </td>
            `;

            tbody.appendChild(fila);
            document.getElementById('mensaje-vacio').style.display = 'none';
            contador++;
        }

        function quitarLinea(id) {
            document.getElementById('fila-' + id).remove();
        }

        function calcularSubtotal(id) {
            const fila = document.getElementById('fila-' + id);
            const select = fila.querySelector('select');
            const cantidad = fila.querySelector('input[type="number"]').value;
            const precio = select.selectedOptions[0]?.dataset.precio || 0;
            const subtotal = precio * cantidad;
            document.getElementById('subtotal-' + id).textContent = '$' + subtotal.toFixed(2);
        }

        // Al menos una línea al cargar
        agregarLinea();
        @endverbatim
    </script>
@endsection

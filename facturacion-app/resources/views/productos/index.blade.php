@extends('layouts.app')

@section('title', 'Productos')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3 mb-0">Productos</h1>
        <a href="{{ route('productos.create') }}" class="btn btn-success">
            + Nuevo producto
        </a>
    </div>

    <div class="card">
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th>Stock</th>
                        <th class="text-end">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($productos as $producto)
                        <tr>
                            <td>{{ $producto->nombre }}</td>
                            <td>${{ number_format($producto->precio, 2) }}</td>
                            <td>
                                @if ($producto->stock > 0)
                                    <span class="badge bg-success">{{ $producto->stock }}</span>
                                @else
                                    <span class="badge bg-danger">Agotado</span>
                                @endif
                            </td>
                            <td class="text-end">
                                <a href="{{ route('productos.show', $producto) }}" class="btn btn-sm btn-outline-secondary">
                                    Ver
                                </a>
                                <a href="{{ route('productos.edit', $producto) }}" class="btn btn-sm btn-outline-primary">
                                    Editar
                                </a>
                                <form action="{{ route('productos.destroy', $producto) }}" method="POST" class="d-inline"
                                      onsubmit="return confirm('¿Eliminar este producto?');">
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
                            <td colspan="4" class="text-center text-muted py-4">
                                No hay productos registrados todavía.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">
        {{ $productos->links() }}
    </div>
@endsection

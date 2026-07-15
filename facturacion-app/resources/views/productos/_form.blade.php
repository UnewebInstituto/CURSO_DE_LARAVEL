<div class="mb-3">
    <label for="nombre" class="form-label">Nombre</label>
    <input type="text" name="nombre" id="nombre"
           class="form-control @error('nombre') is-invalid @enderror"
           value="{{ old('nombre', $producto->nombre ?? '') }}">
    @error('nombre')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="descripcion" class="form-label">Descripción</label>
    <textarea name="descripcion" id="descripcion" rows="3"
              class="form-control @error('descripcion') is-invalid @enderror">{{ old('descripcion', $producto->descripcion ?? '') }}</textarea>
    @error('descripcion')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="row">
    <div class="col-md-6 mb-3">
        <label for="precio" class="form-label">Precio</label>
        <div class="input-group">
            <span class="input-group-text">$</span>
            <input type="number" step="0.01" min="0" name="precio" id="precio"
                   class="form-control @error('precio') is-invalid @enderror"
                   value="{{ old('precio', $producto->precio ?? '') }}">
            @error('precio')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-6 mb-3">
        <label for="stock" class="form-label">Stock</label>
        <input type="number" min="0" name="stock" id="stock"
               class="form-control @error('stock') is-invalid @enderror"
               value="{{ old('stock', $producto->stock ?? '0') }}">
        @error('stock')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

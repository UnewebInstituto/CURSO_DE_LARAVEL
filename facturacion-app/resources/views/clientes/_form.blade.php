<div class="mb-3">
    <label for="nombre" class="form-label">Nombre</label>
    <input type="text" name="nombre" id="nombre"
           class="form-control @error('nombre') is-invalid @enderror"
           value="{{ old('nombre', $cliente->nombre ?? '') }}">
    @error('nombre')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="nit" class="form-label">NIT</label>
    <input type="text" name="nit" id="nit"
           class="form-control @error('nit') is-invalid @enderror"
           value="{{ old('nit', $cliente->nit ?? '') }}">
    @error('nit')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="row">
    <div class="col-md-6 mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" name="email" id="email"
               class="form-control @error('email') is-invalid @enderror"
               value="{{ old('email', $cliente->email ?? '') }}">
        @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6 mb-3">
        <label for="telefono" class="form-label">Teléfono</label>
        <input type="text" name="telefono" id="telefono"
               class="form-control @error('telefono') is-invalid @enderror"
               value="{{ old('telefono', $cliente->telefono ?? '') }}">
        @error('telefono')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="mb-3">
    <label for="direccion" class="form-label">Dirección</label>
    <input type="text" name="direccion" id="direccion"
           class="form-control @error('direccion') is-invalid @enderror"
           value="{{ old('direccion', $cliente->direccion ?? '') }}">
    @error('direccion')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

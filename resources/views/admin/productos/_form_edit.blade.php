<form method="POST" action="{{ route('productos.store') }}" enctype="multipart/form-data">
    @csrf

    <div class="mb-3">
        <label class="form-label">Nombre</label>
        <input type="text" name="nombre" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Descripción</label>
        <textarea name="descripcion" class="form-control" rows="2"></textarea>
    </div>

    <div class="mb-3">
        <label class="form-label">Precio</label>
        <input type="number" name="precio" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Categoría</label>
        <select name="categoria_id" class="form-select" required>
            <option value="">Selecciona una categoría</option>
            @foreach($categorias as $categoria)
                <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Imagen</label>
        <input type="file" name="imagen" class="form-control">
    </div>

    <div class="form-check mb-3">
        <input class="form-check-input" type="checkbox" name="personalizable" id="personalizable">
        <label class="form-check-label" for="personalizable">¿Es personalizable?</label>
    </div>

    <div class="mb-3">
        <label class="form-label">Ingredientes</label>
        <div class="border rounded p-2" style="max-height: 200px; overflow-y:auto;">
            @foreach($ingredientes as $ingrediente)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="ingredientes[]" value="{{ $ingrediente->id }}" id="ing{{ $ingrediente->id }}">
                    <label class="form-check-label" for="ing{{ $ingrediente->id }}">
                        {{ $ingrediente->nombre }} ({{ $ingrediente->tipo }})
                    </label>
                </div>
            @endforeach
        </div>
    </div>

    <div class="d-grid">
        <button type="submit" class="btn btn-success">Guardar Producto</button>
    </div>
</form>

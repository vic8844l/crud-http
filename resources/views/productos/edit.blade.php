@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Editar Producto</h2>
        <form action="{{ route('productos.update', $id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre del Producto</label>
                <input type="text" class="form-control @error('nombre') is-invalid @enderror" id="nombre" name="nombre"
                    value="{{ old('nombre', $producto['nombre'] ?? '') }}" required>
                @error('nombre')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="categoria" class="form-label">Categoría</label>
                <select class="form-select @error('categoria') is-invalid @enderror" id="categoria" name="categoria"
                    required>
                    <option value="">Selecciona una categoría</option>
                    <option value="Tecnología"
                        {{ old('categoria', $producto['categoria'] ?? '') == 'Tecnología' ? 'selected' : '' }}>Tecnología
                    </option>
                    <option value="Muebles"
                        {{ old('categoria', $producto['categoria'] ?? '') == 'Muebles' ? 'selected' : '' }}>Muebles
                    </option>
                    <option value="Hogar"
                        {{ old('categoria', $producto['categoria'] ?? '') == 'Hogar' ? 'selected' : '' }}>Hogar</option>
                </select>
                @error('categoria')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="precio" class="form-label">Precio ($)</label>
                <input type="number" step="0.01" class="form-control @error('precio') is-invalid @enderror"
                    id="precio" name="precio" value="{{ old('precio', $producto['precio'] ?? '') }}" required>
                @error('precio')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-success">Actualizar Producto</button>
            <a href="{{ route('productos.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
@endsection

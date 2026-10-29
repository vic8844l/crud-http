@extends('layouts.app')

@section('title', 'Lista de Productos')

@section('content')
    <div class="row mb-3">
        <div class="col-md-6">
            <h2><i class="bi bi-box-seam"></i> Catálogo de Productos</h2>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('productos.create') }}" class="btn btn-success">
                <i class="bi bi-plus-lg"></i> Nuevo Producto
            </a>
        </div>
    </div>

    {{-- Formulario de Búsqueda y Filtros --}}
    <form method="GET" action="{{ route('productos.index') }}" class="row g-3 mb-4">
        <div class="col-md-4">
            <input type="text" name="buscar" class="form-control" placeholder="Buscar por nombre..."
                value="{{ $buscar }}">
        </div>
        <div class="col-md-4">
            <select name="categoria" class="form-select">
                <option value="">Todas las categorías</option>
                @foreach ($categorias as $cat)
                    <option value="{{ $cat }}" {{ $categoria == $cat ? 'selected' : '' }}>{{ $cat }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4">
            <button type="submit" class="btn btn-primary"><i class="bi bi-search"></i> Filtrar</button>
            <a href="{{ route('productos.index') }}" class="btn btn-secondary"><i class="bi bi-arrow-counterclockwise"></i>
                Limpiar</a>
        </div>
    </form>

    {{-- Tabla de Productos --}}
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Categoría</th>
                            <th>Precio</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($productos as $producto)
                            <tr>
                                <td>{{ $producto['id'] }}</td>
                                <td>{{ $producto['nombre'] }}</td>
                                <td><span class="badge bg-secondary">{{ $producto['categoria'] }}</span></td>
                                <td>$ {{ number_format($producto['precio'], 2) }}</td>
                                <td class="text-center">
                                    <a href="{{ route('productos.edit', $producto['id']) }}"
                                        class="btn btn-warning btn-sm">
                                        <i class="bi bi-pencil-square"></i> Editar
                                    </a>
                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#deleteModal{{ $producto['id'] }}">
                                        <i class="bi bi-trash"></i> Eliminar
                                    </button>

                                    {{-- Modal de Eliminación --}}
                                    <div class="modal fade" id="deleteModal{{ $producto['id'] }}" tabindex="-1">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Confirmar eliminación</h5>
                                                    <button type="button" class="btn-close"
                                                        data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body text-start">
                                                    ¿Estás seguro de que deseas eliminar el producto
                                                    <strong>{{ $producto['nombre'] }}</strong>?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Cancelar</button>
                                                    <form action="{{ route('productos.destroy', $producto['id']) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Sí, eliminar</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">No se encontraron productos.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

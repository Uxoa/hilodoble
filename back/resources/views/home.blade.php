@extends('layouts.app')

@section('content')

    <div class="container">
        <h1>Bienvend@ a nuestra tienda!</h1>
        <p>Hola Administrador! Puedes ver tus productos en la lista y crear uno nuevo.</p>
        @if (session('success'))
    <div class="alert alert-success"><br>
        {{ session('success') }}
    </div>
@endif

        <div class="mb-3">
            <a href="{{ route('items.create') }}" class="btn btn-primary">Create Item</a>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Categoría</th>
                    <th>Descripción</th>
                    <th>Imagen</th>
                    <th>Stock</th>
                    <th>Vendidos</th>
                    <th>Precio</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $item)
                    <tr>
                        <td>{{ $item->itemName }}</td>
                        <td>{{ $item->category }}</td>
                        <td>{{ $item->description }}</td>
                        <td><img src="{{ asset($item->image) }}" alt="{{ $item->itemName }}" class="img-thumbnail" style="max-width: 100px;"></td>
                        <td>{{ $item->stockQuantity }}</td>
                        <td>{{ $item->purchaseQuantity }}</td>
                        <td>{{ $item->price }}</td>
                        <td>
                            <a href="{{ route('items.show', $item->id) }}" class="btn btn-info btn-sm">VER</a><br>
                            <a href="{{ route('editItem',['id'=>$item->id]) }}" class="btn btn-success btn-sm">EDITAR</a><br>
                            <form action="{{ route('items.destroy', $item->id) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Estás seguro de querer borrar este producto?')">BORRAR</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>

    
</div>
@endsection
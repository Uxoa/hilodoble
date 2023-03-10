@extends('layouts.app')

@section('template_title')
    Update Item
@endsection

@section('content')
<div class="container">
    <h1>Edit Item</h1>
    <form method="POST" action="{{ route('updateItem', $item->id) }}" enctype="multipart/form-data">
        @csrf
        {{ method_field('PATCH') }}

        <div class="form-group">
            <label for="itemName">Item Name</label>
            <input type="text" name="itemName" id="itemName" class="form-control{{ $errors->has('itemName') ? ' is-invalid' : '' }}" value="{{ $item->itemName }}" required>
            @if ($errors->has('itemName'))
                <span class="invalid-feedback">{{ $errors->first('itemName') }}</span>
            @endif
        </div>

        <div class="form-group">
            <label for="category">Category</label>
            <input type="text" name="category" id="category" class="form-control{{ $errors->has('category') ? ' is-invalid' : '' }}" value="{{ $item->category }}" required>
            @if ($errors->has('category'))
                <span class="invalid-feedback">{{ $errors->first('category') }}</span>
            @endif
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" rows="5" required>{{ $item->description }}</textarea>
            @if ($errors->has('description'))
                <span class="invalid-feedback">{{ $errors->first('description') }}</span>
            @endif
        </div>

        <div class="form-group">
            <label for="image">Image URL</label>
            <input type="url" name="image" id="image" class="form-control{{ $errors->has('image') ? ' is-invalid' : '' }}" value="{{ $item->image }}" required>
            @if ($errors->has('image'))
                <span class="invalid-feedback">{{ $errors->first('image') }}</span>
            @endif
        </div>

        <div class="form-group">
            <label for="stockQuantity">Stock Quantity</label>
            <input type="number" name="stockQuantity" id="stockQuantity" class="form-control{{ $errors->has('stockQuantity') ? ' is-invalid' : '' }}" value="{{ $item->stockQuantity }}" min="0" required>
            @if ($errors->has('stockQuantity'))
                <span class="invalid-feedback">{{ $errors->first('stockQuantity') }}</span>
            @endif
        </div>

        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" name="price" id="price" class="form-control{{ $errors->has('price') ? ' is-invalid' : '' }}" value="{{ $item->price }}" min="0" required>
            @if ($errors->has('price'))
                <span class="invalid-feedback">{{ $errors->first('price') }}</span>
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Save</button>
        <a href="{{ route('home') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>

@endsection
@extends('layouts.app')


@section('content')
    <div class ="text-center" style="border:solid 3px black; width:1000px; height:630px; margin:auto; padding; 20px">
        <h1 style="padding-top:20px">{{$item->itemName}}</h1>
        <img src="{{$item->image}}" alt="foto del producto" style="width:330px; border:solid 4px #50087d">
        <div style="padding:30px">
            <h2 style="padding:10px">Categoría:{{$item->category}}</h2>
            <h3>{{$item->description}}</h3>
            <h4>Precio: {{$item->price}}€</h4>
            <h4>{{$item->stockQuantity}} Unidades disponibles</h4>
        </div>
        <a href="{{ route('home') }}" class="btn btn-outline-secondary">Volver</a><br>
    </div>
@endsection

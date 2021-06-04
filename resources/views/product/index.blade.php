@extends('layout.app')

@section('content')
<div class="container p-4">
    <a href="{{route('products.create')}}" class="btn btn-outline-primary mb-5 p-2"><i class="fas fa-plus"></i></a>
    <div class="card" style="width: 18rem;">
    @foreach ($products as $product)
        <div class="card-body">
            <h5 class="card-title text-center">{{$product->name}}</h5>
                <ul>
                    <li><span>Cantidad: </span> {{$product->stock}}</li>
                    <li><span>Precio: </span>{{$product->price}}</li>
                    <li><span>Categoria: </span>{{$product->category}}</li>
                </ul>
                <h4 class="text-center">Actions</h4>
                <div class="container-actions d-flex justify-content-center">
                    <a href="{{route('products.show',$product)}}" class="btn mx-1 icon-material"><i class="fas fa-eye"></i></a>
                    <a href="{{route('products.edit',$product)}}" class="btn mx-1 icon-material"><i class="far fa-edit"></i></a>
                    <form action="{{route('products.destroy', $product)}}" method="post" class="mx-1">
                        @csrf
                        @method('DELETE')
                        <button class="btn icon-material"><i class="far fa-trash-alt"></i></button>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
    <!-- <table class="table border border-1 text-center shadow p-1">
        <thead class="thead-background text-white">
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Name</th>
                <th scope="col">Stock</th>
                <th scope="col">Price</th>
                <th scope="col">Category</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <th>{{$product->id}}</th>
                    <td>{{$product->name}}</td>
                    <td>{{$product->stock}}</td>
                    <td>{{$product->price}}</td>
                    <td>{{$product->category}}</td>
                    <td class="d-flex justify-content-center">
                        <a href="{{route('products.show',$product)}}" class="btn mx-1 icon-material"><i class="fas fa-eye"></i></a>
                        <a href="{{route('products.edit',$product)}}" class="btn mx-1 icon-material"><i class="far fa-edit"></i></a>
                        <form action="{{route('products.destroy', $product)}}" method="post" class="mx-1">
                            @csrf
                            @method('DELETE')
                            <button class="btn icon-material"><i class="far fa-trash-alt"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table> -->


</div>
@endsection
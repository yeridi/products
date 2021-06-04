@extends('layout.app')

@section('content')
<div class="card col-md-4 m-auto mt-5 shadow p-3">
    <div class="card-body">
    <h2 class="text-center mt-3">Editing Product {{$product->name}}</h2>
    <form action="{{route('products.update', $product)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text" name="name" class="form-control" value="{{$product->name}}">
            </div>
            <div class="mb-3">
                <label class="form-label">Stock</label>
                <input type="number" name="stock" class="form-control" value="{{$product->stock}}">
            </div>
            <div class="mb-3">
                <label class="form-label">Price</label>
                <input type="number" name="price" class="form-control" step="any"  value="{{$product->price}}">
            </div>
            <div class="mb-3">
                <label class="form-label">Category</label>
                <input type="text" name="category" class="form-control" value="{{$product->category}}">
            </div>
            <div>
                <div class="d-flex justify-content-between">
                    <label>Images</label>
                    <div class="icon-material">
                        <i class="fas fa-plus" id="addIcon"></i>
                    </div>
                </div>
                <div id="image-container">
                    @foreach ($product->Images as $image)
                    <div class="my-3 images">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="w-100 ">
                                <input class="form-control" name="files[][file]" type="file">
                                <input type="hidden" name="files[][hidden]" value="{{$image->url}}">
                            </div>
                            <i class="fas fa-times remove mx-2 text-danger"></i>
                        </div>
                        <label for="" >
                            <span>Name: </span>
                            <span>{{basename($image->url)}}</span>
                        </label>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="d-flex justify-content-center">
                <button class="btn btn-outline-success mx-1" type="submit">Update</button>
                <a class="btn btn-outline-secondary mx-1" href="{{route('products.index')}}">Cancel</a>
            </div>
            <hr>
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul>
                       @foreach ($errors->all() as $error)
                           <li>{{$error}}</li>
                       @endforeach 
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </form>
    </div>  
</div>
@endsection
@push('js')
    <script>
        const imgC = document.querySelector("#image-container");
        const addIcon = document.querySelector("#addIcon");
        let inputs = document.querySelectorAll("input[type=file]").length;
        document.querySelectorAll(".remove").forEach(element => {
            element.addEventListener('click',() => {
                element.parentElement.parentElement.remove()
            });
        });
        const addImg = () => {
            inputs++;
            imgC.innerHTML += `
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="w-100 ">
                    <input class="form-control" name="files[][file]" type="file">
                </div>
                <i class="fas fa-times remove mx-2 text-danger"></i>
            </div>
            `;
            document.querySelectorAll('.remove').forEach(element => element.addEventListener('click', () => element.parentElement.remove()));
        }
        addIcon.addEventListener('click',addImg);
        const inputsImages = document.querySelectorAll('.images');
        inputsImages.forEach(inputImage => {
            const input = inputImage.querySelector('input[type=file]');
            input.addEventListener('change', () => {
                
                // console.log(input.value);
            });
            // console.log(input);
        });
    </script>
@endpush
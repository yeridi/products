@extends('layout.app')

@section('content')
<div class="row align-items-center justify-content-evenly">
    <div class="col-md-4">
        <div class="card mt-4 shadow p-2">
            <div class="text-center mt-3">
                <h2>Create a New Product</h2>
            </div>
            <div class="car-body">
            <br>
                <form action="{{route('products.store')}}" method="POST" class="p-4" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" name="name" class="form-control" value="{{old('name')}}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Stock</label>
                        <input type="number" name="stock" class="form-control" value="{{old('stock')}}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Price</label>
                        <input type="number" name="price" class="form-control" step="any" value="{{old('price')}}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Category</label>
                        <input type="text" name="category" class="form-control" value="{{old('category')}}">
                    </div>
                    {{-- <div class="mb-3">
                        <label for="formFile" class="form-label">Image</label>
                        <input class="form-control" name="file" type="file" id="formFile">
                    </div> --}}
                    <div>
                        <div class="d-flex justify-content-between">
                            <label>Images</label>
                            <div class="icon-material">
                                <i class="fas fa-plus" id="addIcon"></i>
                            </div>
                        </div>
                        <div id="image-container">

                        </div>
                    </div>
                    <div class="d-flex justify-content-center index">
                        <button class="btn btn-primary mx-1 d-block" type="submit">Create</button>
                        <a class="btn btn-outline-secondary mx-1 d-block" href="{{route('products.index')}}">Cancel</a>
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
    </div>
</div>    
@endsection

@push('js')
    <script>
        const imgC = document.querySelector("#image-container");
        const addIcon = document.querySelector("#addIcon");
        const addImg = () => {
            imgC.innerHTML += `
            <div class="d-flex justify-content-between align-items-center my-3">
                <div class="w-100 ">
                    <input class="form-control" name="files[]" type="file">
                </div>
                <i class="fas fa-times remove mx-2 text-danger"></i>
            </div>
            `;
            document.querySelectorAll('.remove').forEach(element => element.addEventListener('click', () => element.parentElement.remove()));
        }
        
        addIcon.addEventListener('click',addImg);
    </script>
@endpush

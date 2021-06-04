@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="card">
            <div class="card-header">Restaurar contraseña</div>
            <div class="card-body">
                <form action="{{route('update.password',$user)}}" method="post" >
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label >Password</label>
                        <input type="password" name="password" class="form-control">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Password confirm</label>
                        <input type="password" name="password_confirmation" class="form-control">
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary mx-0">Actualizar</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
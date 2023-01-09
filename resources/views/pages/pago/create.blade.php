@php
    use App\Enums\UnidadesEnum;
@endphp


@extends('template.template')

@section('content')
    <form action="{{route('cliente.store')}}" method="post">
        @csrf
        <div class="form-group">
            <label for="razon_social_input">Razón Social</label>
            <input type="text" name="razon_social" id="razon_social_input" value="{{old('razon_social')}}" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="nit_input">Nit</label>
            <input type="text" name="nit" id="nit_input" value="{{old('nit')}}" class="form-control">
        </div>
        <div class="form-group">
            <label for="direccion_input">Dirección</label>
            <input type="text" name="direccion" id="direccion_input" value="{{old('direccion')}}" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="correo_input">Correo</label>
            <input type="text" name="correo" id="correo_input" value="{{old('correo')}}" class="form-control">
        </div>
        <div class="form-group">
            <label for="telefono_input">Teléfono</label>
            <input type="text" name="telefono" id="telefono_input" value="{{old('telefono')}}" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Crear</button>
    </form>
@endsection
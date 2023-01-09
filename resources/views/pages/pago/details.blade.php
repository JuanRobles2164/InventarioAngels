@php
    use App\Enums\UnidadesEnum;
@endphp

@extends('template.template')

@section('content')

    <a href="{{route('material.index')}}" class="btn btn-danger mt-5">Volver</a>

    <form action="{{route('material.update', $material->id)}}" class="mt-5" method="POST">
        @csrf
        {{ method_field('PATCH') }}
        <div class="form-group">
            <label for="razon_social_input">Razón Social</label>
            <input type="text" name="razon_social" id="razon_social_input" value="{{old('razon_social')}}" class="form-control" required value="{{$cliente->razon_social}}">
        </div>
        <div class="form-group">
            <label for="nit_input">Nit</label>
            <input type="text" name="nit" id="nit_input" value="{{old('nit')}}" class="form-control" value="{{$cliente->nit}}">
        </div>
        <div class="form-group">
            <label for="direccion_input">Dirección</label>
            <input type="text" name="direccion" id="direccion_input" value="{{old('direccion')}}" class="form-control" required value="{{$cliente->direccion}}">
        </div>
        <div class="form-group">
            <label for="correo_input">Correo</label>
            <input type="text" name="correo" id="correo_input" value="{{old('correo')}}" class="form-control" value="{{$cliente->correo}}">
        </div>
        <div class="form-group">
            <label for="telefono_input">Teléfono</label>
            <input type="text" name="telefono" id="telefono_input" value="{{old('telefono')}}" class="form-control" value="{{$cliente->telefono}}">
        </div>
        <button type="submit" class="btn btn-warning" disabled>Editar</button>
    </form>
@endsection

@push('js')
    <script>
        $(document).ready(function(){
            let selectElement = document.getElementById("unidad_input");
            selectElement.value  = "{{$material->unidad}}";
        });
    </script>
@endpush

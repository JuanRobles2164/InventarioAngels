@php
    use App\Enums\UnidadesEnum;
@endphp


@extends('template.template')

@section('content')
    <a href="{{route('cliente.index')}}" class="btn btn-danger mt-5">Volver</a>

    <form action="{{route('cliente.update', $cliente->id)}}" method="POST" class="mt-5">
        @csrf
        {{ method_field('PATCH') }}
        <input type="hidden" name="id" id="id_input" value="{{$cliente->id}}">
        <div class="form-group">
            <label for="razon_social_input">Razón Social</label>
            <input type="text" name="razon_social" id="razon_social_input" class="form-control" required value="{{$cliente->razon_social}}">
        </div>
        <div class="form-group">
            <label for="nit_input">Nit</label>
            <input type="text" name="nit" id="nit_input" class="form-control" value="{{$cliente->nit}}">
        </div>
        <div class="form-group">
            <label for="direccion_input">Dirección</label>
            <input type="text" name="direccion" id="direccion_input" class="form-control" required value="{{$cliente->direccion}}">
        </div>
        <div class="form-group">
            <label for="correo_input">Correo</label>
            <input type="text" name="correo" id="correo_input" class="form-control" value="{{$cliente->correo}}">
        </div>
        <div class="form-group">
            <label for="telefono_input">Teléfono</label>
            <input type="text" name="telefono" id="telefono_input" class="form-control" value="{{$cliente->telefono}}">
        </div>
        <button type="submit" class="btn btn-warning">Editar</button>
    </form>
@endsection

@push('js')
    <script>
        $(document).ready(function(){

        });
    </script>
@endpush

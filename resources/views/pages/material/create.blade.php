@php
    use App\Enums\UnidadesEnum;
@endphp


@extends('template.template')

@section('content')
    <form action="{{route('material.store')}}" method="post">
        @csrf
        <div class="form-group">
            <label for="nombre_input">Nombre</label>
            <input type="text" name="nombre" id="nombre_input" value="{{old('nombre')}}" class="form-control">
        </div>

        <div class="form-group">
            <label for="descripcion_input">Descripción</label>
            <textarea name="descripcion" id="descripcion_input" class="form-control" cols="30" rows="10">{{old('descripcion')}}</textarea>
        </div>

        <div class="form-group">
            <label for="nombre_input">Unidad</label>
            <select name="unidad" id="unidad_input" value="{{old('unidad')}}" class="form-control">
                @foreach (UnidadesEnum::getEnum() as $key => $val)
                    <option value="{{$key}}">{{$val}}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Crear</button>
    </form>
@endsection
@extends('template.template')

@section('content')
    <form action="{{route('material.update', $material->id)}}" method="POST">
        @csrf
        {{ method_field('PATCH') }}
        <input type="hidden" name="id" id="id_input" value="{{$material->id}}">
        <div class="form-group">
            <label for="nombre_input">Nombre</label>
            <input type="text" name="nombre" id="nombre_input" value="{{$material->nombre}}" disabled>
        </div>

        <div class="form-group">
            <label for="descripcion_input">Descripción</label>
            <textarea name="descripcion" id="descripcion_input" cols="30" rows="10" disabled>{{$material->descripcion}}</textarea>
        </div>

        <div class="form-group">
            <label for="nombre_input">Unidad</label>
            <select name="unidad" id="unidad_input" value="{{$material->unidad}}" disabled>
                @foreach (UnidadesEnum::getEnum() as $key => $val)
                    <option value="{{$key}}">{{$val}}</option>
                @endforeach
            </select>
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

@extends('template.template')

@section('content')
    <form action="{{route('kardex.store')}}" method="post" class="mt-5">
        @csrf
        <div class="form-group">
            <label for="material_id_input" class="form-label">Material: </label>
            <select name="material_id" id="material_id_input" class="form-control">
                @foreach ($materiales as $m)
                    <option value="{{$m->id}}">{{$m->nombre}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="tipo_movimiento_id_input" class="form-label">Tipo de Movimiento: </label>
            <select name="tipo_movimiento_id" id="tipo_movimiento_id_input" class="form-control">
                @foreach ($tipos_movimiento as $tp)
                    <option value="{{$tp->id}}">{{$tp->nombre}} - {{($tp->razon == -1 ? 'Salida' : 'Entrada')}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="cantidad_input" class="form-label">Cantidad:</label>
            <input type="number" name="cantidad" id="cantidad_input" class="form-control">
        </div>

        <button class="btn btn-primary" type="submit">Crear</button>
    </form>
@endsection
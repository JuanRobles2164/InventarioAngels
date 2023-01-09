@php
    use App\Enums\UnidadesEnum;
@endphp

@extends('template.template')
@section('content')
<div class="mt-5">
    <a href="{{route('material.create')}}" class="btn btn-primary">Crear</a>

    <table class="table mt-5">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Descripcion</th>
                <th>Unidad</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($materiales as $m)
                <tr>
                    <td>{{$m->nombre}}</td>
                    <td>{{$m->descripcion}}</td>
                    <td>{{UnidadesEnum::getEnum()[$m->unidad]}}</td>
                    <td>
                        <a href="{{route('material.show', $m->id)}}">Detalles</a>
                        <a href="{{route('material.edit', $m->id)}}">Editar</a>
                        <a href="{{route('material.destroy', $m->id)}}">Eliminar</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
@extends('template.template')

@section('content')
<div class="mt-5">
    <a href="{{route('kardex.create')}}" class="btn btn-primary">Crear</a>
    <table class="table mt-5">
        <thead>
            <tr>
                <th>Material</th>
                <th>Cantidad</th>
                <th>Cantidad restante</th>
                <th>Tipo de movimiento</th>
                <th>Razon</th>
                <th>Fecha</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($kardexes as $k)
                <tr>
                    <td>{{$k->material()->nombre}}</td>
                    <td>{{$k->cantidad}}</td>
                    <td>{{$k->cantidad_total}}</td>
                    <td>{{$k->tipo_movimiento()->nombre}}</td>
                    <td>{{$k->tipo_movimiento()->razon == -1 ? 'SALIDA' : 'ENTRADA'}}</td>
                    <td>{{$k->created_at}}</td>
                    <td>
                        <a href="#" class="btn btn-warning">Detalles</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
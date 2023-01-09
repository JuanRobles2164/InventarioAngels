@extends('template.template')
@section('content')
<div class="mt-5">
    <a href="{{route('venta.create')}}" class="btn btn-primary">Crear</a>
    <table class="table mt-5">
        <thead>
            <tr>
                <th>Material</th>
                <th>Factura Numero</th>
                <th>Total</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($ventas as $v)
                <tr>
                    <td>{{$v->material()->nombre}}</td>
                    <td>{{$v->factura()->numero}}</td>
                    <td>{{$v->total}}</td>
                    <td>{{$v->estado}}</td>
                    <td>
                        <a href="#">Detalles</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
@extends('template.template')
@section('content')
<div class="mt-5">
    <a href="{{route('cliente.create')}}" class="btn btn-primary">Crear</a>

    <table class="table mt-5">
        <thead>
            <tr>
                <th>Factura</th>
                <th>Cliente</th>
                <th>Total a pagar</th>
                <th>Restante</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pagos as $p)
                <tr>
                    <td>{{$p->factura()->numero}}</td>
                    <td>{{$p->cliente()->razon_social}}</td>
                    <td>{{$p->monto}}</td>
                    <td>{{$p->restante}}</td>
                    <td>
                        <a href="{{route('cliente.show', $p->id)}}">Detalles</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
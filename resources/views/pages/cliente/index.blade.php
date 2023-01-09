@extends('template.template')
@section('content')
<div class="mt-5">
    <a href="{{route('cliente.create')}}" class="btn btn-primary">Crear</a>

    <table class="table mt-5">
        <thead>
            <tr>
                <th>Razon social</th>
                <th>Nit</th>
                <th>Direccion</th>
                <th>Correo</th>
                <th>Telefono</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($clientes as $c)
                <tr>
                    <td>{{$c->razon_social}}</td>
                    <td>{{$c->nit}}</td>
                    <td>{{$c->direccion}}</td>
                    <td>{{$c->correo}}</td>
                    <td>{{$c->telefono}}</td>
                    <td>
                        <a href="{{route('cliente.show', $c->id)}}">Detalles</a>
                        <a href="{{route('cliente.edit', $c->id)}}">Editar</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
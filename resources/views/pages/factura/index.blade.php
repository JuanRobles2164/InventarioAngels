@php
    use App\Enums\UnidadesEnum;
@endphp

@extends('template.template')
@section('content')

@if($errors->any())
    @foreach ($errors->all() as $error)
        <div>{{ $error }}</div>
    @endforeach
@endif

<div class="mt-5">
    <a href="{{route('factura.create')}}" class="btn btn-primary">Crear</a>

    <table class="table mt-5">
        <thead>
            <tr>
                <th>Numero</th>
                <th>Fecha</th>
                <th>Fecha Pago</th>
                <th>Total</th>
                <th>Cliente</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($facturas as $f)
                <tr>
                    <td>{{$f->numero}}</td>
                    <td>{{$f->fecha}}</td>
                    <td>{{$f->fecha_pago}}</td>
                    <td>{{$f->total}}</td>
                    <td>{{$f->cliente()->razon_social}}</td>
                    <td>
                        <a href="{{route('factura.show', $f->id)}}" target="_blank" class="btn btn-primary">Detalles</a>
                        <!-- Si la factura está recien creada -->
                        @if ($f->estado == 4)
                            <a href="{{route('factura.validar', $f->id)}}" class="btn btn-danger">Validar</a>
                        @endif
                    </td>

                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="row mt-3">
        {{$facturas->links('components.paginador')}}
    </div>
</div>
@endsection
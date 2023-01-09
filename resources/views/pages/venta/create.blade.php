@extends('template.template')

@section('content')
    <form action="{{route('venta.create')}}" method="post">
        @csrf
        
    </form>
@endsection
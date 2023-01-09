@php
    use Carbon\Carbon;
@endphp

@extends('template.template_reportes')

@section('content')

    <div class="row mt-4">
        <form action="{{route('reportes.facturas')}}">
            <div class="row form-group">
                <input type="date" name="fecha_inicio" id="fecha_inicio_input" class="form-input col-4">
                <span>-</span>
                <input type="date" name="fecha_fin" id="fecha_fin_input" class="form-input col-4">
                <button type="submit" class="btn btn-primary col-3">Buscar</button>
            </div>
        </form>
    </div>

    @foreach ($graficos->chunk(2) as $c)
        <div class="row">
        @foreach ($c as $g)
        @if (count($c) == 2)
            <div class="col-6 card">
                <canvas id="{{$g->nombreId}}"></canvas>
            </div>
        @else
            <div class="col-12 card">
                <canvas id="{{$g->nombreId}}"></canvas>
            </div>
        @endif

        @endforeach
        </div>
    @endforeach
  
@endsection

@push('js')
    <script>
        let graficos = {{ Illuminate\Support\Js::from($graficos) }};
        graficos.forEach((el) => {
            createChartInstance(el.nombreId, el);
        })
        function onlyUnique(value, index, self) {
            return self.indexOf(value) === index;
        }

        function createChartInstance(idElement, data){
            console.log(data);
            console.log(idElement);
            data.data.labels = data.data.labels.filter(onlyUnique);

            const ctx = document.getElementById(idElement+"");
            const chart = new Chart(ctx, data);
        }
  </script>
@endpush
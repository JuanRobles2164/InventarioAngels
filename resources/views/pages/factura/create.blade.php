@extends('template.template')

@section('content')
    <form action="{{route('factura.store')}}" method="post" class="mt-5">
        @csrf
        <div class="form-group">
            <label for="nombre_input">¿Pagado?</label>
            <input type="checkbox" name="pago" id="pago_input" value="{{old('pago')}}" class="form-control">
        </div>
        <div class="form-group">
            <label for="cliente_input">Cliente:</label>
            <select name="cliente" id="cliente_input" class="form-control" value={{old('cliente')}}>
                @foreach ($clientes as $c)
                    <option value="{{$c->id}}">{{$c->razon_social}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="tbody_materiales">Seleccione los productos</label>
            <table style="border:5px double black;">
                <tbody id="tbody_materiales">
                    <select name="select_materiales" id="select_materiales_input">
                        @foreach ($materiales as $m)
                        <option value="{{json_encode($m)}}">{{$m->nombre}}</option>
                        @endforeach
                    </select>
                </tbody>
            </table>
            <a href="#" class="btn btn-primary" onclick="agregarProducto()">Agregar</a>
        </div>

        <div class="class mt-3">
            <table class="table">
                <thead>
                    
                    <tr>
                        <td>Nombre</td>
                        <td>Cantidad</td>
                        <td>Valor Unitario</td>
                        <td>Total</td>
                        <td></td> 
                    </tr>
                    
                </thead>
                <tbody id="listaMaterialesFactura">
                </tbody>
            </table>
        </div>
        <button type="submit" class="btn btn-primary">Crear</button>
    </form>
@endsection

@push('js')
    <script>
        function getCurrentTimestamp() {
            return Date.now()
        }

        function agregarProducto(){
            let selectInput = document.getElementById("select_materiales_input");
            let selectedValue = selectInput.value;
            let timestamp = getCurrentTimestamp();
            let elementoNuevoPlantilla = 
                    `<tr id=":timestamp_id">
                        <td>
                            :nombre
                            <input type="hidden" name="material_id[]" value=":material_id">
                        </td>
                        <td>
                            <input type="number" required name="cantidad_material[]" class="form-control" id="c_:timestamp" oninput="calcularTotal(':timestamp')">
                        </td>
                        <td>
                            <input type="number" required name="valor_unitario_material[]" class="form-control" id="vu_:timestamp" oninput="calcularTotal(':timestamp')">
                        </td>
                        <td>
                            <input type="number" name="total[]" class="form-control" id="total_:timestamp" disabled>
                        </td>
                        <td>
                            <a href="#" onclick="quitarElemento(':timestamp_id')" class="btn btn-danger">X</a>
                        </td> 
                    </tr>`;
            let elementoNuevo = ""+elementoNuevoPlantilla.replace(/:timestamp_id/g, timestamp+"")
                                                    .replace(/:timestamp/g, timestamp+"")
                                                    .replace(":material_id", JSON.parse(selectedValue).id)
                                                    .replace(/:nombre/g, JSON.parse(selectedValue).nombre);
            let elementoDestino = document.getElementById("listaMaterialesFactura");
            elementoDestino.innerHTML = elementoDestino.innerHTML + elementoNuevo;
        }

        function calcularTotal(timestamp){
            let elemCantidad = document.getElementById("c_"+timestamp);
            let elemValorUnitario = document.getElementById("vu_"+timestamp);
            let elemTotal = document.getElementById("total_"+timestamp);
            
            if(( !isNaN(elemCantidad.value) && elemCantidad.value != 0) && (!isNaN(elemValorUnitario.value) && elemValorUnitario.value != 0)){
                elemTotal.value = parseFloat(elemCantidad.value) * parseFloat(elemValorUnitario.value);
            }else{
                elemTotal.value = 0.0;
            }
        }

        function quitarElemento(idElemento){
            let elemento = document.getElementById(idElemento);
            elemento.remove();
        }
    </script>
@endpush
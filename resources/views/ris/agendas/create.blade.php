@extends('layouts.plantillaFormularios')

@push('css')
<link href="/assets/js/plugins/timepicker/bootstrap-timepicker.min.css" rel="stylesheet">

@endpush
@section('title','Crear Agendas')

@section('nombrevista','Agendas')
@section('hrefformulario')
{{route('risagendas.index')}}
@endsection

@section('tituloformulario','Agendas')
@section('principalformulario','AGENDAS')
@section('accionformulario','CREAR')
@section('descripcionformulario','Crear Nueva Agenda')
@section('classformulario','card')



@section('content') 

    <livewire:crearagendas-component>


      
@endsection


@push('scripts')

<script src="/assets/js/plugins/timepicker/bootstrap-timepicker.min.js"></script>


<script>
    $('#horainicial').timepicker({
        minuteStep:10,
        showMeridian:false,
        icons:  {
            up: 'fa fa-angle-up',
            down: 'fa fa-angle-down'
        }
    });

    $('#horafinal').timepicker({
        minuteStep:10,
        showMeridian:false,
        icons:  {
            up: 'fa fa-angle-up',
            down: 'fa fa-angle-down'
        }
    });






  </script>

@endpush



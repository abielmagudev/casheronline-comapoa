@extends('aplicacion')
@section('contenido')
<div class="card shadow">
    <div class="card-header py-3">
        <b class="text-uppercase">Ayuda</b>
    </div>
    <div class="card-body">
    @foreach($acordiones as $carpeta => $vistas )
        <?php $title_accordion = str($carpeta)->replace('_', ' ')->ucfirst() ?>
        <p class="h6">{{ $title_accordion }}</p>
        
        <?php $parent_accordion = sprintf('accordion%sAyuda', str($carpeta)->studly()) ?>
        <div class="accordion accordion-flush" id="accordion{{ str($carpeta)->studly() }}Ayuda">
        @foreach($vistas as $vista)
            @include("ayuda.{$carpeta}.{$vista}")
        @endforeach  
        </div>

        @if(! $loop->last ) 
        <hr class="my-4" style='color:#AAA'>
        @endif

    @endforeach
    </div>
</div>
@include('componentes.modal-terminos-condiciones')
@endsection

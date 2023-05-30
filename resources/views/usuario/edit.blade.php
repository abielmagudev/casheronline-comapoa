@extends('aplicacion')
@section('contenido')
<div class="card shadow">
    <div class="card-header py-3">
        <b class="text-uppercase">Mi configuración</b>
    </div>
    <div class="card-body">
        <ul class="nav nav-tabs" id="configuracionTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="identificación-tab" data-bs-toggle="tab" data-bs-target="#identificación-tab-pane" type="button" role="tab" aria-controls="identificación-tab-pane" aria-selected="true">Identificación</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="contrasena-tab" data-bs-toggle="tab" data-bs-target="#contrasena-tab-pane" type="button" role="tab" aria-controls="contrasena-tab-pane" aria-selected="false">Contraseña</button>
            </li>
        </ul>
        <div class="tab-content" id="configuracionTabsContent">
            @include('usuario._edit-identificacion')
            @include('usuario._edit-contrasena')
        </div>
    </div>
</div>
<script>const tabActivator={hash:window.location.hash,tab:function(){return document.querySelector(this.hash+"-tab")},fire:function(){this.tab().click()},listen:function(){if(this.tab()){let t=this.tab();document.addEventListener("DOMContentLoaded",function(){t.click()})}}};tabActivator.listen();</script>

<?php
/*
<script>
const tabActivator = {
    hash: window.location.hash,
    tab: function () {
        return document.querySelector( this.hash + '-tab' );
    },
    fire: function () {
        this.tab().click();
    },
    listen: function () {
        if( this.tab() )
        {
            let tab = this.tab()
            document.addEventListener('DOMContentLoaded', function () {
                tab.click()
            });
            //document.addEventListener('DOMContentLoaded', this.fire.bind(this), false);
        }
    }
}
tabActivator.listen()
</script>
*/
?>
@include('components.script-remove-invalid')
@endsection

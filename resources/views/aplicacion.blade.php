<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="shortcut icon" href="https://www.comapanuevolaredo.gob.mx/sitio/wp-content/themes/comapa-nuevo-laredo/images/favicon.ico" type="image/x-icon">
    <title>{{ config('app.name') }} - COMAPA NUEVO LAREDO</title>
    <style>
        :root {
            --comapa-color:<?= $colores->comapa ?>;
            --comapa-primary:<?= $colores->primary ?>;
            --comapa-secondary:<?= $colores->secondary ?>;
            --comapa-success:<?= $colores->success ?>;
            --comapa-warning:<?= $colores->warning ?>;
            --comapa-danger:<?= $colores->danger ?>;
            --comapa-info:<?= $colores->info ?>;
        }
        .bg-comapa {
            background-color: var(--comapa-color);
        }
        .bg-comapa-gradient {
            background: rgb(120,27,50);
            background: linear-gradient(131deg, rgba(120,27,50,1) 0%, rgba(159,25,58,1) 100%);
        }
        .text-comapa {
            color: var(--comapa-color);
        }
    </style>
</head>
<body style='background-color:#DDDDDD'>
@if(! mantenimiento()->activar )     
    @include('disenos.aviso')

    @auth
    @include('disenos.autenticado')

    @else
    @include('disenos.invitado')

    @endauth

@else
    <div class="position-fixed w-100">
        @include('disenos.aviso')
    </div>
    @include('disenos.modo-mantenimiento')

@endif
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
    <script>const tooltipTriggerList=document.querySelectorAll('[data-bs-toggle="tooltip"]'),tooltipList=[...tooltipTriggerList].map(t=>new bootstrap.Tooltip(t));</script>
    <?php
    /*
    <script>
        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
        const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
    </script>
    */
    ?>
</body>
</html>

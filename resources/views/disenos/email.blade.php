<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }}</title>
    <style>
		.main-content {
			font-size:1rem;
		}
		.title {
			font-size:2rem;
            margin:0;
		}
        .subtitle {
            font-size:1.2rem;
            margin-top:0;
        }
		.notification-success {
            background-color: <?= $colores->success_light ?>;
            border-radius:.33rem;
            padding:1rem;
        }
		.text-uppercase {
			text-transform: uppercase;
		}
    </style>
</head>
<body>
	<div class='main-content'>
		@yield('contenido')
	</div>
</body>
</html>

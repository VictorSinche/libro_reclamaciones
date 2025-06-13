<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Informe de Derivación</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 13px;
            color: #333;
            line-height: 1.5;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .titulo {
            font-size: 18px;
            font-weight: bold;
        }

        .section {
            margin-bottom: 15px;
        }

        .label {
            font-weight: bold;
        }

        .contenido {
            margin-top: 5px;
        }

        .editor-content * {
            font-family: Arial, sans-serif;
        }

        .editor-content h1,
        .editor-content h2,
        .editor-content h3 {
            margin-top: 10px;
        }

        .editor-content ul {
            padding-left: 20px;
        }

        .editor-content p {
            margin-bottom: 10px;
        }

        .editor-content img {
            max-width: 100%;
            height: auto;
            display: block;
            margin: 10px auto;
            border-radius: 4px;
            box-shadow: 0 0 5px rgba(0,0,0,0.1);
        }

    </style>
</head>
<body>

    <div class="header">
        <div class="titulo">Informe del Área Derivada</div>
        {{-- <p>ID de Derivación: {{ $derivacion->id }}</p> --}}
        <p>Fecha: {{ \Carbon\Carbon::parse($derivacion->fecha_derivacion)->format('d/m/Y') }}</p>
    </div>

    <div class="section">
        <div class="label">Área Responsable:</div>
        <div class="contenido">{{ $derivacion->area->nombre ?? '---' }}</div>
    </div>

    <div class="section">
        <div class="label">Reclamante:</div>
        <div class="contenido">{{ $derivacion->libroReclamacion->nombre_apellido }}</div>
    </div>

    <div class="section">
        <div class="label">Motivo:</div>
        <div class="contenido">{{ $derivacion->libroReclamacion->motivo_reclamo }}</div>
    </div>

    <div class="section">
        <div class="label">Informe redactado:</div>
        <div class="contenido editor-content">
            {!! $derivacion->informe !!}
        </div>
    </div>

</body>
</html>

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
            margin: 30px 40px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #ddd;
            padding-bottom: 10px;
        }

        .logo {
            width: 100px;
        }

        .titulo-container {
            text-align: right;
            flex-grow: 1;
        }

        .titulo {
            font-size: 18px;
            font-weight: bold;
            margin: 0;
        }

        .fecha {
            font-size: 12px;
            color: #555;
        }

        .section {
            margin-bottom: 20px;
        }

        .label {
            font-weight: bold;
            font-size: 14px;
            color: #222;
            margin-bottom: 3px;
        }

        .contenido {
            padding: 6px 10px;
            background-color: #f5f5f5;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .editor-content * {
            font-family: Arial, sans-serif;
        }

        .editor-content h1,
        .editor-content h2,
        .editor-content h3 {
            margin-top: 12px;
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
        <img src="{{ public_path('/uma/img/logo.png') }}" alt="Logo UMA" class="logo">
        <div class="titulo-container">
            <p class="titulo">Informe del Área Derivada</p>
            <p class="fecha">Fecha: {{ \Carbon\Carbon::parse($derivacion->fecha_derivacion)->format('d/m/Y') }}</p>
        </div>
    </div>

    <div class="section">
        <div class="label">Nombre del Reclamante:</div>
        <div class="contenido">{{ $derivacion->libroReclamacion->nombre_apellido }}</div>
    </div>

    <div class="section">
        <div class="label">Área Responsable Derivada:</div>
        <div class="contenido">{{ $derivacion->area->nombre ?? '---' }}</div>
    </div>

    <div class="section">
        <div class="label">Motivo del Reclamo:</div>
        <div class="contenido">{{ $derivacion->libroReclamacion->motivo_reclamo }}</div>
    </div>

    <div class="section">
        <div class="label">Informe Redactado:</div>
        <div class="contenido editor-content">
            {!! $derivacion->informe !!}
        </div>
    </div>

</body>
</html>

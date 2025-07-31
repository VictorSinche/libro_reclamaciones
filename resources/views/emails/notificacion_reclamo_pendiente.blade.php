<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Reclamo pendiente</title>
</head>
<body>
    <p>Hola,</p>

    <p>Se detectó que el siguiente reclamo aún no ha sido atendido desde hace más de 3 días:</p>

    <ul>
        <li><strong>ID del reclamo:</strong> {{ $derivacion->libroReclamacion->id }}</li>
        <li><strong>Nombre del reclamante:</strong> {{ $derivacion->libroReclamacion->nombre_apellido }}</li>
        <li><strong>Área derivada:</strong> {{ $derivacion->area->nombre ?? 'N/A' }}</li>
        <li><strong>Fecha de derivación:</strong> {{ $derivacion->created_at->format('d/m/Y') }}</li>
    </ul>

    <p>Por favor, revisar y atender este reclamo lo antes posible.</p>

    <p>Gracias.</p>
</body>
</html>

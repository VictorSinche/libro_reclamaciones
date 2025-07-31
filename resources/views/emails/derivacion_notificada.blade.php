<h2 style="font-size: 20px; font-weight: 600;">📩 Notificación de nueva hoja de reclamación derivada</h2>

<p>Estimado(a),</p>

<p>Se le informa que ha recibido una nueva hoja de reclamación asignada a su área para su atención correspondiente. A continuación, se detallan los datos principales del reclamo:</p>

<ul style="line-height: 1.6;">
    <li><strong>Reclamante:</strong> {{ $reclamo->nombre_apellido }}</li>
    <li><strong>Motivo del reclamo:</strong> {{ $reclamo->motivo_reclamo }}</li>
    <li><strong>Curso asociado:</strong> {{ $reclamo->nom_curso }}</li>
    {{-- <li><strong>Área asignada:</strong> {{ $area->nombre }}</li> --}}
</ul>

<p>Por favor, ingrese al sistema para revisar los detalles completos y proceder con el tratamiento adecuado de la solicitud.</p>
<a href="{{ url('/login') }}" style="display:inline-block; padding:10px 20px; background:#1e293b; color:#fff; text-decoration:none; border-radius:5px;">Ir al sistema</a>
<p style="margin-top: 20px;">Gracias por su atención.</p>

<hr>

<p style="font-size: 12px; color: #666;">Este mensaje ha sido generado automáticamente por el sistema de gestión de reclamos de la Universidad María Auxiliadora.</p>

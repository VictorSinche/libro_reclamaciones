@component('mail::message')
# ¡Hemos recibido tu reclamo!

Hola {{ $reclamo->nombre_apellido }},

Tu reclamo 
{{-- (ID: **{{ $reclamo->id }}**)  --}}
ha sido registrado con éxito el {{ $reclamo->created_at->format('d/m/Y H:i') }}.

@component('mail::panel')
**Motivo:** {{ $reclamo->motivo_reclamo }}

**Descripción:**  
{{ $reclamo->descripcion_reclamo }}
@endcomponent

Nos contactaremos contigo a la brevedad para informarte el estado de tu solicitud.

**Se ha adjuntado una copia en PDF de tu reclamo a este mensaje.**

Gracias por tu confianza.

Saludos,  
**Oficina de Atención**  
@endcomponent

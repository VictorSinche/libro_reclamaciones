@component('mail::message')
# 📥 Nuevo Reclamo Recibido

Se ha registrado un nuevo reclamo en el Libro de Reclamaciones.

Por favor, ingresa al sistema para revisar los detalles y realizar el seguimiento correspondiente.

@component('mail::button', ['url' => config('app.url') . '/login'])
Ver Reclamo
@endcomponent

Gracias por tu atención,  
**Área Legal – Universidad María Auxiliadora**
@endcomponent

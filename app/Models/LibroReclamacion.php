<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LibroReclamacion extends Model
{
    use HasFactory;

    protected $table = 'libro_reclamaciones';

    protected $fillable = [
        'tipo_reclamo_queja',
        'tipo_bien',
        'tipo_reclamante',
        'nombre_apellido',
        'tipo_documento',
        'nro_doc',
        'nro_cel',
        'telefono',
        'correo',
        'direccion',
        'ubicacion',
        'apoderado',
        'programa',
        'fecha_evento',
        'monto_reclamado',
        'nom_curso',
        'oficina_involucrado',
        'motivo_reclamo',
        'descripcion_reclamo',
        'pedido',
    ];

    public function derivaciones()
    {
        return $this->hasMany(Derivacion::class);
    }

    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    public function ultimaDerivacion()
    {
        return $this->hasOne(Derivacion::class)->latestOfMany();
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Derivacion extends Model
{
    use HasFactory;

    protected $table = 'derivaciones'; // 👈 solución clave

    protected $fillable = [
        'libro_reclamacion_id',
        'area_id',
        'estado',
        'comentario',
        'archivo',
        'fecha_derivacion'
    ];

    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    public function libroReclamacion()
    {
        return $this->belongsTo(LibroReclamacion::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable; // ✔️ CLAVE: usar esta clase base
use Illuminate\Notifications\Notifiable;

class UserAdmin extends Authenticatable
{
    use Notifiable;

    protected $table = 'users_admin'; // nombre real de tu tabla

    protected $fillable = [
        'nombre',
        'apellidos',
        'email',
        'genero',
        'grado',
        'estado',
        'password',
        'area_id'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // 👇 Opcional: nombre completo como atributo
    public function getFullNameAttribute()
    {
        return "{$this->nombre} {$this->apellidos}";
    }

    public function area()
    {
        return $this->belongsTo(Area::class);
    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LibroReclamacionesController extends Controller
{
    public function registro()
    {
        return view('libro_reclamaciones.registro_lire');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LibroReclamacion;
use Barryvdh\DomPDF\Facade\Pdf;

class LibroReclamacionController extends Controller
{

    public function registro()
    {
        return view('libro_reclamaciones.registro_lire');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'tipo_reclamo_queja' => 'required',
            'tipo_bien' => 'required',
            'tipo_reclamante' => 'required',
            'nombre_apellido' => 'required|string',
            'tipo_documento' => 'required',
            'nro_doc' => 'required',
            'nro_cel' => 'required',
            'telefono' => 'required',
            'correo' => 'required|email',
            'direccion' => 'required|string',
            'ubicacion' => 'required|string',
            'apoderado' => 'required|string',
            'programa' => 'required|string',
            'fecha_evento' => 'required|date',
            'monto_reclamado' => 'required|numeric',
            'nom_curso' => 'required|string',
            'oficina_involucrado' => 'required|string',
            'motivo_reclamo' => 'required|string',
            'descripcion_reclamo' => 'required|string',
            'pedido' => 'required|string',
        ]);

        LibroReclamacion::create($data);

        return redirect()->route('libroreclamaciones.registro')->with('success', 'Formulario enviado correctamente');
    }

    public function listarLibroRe()
    {
        $reclamos = \App\Models\LibroReclamacion::orderBy('fecha_evento', 'desc')->get();
        return view('libro_reclamaciones.listahojasreclamaciones', compact('reclamos'));
    }
    
    public function descargarPDF($id)
    {
        $reclamo = LibroReclamacion::findOrFail($id);

        $pdf = Pdf::loadView('libro_reclamaciones.modelolibre.hoja', compact('reclamo'))->setPaper('A4', 'portrait');

        return $pdf->download("hoja-reclamacion-UMA-{$reclamo->id}.pdf");
    }
}


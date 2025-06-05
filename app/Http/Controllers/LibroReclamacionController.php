<?php

namespace App\Http\Controllers;

use App\Models\Area;
use Illuminate\Http\Request;
use App\Models\LibroReclamacion;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Derivacion;

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
        $areas = Area::all(); // O puedes aplicar orden si quieres: Area::orderBy('nombre')->get();
        $reclamos = \App\Models\LibroReclamacion::orderBy('fecha_evento', 'desc')->get();

        return view('libro_reclamaciones.listahojasreclamaciones', compact('reclamos', 'areas'));
    }
    
    public function descargarPDF($id)
    {
        $reclamo = LibroReclamacion::findOrFail($id);

        $pdf = Pdf::loadView('libro_reclamaciones.modelolibre.hoja', compact('reclamo'))->setPaper('A4', 'portrait');

        return $pdf->download("hoja-reclamacion-UMA-{$reclamo->id}.pdf");
    }

    public function guardarDerivacion(Request $request)
    {
        $request->validate([
            'reclamo_id' => 'required|exists:libro_reclamaciones,id',
            'area_id' => 'required|exists:areas,id',
            'observaciones' => 'nullable|string',
        ]);

        Derivacion::create([
            'libro_reclamacion_id' => $request->reclamo_id,
            'area_id' => $request->area_id,
            'comentario' => $request->observaciones, // <- aquí corregido
            'estado' => 'pendiente',
        ]);

        return redirect()->back()->with('success', 'Reclamo derivado correctamente.');
    }

    public function verPorArea()
    {
        
        $areaId = session('area_id');
        if (!$areaId) {
            return back()->with('error', 'Área no asignada al usuario.');
        }

        $derivaciones = Derivacion::with('libroReclamacion')
            ->where('area_id', $areaId)
            ->orderByDesc('created_at')
            ->get();
        
        $reclamos = \App\Models\LibroReclamacion::orderBy('fecha_evento', 'desc')->get();

        $areas = Area::all();

            return view('libro_reclamaciones.derivaciones.mis_derivaciones', compact('derivaciones', 'reclamos', 'areas'));
    }
}


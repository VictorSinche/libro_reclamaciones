<?php

namespace App\Http\Controllers;

use App\Models\Area;
use Illuminate\Http\Request;
use App\Models\LibroReclamacion;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Derivacion;
use App\Models\UserAdmin;
use App\Mail\NotificarDerivacion;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

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
    
    public function listarLibroRe(Request $request)
    {
        $search = $request->input('search');
        $sort = $request->input('sort', 'fecha_evento');
        $direction = $request->input('direction', 'desc');

        $areas = Area::all();

        $reclamos = \App\Models\LibroReclamacion::with('area')
            ->when($search, function ($query, $search) {
                $query->where('nombre_apellido', 'like', "%$search%")
                    ->orWhere('nro_doc', 'like', "%$search%")
                    ->orWhere('correo', 'like', "%$search%");
            })
            ->orderBy($sort, $direction)
            ->paginate(10)
            ->appends(['search' => $search, 'sort' => $sort, 'direction' => $direction]); // conserva filtros al paginar

        return view('libro_reclamaciones.listahojasreclamaciones', compact('reclamos', 'areas', 'search', 'sort', 'direction'));
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
            'reclamo_id'     => 'required|exists:libro_reclamaciones,id',
            'area_id'        => 'required|exists:areas,id',
            'observaciones'  => 'nullable|string',
        ]);

        Log::debug('📌 Iniciando proceso de derivación...');
        //dd(config('mail.default'));       // debe decir 'smtp'
        //dd(env('MAIL_MAILER'));           // debe decir 'smtp'

        // 1. Crear derivación
        Derivacion::create([
            'libro_reclamacion_id' => $request->reclamo_id,
            'area_id'              => $request->area_id,
            'comentario'           => $request->observaciones,
            'estado'               => '1',
        ]);

        Log::debug('✅ Derivación creada para reclamo ID: ' . $request->reclamo_id);

        // 2. Actualizar el estado del reclamo
        $reclamo = LibroReclamacion::find($request->reclamo_id);
        $reclamo->estado = 1;
        $reclamo->save();

        Log::debug('📥 Estado del reclamo actualizado a 1');

        // 3. Buscar usuario del área
        $usuario = UserAdmin::where('area_id', $request->area_id)->first();

        if ($usuario) {
            Log::debug('📧 Enviando correo a: ' . $usuario->email);

            // 4. Enviar correo
            Mail::to($usuario->email)->send(new NotificarDerivacion($reclamo, $usuario->area));
            // Mail::to('balaga7306@acedby.com')->send(new NotificarDerivacion($reclamo, $usuario->area));

            Log::debug('✅ Correo enviado correctamente');
        } else {
            Log::warning('⚠️ No se encontró usuario para área ID: ' . $request->area_id);
        }

        return redirect()->back()->with('success', '✅ Reclamo derivado correctamente.');
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
        
        $reclamos = \App\Models\LibroReclamacion::with('ultimaDerivacion.area') // ← esta línea es clave
            ->orderBy('fecha_evento', 'desc')
            ->paginate(10);

        $areas = Area::all();

            return view('libro_reclamaciones.derivaciones.mis_derivaciones', compact('derivaciones', 'reclamos', 'areas'));
    }
}


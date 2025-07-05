<?php

namespace App\Http\Controllers;

use App\Models\Area;
use Illuminate\Http\Request;
use App\Models\LibroReclamacion;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Derivacion;
use App\Models\UserAdmin;
use App\Mail\NotificarDerivacion;
use App\Mail\ConfirmarRecepcionReclamo;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Helpers\PdfHelper;
use App\Mail\InformeCompletado;
use App\Mail\NotificarResponsableLibroReclamacion;
use Illuminate\Support\Facades\DB;

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

        Log::debug('📌 Registrando nuevo reclamo...');
        $reclamo = LibroReclamacion::create($data);

        $correoReclamante = $reclamo->correo;
        $correoResponsable = env('MAIL_FROM_ADDRESS');

        try {
            // Enviar al reclamante
            Mail::to($correoReclamante)
                ->send(new ConfirmarRecepcionReclamo($reclamo));
            Log::debug("✅ Correo enviado al reclamante: $correoReclamante");

            // Enviar al responsable
            Mail::to($correoResponsable)
                ->send(new NotificarResponsableLibroReclamacion($reclamo));
            Log::debug("✅ Correo enviado al responsable: $correoResponsable");

        } catch (\Throwable $e) {
            Log::error('❌ Error al enviar correos: ' . $e->getMessage());
        }

        return redirect()->back()->with('success', '✅ Reclamo registrado correctamente y correos enviados.');
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

        return view('area_legal.responsable', compact('reclamos', 'areas', 'search', 'sort', 'direction'));
    }

    public function descargarPDF($id)
    {
        $reclamo = LibroReclamacion::findOrFail($id);

        $pdf = Pdf::loadView('libro_reclamaciones.modelolibre.hoja', compact('reclamo'))->setPaper('A4', 'portrait');

        return $pdf->stream("hoja-reclamacion-UMA-{$reclamo->id}.pdf");
    }

    public function guardarDerivacion(Request $request)
    {
        $request->validate([
            'reclamo_id'     => 'required|exists:libro_reclamaciones,id',
            'area_id'        => 'required|exists:areas,id',
            'observaciones'  => 'nullable|string',
            'archivo'        => 'nullable|file|max:10240', // máx 10MB
        ]);

        Log::debug('📌 Iniciando proceso de derivación...');

        // Procesar archivo si existe
        $nombreArchivo = null;
        if ($request->hasFile('archivo')) {
            $archivo = $request->file('archivo');
            $fecha = now()->format('Y-m-d');
            $carpeta = "derivaciones/{$request->reclamo_id}/{$request->area_id}/{$fecha}";
            $nombreArchivo = $carpeta . '/' . time() . '_' . $archivo->getClientOriginalName();
            $archivo->storeAs($carpeta, basename($nombreArchivo), 'public');
            Log::debug('📎 Archivo guardado: ' . $nombreArchivo);
        }

        // Crear derivación
        Derivacion::create([
            'libro_reclamacion_id' => $request->reclamo_id,
            'area_id'              => $request->area_id,
            'comentario'           => $request->observaciones,
            'estado'               => '0',
            'archivo'              => $nombreArchivo, // Aquí se guarda si existe
        ]);
        Log::debug('✅ Derivación creada para reclamo ID: ' . $request->reclamo_id);

        // Actualizar el estado del reclamo
        $reclamo = LibroReclamacion::find($request->reclamo_id);
        $reclamo->estado = 1;
        $reclamo->save();
        Log::debug('📥 Estado del reclamo actualizado a 1');

        // Buscar usuario del área y enviar notificación
        $usuario = UserAdmin::where('area_id', $request->area_id)->first();
        if ($usuario) {
            Log::debug('🛠 Mailer configurado: ' . config('mail.mailer')); // ← AQUI
            Log::debug('📧 Enviando correo a: ' . $usuario->email);
            Mail::to($usuario->email)->send(new NotificarDerivacion($reclamo, $usuario->area));
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

    public function marcarComoAtendido($id)
    {
        $derivacion = Derivacion::findOrFail($id);
        $derivacion->estado = 2; // Marcar como completado
        $derivacion->save();
        $correoResponsable = config('mail.from.address') ?? 'notificaciones@uma.edu.pe';
        Mail::to($correoResponsable)->send(new InformeCompletado($derivacion));
        return back()->with('success', '✅ Derivación marcada como atendida.');
    }

    public function guardarInforme(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:derivaciones,id',
            'informe' => 'nullable|string',
        ]);

        $derivacion = Derivacion::findOrFail($request->id);
        $derivacion->informe = $request->informe;
        $derivacion->estado = 1; // ✅ Marcar como atendido automáticamente
        $derivacion->save();

        return back()->with('success', '✅ Informe guardado y derivación marcada como atendida.');
    }

    public function descargarInformePDF($id)
    {
        $derivacion = Derivacion::with(['area', 'libroReclamacion'])->findOrFail($id);

        // 🔥 Aquí estás aplicando el helper para convertir las imágenes a base64
        $derivacion->informe = PdfHelper::reemplazarRutasImagenesHTML($derivacion->informe);

        // ✅ Generación del PDF desde la vista, con el contenido ya procesado
        $pdf = Pdf::loadView('pdf.declaracionJurada.informe_derivacion', compact('derivacion'))
                ->setPaper('A4', 'portrait');

        // ✅ Descarga del PDF con nombre dinámico
        return $pdf->stream("informe-derivacion-UMA-{$derivacion->id}.pdf");
    }

    public function subirInforme(Request $request, $id)
    {
        $request->validate([
            'informe_responsable' => 'required|file|mimes:pdf,doc,docx|max:10240', // Máximo 10 MB
        ]);

        $reclamo = LibroReclamacion::findOrFail($id);

        $archivo = $request->file('informe_responsable');
        $fecha = now()->format('Y-m-d'); // Formato: 2025-06-11
        $nombreArchivo = time() . '_' . $archivo->getClientOriginalName();

        // Carpeta destino estructurada por ID y fecha
        $ruta = "informes_responsables/{$id}/{$fecha}";
        $archivo->storeAs($ruta, $nombreArchivo, 'public');

        // Guardamos solo la ruta relativa
        $reclamo->informe_responsable = "{$id}/{$fecha}/{$nombreArchivo}";
        $reclamo->save();

        return back()->with('successdrift', '✅ Informe del responsable subido correctamente.');
    }

    public function dashboard()
    {
        // 📊 Conteos para tarjetas resumen
        $totalReclamos = LibroReclamacion::count();
        $registrados   = LibroReclamacion::where('estado', 0)->count();
        $derivados     = LibroReclamacion::where('estado', 1)->count();
        $atendidos     = LibroReclamacion::where('estado', 2)->count();

        // 🧾 Tipos de reclamo
        $totalReclamosQueja   = LibroReclamacion::where('tipo_reclamo_queja', 'queja')->count();
        $totalReclamosReclamo = LibroReclamacion::where('tipo_reclamo_queja', 'reclamo')->count();

        // 📅 Reclamos por mes
        $reclamosPorMes = LibroReclamacion::selectRaw("DATE_FORMAT(fecha_evento, '%Y-%m') as mes, COUNT(*) as total")
            ->groupBy('mes')
            ->orderBy('mes')
            ->get();

        $reclamosPorMesMeses   = $reclamosPorMes->pluck('mes');
        $reclamosPorMesValores = $reclamosPorMes->pluck('total');

        // 🏢 Reclamos por Área
        $reclamosPorArea = Derivacion::select('areas.nombre', DB::raw('COUNT(*) as total'))
            ->join('areas', 'areas.id', '=', 'derivaciones.area_id')
            ->groupBy('areas.nombre')
            ->get();

        $areasLabels  = $reclamosPorArea->pluck('nombre');
        $areasValores = $reclamosPorArea->pluck('total');

        $coloresPorArea = [
            'COA' => '#f97316',
            'OSAR' => '#3b82f6',
            'TI' => '#22c55e',
            'TESORERIA' => '#6366f1',
            'ADMISION' => '#ec4899',
            'DIRECCIÓN DE ESCUELA' => '#eab308',
        ];

        $colores = $areasLabels->map(fn($nombre) => $coloresPorArea[$nombre] ?? '#9ca3af'); // gris por defecto
        $conInforme = Derivacion::whereNotNull('informe')->count();
        $sinInforme = Derivacion::whereNull('informe')->count();

        return view('dashboard.dashboard', compact(
            'totalReclamos',
            'registrados',
            'derivados',
            'atendidos',
            'totalReclamosQueja',
            'totalReclamosReclamo',
            'reclamosPorMesMeses',
            'reclamosPorMesValores',
            'areasLabels',
            'areasValores',
            'colores',
            'conInforme',
            'sinInforme'
        ));
    }

}


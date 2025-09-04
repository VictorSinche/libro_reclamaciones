<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InfoPostulanteController;
use App\Http\Controllers\PostulanteLoginController;
use App\Http\Controllers\CreatePostulanteController;
use App\Http\Controllers\DeclaracionJuradaController;
use App\Http\Controllers\LibroReclamacionController;
use App\Http\Controllers\PermisoPostulanteController;
use App\Http\Controllers\ReporteReclamosController;
use Illuminate\Support\Facades\Mail;

/*
|--------------------------------------------------------------------------
| Rutas para Libro de reclamciones
|--------------------------------------------------------------------------
*/
Route::get('/', [LibroReclamacionController::class, 'registro'])->name('libroreclamaciones.registro');
Route::post('/libro-reclamaciones', [LibroReclamacionController::class, 'store'])->name('libro-reclamaciones.store');

/*
|--------------------------------------------------------------------------
| Rutas de Autenticación
|--------------------------------------------------------------------------
*/
// Route::get('/', fn() => redirect()->route('login.postulante'))->name('auth.login') ;

Route::get('/login', [PostulanteLoginController::class, 'form'])->name('login.postulante');
Route::post('/login-postulante', [PostulanteLoginController::class, 'login'])->name('login.postulante.submit');
Route::post('/logout', [PostulanteLoginController::class, 'logout'])->name('logout');

Route::middleware('auth.admin')->group(function () {
/*
|--------------------------------------------------------------------------
| Rutas de Administración
|--------------------------------------------------------------------------
*/
Route::get('/convalidacion', fn() => view('director.convalidacion'))->name('director.convalidacion');
Route::get('/historialdj', [InfoPostulanteController::class, 'listarPostulantesConDJ'])->name('admision.historialDj');
Route::get('/listpostulante', [InfoPostulanteController::class, 'resumenEstados'])->name('admision.listpostulante');
Route::get('/listlibro', [LibroReclamacionController::class, 'listarLibroRe'])->name('arealegal.libroRe');
Route::get('/libro-reclamaciones/pdf/{id}', [LibroReclamacionController::class, 'descargarPDF'])->name('libro-reclamaciones.pdf');
Route::post('/derivar-reclamo', [LibroReclamacionController::class, 'guardarDerivacion'])->name('derivar.reclamo');
Route::post('/exceldj', [InfoPostulanteController::class, 'exportarExcelDJ'])->name('exceldj');

Route::get('/mis-derivaciones', [LibroReclamacionController::class, 'verPorArea'])->name('derivaciones.mis_derivaciones');

Route::post('/derivaciones/{id}/completar', [LibroReclamacionController::class, 'marcarComoAtendido'])->name('derivacion.completar');
Route::post('/derivacion/informe', [LibroReclamacionController::class, 'guardarInforme'])->name('derivacion.guardar_informe');
Route::get('/derivacion/{id}/informe/pdf', [LibroReclamacionController::class, 'descargarInformePDF'])->name('derivacion.informe_pdf');
Route::post('/libro-reclamaciones/{id}/subir-informe', [LibroReclamacionController::class, 'subirInforme'])->name('libroreclamaciones.subirInforme');
Route::post('/ckeditor/upload', [App\Http\Controllers\CKEditorController::class, 'upload']);

Route::post('/derivacion/{id}/enviar-estudiante', [LibroReclamacionController::class, 'enviarAEstudiante'])
    ->name('derivacion.enviar-estudiante');

Route::get('/reporte', fn() => view('libro_reclamaciones.reportes.reporte_trazabilidad'))->name('reporte.reporte');
Route::get('/general', [ReporteReclamosController::class, 'exportarGeneral'])->name('reclamos.export.general');
Route::get('/derivados-pend-inf', [ReporteReclamosController::class, 'exportarDerivadosPendInf'])->name('reclamos.export.derivados_pend_inf');
Route::get('/inf-completado-pend-envio', [ReporteReclamosController::class, 'exportarInfCompletadoPendEnvio'])->name('reclamos.export.inf_completado_pend_envio');
Route::get('/enviados', [ReporteReclamosController::class, 'exportarEnviados'])->name('reclamos.export.enviados');

/*
|--------------------------------------------------------------------------
| Rutas de Declaración Jurada
|--------------------------------------------------------------------------
*/
Route::get('/declaracion-jurada/{modalidad?}', [InfoPostulanteController::class, 'vistaDeclaracionJurada'])->name('declaracionJurada.formulario');
Route::post('/declaracion-jurada/guardar', [InfoPostulanteController::class, 'guardarDeclaracion'])->name('declaracionJurada.guardar');
Route::get('/declaracion-jurada/pdf/{dni}', [DeclaracionJuradaController::class, 'descargarDeclaracionJuradaPDF'])->name('declaracionJurada.descargar');

/*
|--------------------------------------------------------------------------
| Rutas de Menús y Submenús
|--------------------------------------------------------------------------
*/
Route::get('/alumno/{dni}', [LibroReclamacionController::class, 'buscar']);

/*
|--------------------------------------------------------------------------
| Rutas de Permisos
|--------------------------------------------------------------------------
*/
Route::get('/listPermisos', [PermisoPostulanteController::class, 'index'])->name('user.listPermisos');
Route::post('/listPermisos', [PermisoPostulanteController::class, 'update'])->name('user.updatePermisos');
Route::get('/admin/asignar-area', [PermisoPostulanteController::class, 'vistaAsignarArea'])->name('user.vistaAsignarArea');
Route::post('/admin/asignar-area', [PermisoPostulanteController::class, 'asignarArea'])->name('user.asignarArea');
Route::get('/usuarios-admin', [PermisoPostulanteController::class, 'viewUser'])->name('user.viewUser');
Route::post('/usuarios-admin/store', [PostulanteLoginController::class, 'createUpdateUser'])->name('usuarios.admin.store');
});
/*
|--------------------------------------------------------------------------
| Rutas del Postulante
|--------------------------------------------------------------------------
*/
Route::middleware('auth.postulante')->group(function () {

    Route::get('/dashboard', [LibroReclamacionController::class, 'dashboard'])->name('dashboard.dashboard');
    Route::get('/documentos-json/{dni}', [InfoPostulanteController::class, 'documentosJson']);

    Route::get('/especialidades-por-facultad', [InfoPostulanteController::class, 'getEspecialidades'])->name('especialidades.por.facultad');
    Route::get('/pagosinscripcion', fn() => view('student.pagosinscripcion'))->name('student.pagosinscripcion');
    Route::get('/registro', [InfoPostulanteController::class, 'mostrarFormulario'])->name('student.registro');
    Route::post('/guardaroupdatear', [InfoPostulanteController::class, 'storeOrUpdate']);
    Route::get('/subirdocumentos/{c_numdoc}', [InfoPostulanteController::class, 'vistaDocumentos'])->name('student.subirdocumentos');
    Route::post('/subirdocumentos/{c_numdoc}', [InfoPostulanteController::class, 'guardarDocumentos'])->name('student.guardar.documentos');
    Route::get('/verhorario', fn() => view('student.verhorario'))->name('student.verhorario');
});

/*
|--------------------------------------------------------------------------
| Rutas del Registro SIGU
|--------------------------------------------------------------------------
*/
Route::get('/crear-postulante', [CreatePostulanteController::class, 'mostrarFormulario'])->name('register.registro');
Route::post('/crear-postulante', [CreatePostulanteController::class, 'registrarPostulante']);
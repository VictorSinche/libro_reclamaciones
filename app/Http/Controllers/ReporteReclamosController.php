<?php

namespace App\Http\Controllers;

use App\Exports\ReclamosDerivadosPendInfExport;
use App\Exports\ReclamosEnviadosExport;
use App\Exports\ReclamosGeneralExport;
use App\Exports\ReclamosInfCompletadoPendEnvioExport;
use Maatwebsite\Excel\Facades\Excel;

class ReporteReclamosController extends Controller
{
    public function exportarGeneral()
    {
        return Excel::download(new ReclamosGeneralExport, 'reporte_consolidado_general_UMA.xlsx');
    }

    public function exportarDerivadosPendInf()
    {
        return Excel::download(new ReclamosDerivadosPendInfExport, 'reclamos_derivados_pend_inf_UMA.xlsx');
    }

    public function exportarInfCompletadoPendEnvio()
    {
        return Excel::download(new ReclamosInfCompletadoPendEnvioExport, 'reclamos_inf_completado_pend_envio_UMA.xlsx');
    }

    public function exportarEnviados()
    {
        return Excel::download(new ReclamosEnviadosExport, 'reclamos_enviados_UMA.xlsx');
    }
}

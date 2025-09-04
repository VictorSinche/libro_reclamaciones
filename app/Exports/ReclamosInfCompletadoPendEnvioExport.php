<?php

namespace App\Exports;

use App\Exports\Concerns\AutoSizeAndStyle;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ReclamosInfCompletadoPendEnvioExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
{

    use AutoSizeAndStyle;

    public function collection()
    {
        return DB::table('derivaciones as d')
            ->join('libro_reclamaciones as lr', 'lr.id', '=', 'd.libro_reclamacion_id')
            ->leftJoin('areas as a', 'a.id', '=', 'd.area_id')
            ->whereNotNull('d.informe_completado_at')
            ->whereRaw('d.informe_completado_at >= d.fecha_derivacion')
            ->orderByDesc('d.informe_completado_at')
            ->selectRaw('
                d.id AS derivacion_id,
                lr.id AS reclamo_id,
                lr.nombre_apellido,
                a.nombre AS area,
                d.fecha_derivacion,
                d.informe_completado_at,
                TIMESTAMPDIFF(MINUTE, d.fecha_derivacion, d.informe_completado_at) AS minutos_derivado_a_informe,
                TIMESTAMPDIFF(HOUR,   d.fecha_derivacion, d.informe_completado_at) AS horas_derivado_a_informe,
                TIMESTAMPDIFF(DAY,    d.fecha_derivacion, d.informe_completado_at) AS dias_derivado_a_informe,
                CONCAT(
                    TIMESTAMPDIFF(DAY,  d.fecha_derivacion, d.informe_completado_at), "d ",
                    MOD(TIMESTAMPDIFF(HOUR, d.fecha_derivacion, d.informe_completado_at), 24), "h ",
                    MOD(TIMESTAMPDIFF(MINUTE, d.fecha_derivacion, d.informe_completado_at), 60), "m"
                ) AS tiempo_legible
            ')
            ->get();
    }

    public function headings(): array
    {
        return [
            'Derivación ID',
            'Reclamo ID',
            'Reclamante',
            // 'Área ID',
            'Área',
            'Fecha Derivación',
            'Informe Completado',
            'Minutos Derivación → Informe',
            'Horas Derivación → Informe',
            'Días Derivación → Informe',
            'Tiempo legible',
        ];
    }
}

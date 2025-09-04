<?php

namespace App\Exports;

use App\Exports\Concerns\AutoSizeAndStyle;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ReclamosEnviadosExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
{

    use AutoSizeAndStyle;


    public function collection()
    {
        return DB::table('derivaciones as d')
            ->join('libro_reclamaciones as lr', 'lr.id', '=', 'd.libro_reclamacion_id')
            ->leftJoin('areas as a', 'a.id', '=', 'd.area_id')
            ->whereNotNull('d.informe_completado_at')
            ->whereNotNull('d.informe_enviado_at')
            ->whereRaw('d.informe_enviado_at >= d.informe_completado_at')
            ->orderByDesc('d.informe_enviado_at')
            ->selectRaw('
                d.id AS derivacion_id,
                lr.id AS reclamo_id,
                lr.nombre_apellido,
                a.nombre AS area,
                d.informe_completado_at,
                d.informe_enviado_at,
                TIMESTAMPDIFF(MINUTE, d.informe_completado_at, d.informe_enviado_at) AS minutos_informe_a_envio,
                TIMESTAMPDIFF(HOUR,   d.informe_completado_at, d.informe_enviado_at) AS horas_informe_a_envio,
                TIMESTAMPDIFF(DAY,    d.informe_completado_at, d.informe_enviado_at) AS dias_informe_a_envio,
                CONCAT(
                    TIMESTAMPDIFF(DAY,  d.informe_completado_at, d.informe_enviado_at), "d ",
                    MOD(TIMESTAMPDIFF(HOUR, d.informe_completado_at, d.informe_enviado_at), 24), "h ",
                    MOD(TIMESTAMPDIFF(MINUTE, d.informe_completado_at, d.informe_enviado_at), 60), "m"
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
            'Informe Completado',
            'Informe Enviado',
            'Minutos Informe → Enviado',
            'Horas Informe → Enviado',
            'Días Informe → Enviado',
            'Tiempo legible',
        ];
    }
}

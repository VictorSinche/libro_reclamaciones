<?php

namespace App\Exports;

use App\Exports\Concerns\AutoSizeAndStyle;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ReclamosGeneralExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
{

    use AutoSizeAndStyle;

    public function collection()
    {
        return DB::table('derivaciones as d')
            ->join('libro_reclamaciones as lr', 'lr.id', '=', 'd.libro_reclamacion_id')
            ->leftJoin('areas as a', 'a.id', '=', 'd.area_id')
            ->whereNotNull('d.informe_completado_at')
            ->whereNotNull('d.informe_enviado_at')
            // (opcional pero recomendado) evita tiempos negativos si hubiera data rara:
            ->whereColumn('d.informe_enviado_at', '>=', 'lr.created_at')
            ->orderByDesc('d.informe_enviado_at')
            ->selectRaw("
                lr.id AS reclamo_id,
                lr.nombre_apellido,
                d.id AS derivacion_id,
                a.nombre AS area,
                lr.created_at AS fecha_reclamo,
                d.fecha_derivacion,
                d.informe_completado_at,
                d.informe_enviado_at,
                CONCAT(
                    TIMESTAMPDIFF(DAY, lr.created_at, d.informe_enviado_at), ' día',
                    IF(TIMESTAMPDIFF(DAY, lr.created_at, d.informe_enviado_at) = 1, '', 's'),
                    ' ',
                    MOD(TIMESTAMPDIFF(HOUR, lr.created_at, d.informe_enviado_at), 24), ' hora',
                    IF(MOD(TIMESTAMPDIFF(HOUR, lr.created_at, d.informe_enviado_at), 24) = 1, '', 's'),
                    ' ',
                    MOD(TIMESTAMPDIFF(MINUTE, lr.created_at, d.informe_enviado_at), 60), ' minuto',
                    IF(MOD(TIMESTAMPDIFF(MINUTE, lr.created_at, d.informe_enviado_at), 60) = 1, '', 's')
                ) AS tiempo_total_legible
            ")
            ->get();
    }

    public function headings(): array
    {
        return [
            'Reclamo ID',
            'Reclamante',
            'Derivación ID',
            'Área',
            'Fecha Reclamo',
            'Fecha Derivación',
            'Informe Completado',
            'Informe Enviado',
            'Tiempo total (legible) Reclamo → Envío',
        ];
    }
}

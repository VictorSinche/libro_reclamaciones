<?php

namespace App\Exports;

use App\Exports\Concerns\AutoSizeAndStyle;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ReclamosDerivadosPendInfExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
{

    use AutoSizeAndStyle
    ;

    public function collection()
    {
        return DB::table('libro_reclamaciones as lr')
            ->join('derivaciones as d', 'lr.id', '=', 'd.libro_reclamacion_id')
            ->leftJoin('areas as a', 'a.id', '=', 'd.area_id')
            ->whereNotNull('d.fecha_derivacion')
            ->whereRaw('d.fecha_derivacion >= lr.created_at')
            ->orderByDesc('d.fecha_derivacion')
            ->selectRaw('
                lr.id AS reclamo_id,
                lr.nombre_apellido,
                d.id AS derivacion_id,
                a.nombre AS area,
                lr.created_at      AS fecha_registro,
                d.fecha_derivacion AS fecha_derivacion,
                TIMESTAMPDIFF(MINUTE, lr.created_at, d.fecha_derivacion) AS minutos_registro_a_derivacion,
                TIMESTAMPDIFF(HOUR,   lr.created_at, d.fecha_derivacion) AS horas_registro_a_derivacion,
                TIMESTAMPDIFF(DAY,    lr.created_at, d.fecha_derivacion) AS dias_registro_a_derivacion,
                CONCAT(
                    TIMESTAMPDIFF(DAY,  lr.created_at, d.fecha_derivacion), "d ",
                    MOD(TIMESTAMPDIFF(HOUR, lr.created_at, d.fecha_derivacion), 24), "h ",
                    MOD(TIMESTAMPDIFF(MINUTE, lr.created_at, d.fecha_derivacion), 60), "m"
                ) AS tiempo_legible
            ')
            ->get();
    }

    public function headings(): array
    {
        return [
            'Reclamo ID',
            'Reclamante',
            'Derivación ID',
            // 'Área ID',
            'Área',
            'Fecha Registro',
            'Fecha Derivación',
            'Minutos Registro → Derivación',
            'Horas Registro → Derivación',
            'Días Registro → Derivación',
            'Tiempo legible',
        ];
    }
}

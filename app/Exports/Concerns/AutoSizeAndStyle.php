<?php

namespace App\Exports\Concerns;

use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

trait AutoSizeAndStyle
{
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                // Negrita en encabezado y ajuste de línea (wrap) para cabeceras largas
                $highestColumn = $sheet->getHighestColumn();
                $highestRow    = $sheet->getHighestRow();
                $headerRange   = 'A1:' . $highestColumn . '1';

                $sheet->getStyle($headerRange)->getFont()->setBold(true);
                $sheet->getStyle($headerRange)->getAlignment()->setWrapText(true);
                $sheet->getStyle('A1:' . $highestColumn . $highestRow)
                      ->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);

                // Congelar cabecera
                $sheet->freezePane('A2');

                // Autofiltro en la fila de encabezado
                $sheet->setAutoFilter($headerRange);

                // Autoajustar TODAS las columnas existentes (sirve si hay más de 26)
                $highestColumnIndex = Coordinate::columnIndexFromString($highestColumn);
                for ($col = 1; $col <= $highestColumnIndex; $col++) {
                    $columnLetter = Coordinate::stringFromColumnIndex($col);
                    $sheet->getColumnDimension($columnLetter)->setAutoSize(true);
                }
            },
        ];
    }
}

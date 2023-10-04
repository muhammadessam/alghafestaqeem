<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithDefaultStyles;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Style;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Color;

class TransactionExport implements FromArray, ShouldAutoSize, WithEvents, WithHeadings, WithStyles
{
    protected array $data;
    protected array $headers;

    public function __construct(array $data, array $headers)
    {
        $this->data = $data;
        $this->headers = $headers;
    }

    public function array(): array
    {
        return $this->data;
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->getDelegate()->setRightToLeft(true);
            },
        ];
    }

    public function headings(): array
    {
        return [
            '#',
            trans('admin.instrument_number'),
            trans('admin.transaction_number'),
            trans('admin.phone'),
            trans('admin.company'),
            trans('admin.region'),
            trans('admin.company_fundoms'),
            trans('admin.review_fundoms'),
            trans('admin.previewer'),
            trans('admin.Status'),
            trans('admin.is_iterated'),
            trans('admin.LastUpdate'),
            trans('admin.notes')
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}

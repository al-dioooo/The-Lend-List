<?php

namespace App\Exports;

use App\Models\DataList;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class DataListExport implements FromCollection, ShouldAutoSize, WithHeadings, WithMapping, WithStyles
{
    use Exportable;

    protected $selected;

    public function __construct($selected)
    {
        $this->selected = $selected;
    }

    public function collection()
    {
        return DataList::with('items:id,name,description')->whereIn('id', $this->selected)->get();
    }

    public function map($data): array
    {
        return [
            [
                $data->unique_id,
                $data->note,
                $data->borrower->name,
                $data->items->pluck('name')->implode(', '),
                $data->created_at,
                $data->updated_at,
                $data->borrowed_at,
                $data->returned_at,
                $data->is_returned ? "Yes" : "Not Returned",
                $data->accepted_by
            ],
            [
                '',
                '',
                $data->borrower->email,
                $data->items->pluck('description')->implode(', ')
            ]
        ];
    }

    public function headings(): array
    {
        return [
            'Unique ID',
            'Note',
            'Borrower',
            'Items',
            'Created At',
            'Updated At',
            'Borrowed At',
            'Returned At',
            'Is Returned',
            'Accepted By'
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => [
                'font' => [
                    'bold' => true
                ]
            ]
        ];
    }
}

<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\Master\MastItemRegister;

class ItemExport implements FromCollection, WithMapping, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return MastItemRegister::all();
    }
    public function map($barcode): array
    {
        return [
            $barcode->box_code,
            $barcode->gulf_code,
            $barcode->part_no,
            $barcode->description,
            $barcode->box_qty,
            $barcode->price,
            $barcode->bar_code,
        ];
    }

    public function headings(): array
    {
        return [
            'Box Code',
            'Gulf Code',
            'part_no',
            'description',
            'box_qty',
            'price',
            'bar_code',
        ];
    }
}

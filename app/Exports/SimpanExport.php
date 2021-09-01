<?php

namespace App\Exports;

use App\Models\Kontak;
use App\Models\Simpan;
use Maatwebsite\Excel\Concerns\FromCollection;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SimpanExport implements FromCollection, WithHeadings, WithStyles, ShouldAutoSize
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $qr = Simpan::select(
            'id',
            'keterangan',
            'kontak_id',
            'jenis_simpanan',
            'no_rekening',
            'administrasi',
            'setoran',
            'petugas'
        )->get()->toArray();
        $data = collect($qr)->map(function ($qr, $key) {
            $collect = (object)$qr;
            return [
                'id' => '#',
                'keterangan' => $collect->keterangan,
                'kontak_id' => $collect->kontak_id,
                'jenis_simpanan' => $collect->jenis_simpanan,
                'no_rekening' => $collect->no_rekening,
                'administrasi' => $collect->administrasi,
                'setoran' => $collect->setoran,
                'petugas' => $collect->petugas
            ];
        });

        return $data;
    }
    public function kontak($id)
    {
        return Kontak::findOrFail($id)->nama;
    }

    public function headings(): array
    {
        return [
            [
                'id',
                'keterangan',
                'kontak_id',
                'jenis_simpanan',
                'no_rekening',
                'administrasi',
                'setoran',
                'petugas'
            ]
        ];
    }
    public function styles(Worksheet $sheet)
    {
        $count = Simpan::count() + 1;
        $string = 'A1:H' . $count;
        $sheet->getStyle('A1:H1')->getFont()->setBold(true);
        $sheet->getStyle($string)->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '000000'],
                ],
            ],
        ]);
    }
}

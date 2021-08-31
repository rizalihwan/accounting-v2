<?php

namespace App\Exports;

use App\Models\Kontak;
use App\Models\Pinjam;
use Maatwebsite\Excel\Concerns\FromCollection;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PinjamExport implements FromCollection, WithHeadings, WithStyles, ShouldAutoSize
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $qr = Pinjam::select(
            'id',
            'jumlah_pinjaman',
            'jangka',
            'bungapersen',
            'type',
            'total_bunga',
            'total_pokok',
            'keterangan',
            'petugas_id',
            'nasabah_id',
        )->get()->toArray();
        $data = collect($qr)->map(function ($qr, $key) {
            $collect = (object)$qr;
            return [
                'id' => '#',
                'jumlah_pinjaman' => $collect->jumlah_pinjaman,
                'jangka' => $collect->jangka,
                'bungapersen' => $collect->bungapersen,
                'type' => $collect->type,
                'keterangan' => $collect->keterangan,
                'petugas_id' => $collect->petugas_id,
                'nasabah_id' => $collect->nasabah_id,
                'total_bunga' => $collect->total_bunga,
                'total_pokok' => $collect->total_pokok
            ];
        });
        return $data;
    }
    public function petugas($id)
    {
        return Kontak::findOrFail($id)->nama;
    }
    public function nasabah($id)
    {
        return Kontak::findOrFail($id)->nama;
    }

    public function headings(): array
    {
        return [
            [
                'id',
                'jumlah_pinjaman',
                'jangka',
                'bungapersen',
                'type',
                'keterangan',
                'petugas_id',
                'nasabah_id',
                'total_bunga',
                'total_pokok'
            ]
        ];
    }
    public function styles(Worksheet $sheet)
    {
        $count = Pinjam::count() + 1;
        $string = 'A1:J' . $count;
        $sheet->getStyle('A1:J1')->getFont()->setBold(true);
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

<?php

namespace App\Exports;

use App\Models\Akun;
use Maatwebsite\Excel\Concerns\FromCollection;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class NeracaExport implements FromCollection, WithHeadings, WithStyles, ShouldAutoSize
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {

        $akun_aktiva = Akun::where('level', 'Aktiva')->orderBy('id', 'asc')->get();
        $hitung_aktiva = [];
        foreach ($akun_aktiva as $key) {
            array_push($hitung_aktiva, $key->debit - $key->kredit);
        }
        $total_aktiva = array_sum($hitung_aktiva);

        $akun_modal = Akun::where('level', 'Modal')->orderBy('id', 'asc')->get();
        $hitung_modal = [];
        foreach ($akun_modal as $key) {
            array_push($hitung_modal, $key->debit - $key->kredit);
        }
        $total_modal = array_sum($hitung_modal);

        $akun_kewajiban = Akun::where('level', 'Kewajiban')->orderBy('id', 'asc')->get();
        $hitung_kewajiban = [];
        foreach ($akun_kewajiban as $key) {
            array_push($hitung_kewajiban, $key->debit - $key->kredit);
        }

        $total_kewajiban = array_sum($hitung_kewajiban);
        $arra = [
            [
                strval($total_aktiva),
                strval($total_modal),
                strval($total_kewajiban)
            ]
        ];
        $data = collect($arra);
        return $data;
    }

    public function headings(): array
    {
        return [
            [
                'Aktiva',
                'Kewajiban',
                'Modal'
            ]
        ];
    }
    public function styles(Worksheet $sheet)
    {
        $string = 'A1:C1';
        $sheet->getStyle('A1:C1')->getFont()->setBold(true);
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

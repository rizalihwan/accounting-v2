<?php

namespace App\Exports;

use App\Models\Bkk;
use App\Models\Jurnalumumdetail;
use App\Models\Purchase\FakturBuy;
use App\Models\Sale\FakturSale;
use Maatwebsite\Excel\Concerns\FromCollection;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LabarugiExport implements FromCollection, WithHeadings, WithStyles, ShouldAutoSize
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $pendapatan = FakturSale::sum('total');
        $beban = FakturBuy::sum('total');
        $laba_kotor = $pendapatan - $beban;

        $JU_AkunBO = Jurnalumumdetail::whereHas('akun', function ($query) {
            $query->where('level', 'BiayaOperasional');
        })->sum('debit');

        $BKK_AkunBO = Bkk::whereHas('akun', function ($query) {
            $query->where('level', 'BiayaOperasional');
        })->sum('value');

        $BiayaOperasional = $JU_AkunBO + $BKK_AkunBO;
        $laba_bersih = $laba_kotor - $BiayaOperasional;
        $arra = [
            [
                strval($pendapatan),
                strval($laba_kotor),
                strval($laba_bersih),
                strval($beban),
                strval($BiayaOperasional)
            ]
        ];
        $data = collect($arra);
        return $data;
    }

    public function headings(): array
    {
        return [
            [
                'Pendapatan',
                'Beban atas pendapatan',
                'Laba Kotor',
                'Biaya Operasional',
                'Laba Bersih'
            ]
        ];
    }
    public function styles(Worksheet $sheet)
    {
        $string = 'A1:E1';
        $sheet->getStyle('A1:E1')->getFont()->setBold(true);
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

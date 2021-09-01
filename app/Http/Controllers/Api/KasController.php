<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\{Bkk, BkkDetail};
use Illuminate\Http\Request;

class KasController extends Controller
{
    private $kas, $kas_detail;

    public function __construct()
    {
        $this->kas = new Bkk();
        $this->kas_detail = new BkkDetail();
    }

    // BKK ++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    public function getBkkDetail($bkk_id)
    {
        $kas_details = $this->kas_detail->select('id', 'bkk_id', 'rekening_id', 'jml_uang', 'catatan')
            ->where('bkk_id', $bkk_id)->with('rekening')->get();

        return response()->json([
            'data' => $kas_details,
            'length' => $kas_details->count()
        ]);
    }
    // ========================= END BKK ==========================

    // BKM ++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    // ========================= END BKM ==========================
}

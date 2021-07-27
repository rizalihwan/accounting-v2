<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\{TemplateJurnal, TemplateJurnalDetail};
use Illuminate\Http\Request;
use DataTables;

class TemplateJurnalController extends Controller
{
    private $template, $template_detail;

    public function __construct()
    {
        $this->template = new TemplateJurnal();
        $this->template_detail = new TemplateJurnalDetail();
    }

    public function getAll()
    {
        $data = $this->template->with('template_details')->all();

        return response()->json([
            'message' => 'success',
            'data' => $data
        ]);
    }

    public function selected($id)
    {
        $template = $this->template->where('id', $id)->with('template_details')->first();

        $data = $template;
        $data['text'] = $template->nama_template;

        return response()->json([
            'message' => 'success',
            'data' => $data
        ]);
    }

    public function getTemplateDatatables()
    {
        $templates = $this->template->with('kontak');
        $datatables = DataTables::of($templates)
            ->editColumn('kontak_id', function ($template) {
                return $template->kontak->nama;
            })->addColumn('#', function ($template) {
                return '<button type="button" class="btn btn-sm btn-info" data-dismiss="modal" onclick="chooseTemplate(' . $template->id . ')">Pilih</button>';
            })->rawColumns(['kontak', '#'])->toJson();

        return $datatables;
    }
}

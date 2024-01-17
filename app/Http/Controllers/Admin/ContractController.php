<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contract;
use Illuminate\Http\Request;

class ContractController extends Controller
{
    public function index()
    {
        return view('admin.contracts.index');
    }

    public function create()
    {
        $line_starts = 10;
        $page_width = 190;
        $pdf = new \App\Helpers\MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        $pageCount = $pdf->setSourceFile(storage_path('pdf-templates/contract-template.pdf'));
        $lg = array();
        $lg['a_meta_charset'] = 'UTF-8';
        $lg['a_meta_dir'] = 'rtl';
        $lg['a_meta_language'] = 'fa';
        $lg['w_page'] = 'page';
        $pdf->setLanguageArray($lg);
        $pdf->SetFont('aealarabiya', '', 12, false);
        for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
            $templateId = $pdf->importPage($pageNo);
            $pdf->AddPage();
            $pdf->useTemplate($templateId, ['adjustPageSize' => true]);
            if ($pageNo == 1) {
                // $pdf->setX(45);
                $pdf->setY(10);
                $pdf->Cell(0, 0, 'م' . 'lorem ipsum dolor set amet', 0, 1, 'R', 0, '', 1);
                $pdf->setFontSize(12);
                // $pdf->MultiCell($page_width / 2, 0, 'عقد موحد من الهيئة السعودية للمقيمين المعتمدين', 0, 'C', 0, 10, 18, 35);
            }
        }
        $pdf->Output(public_path('test' . now()->toDateString() . '.pdf'), 'F');
        return response()->download(public_path('test' . now()->toDateString() . '.pdf'))->deleteFileAfterSend(true);
        // return view('admin.contracts.create');
    }

    public function signaturePad(string $token)
    {
        $contract = Contract::where('token', $token)->first();
        if ($contract == null)
            abort(404);

        return view('admin.contracts.sign', compact('contract'));
    }

    public function sign(string $token)
    {
        $contract = Contract::where('token', $token)->first();
        $contract->signature = request()->signature;
        $contract->save();
        return back();
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contract;
use Illuminate\Http\Request;
use \App\Helpers\ArabicDate;

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
                $pdf->setY(45);
                $pdf->setX(20);
                $pdf->setFontSize(13);
                $date_line = 'حرر هذا العقد بالرياض في '
                    . ArabicDate::dayName()
                    . ': '
                    . ArabicDate::gregorianDate()
                    . 'م'
                    . ' الموافق: '
                    . ArabicDate::hijriDate()
                    . 'هـ'
                    . ' بين كل من:';
                $pdf->Cell(0, 0, $date_line, 0, 1, 'R', 0, '', 1);

                $pdf->setY(153);
                $pdf->setX(67);
                $client_name = 'فلان الفلاني بن فلان العلاني';
                $pdf->Cell(0, 0, $client_name, 0, 1, 'R', 0, '', 1);

                $pdf->setY(161);
                $pdf->setX(67);
                $registration_number = '1234567890';
                $pdf->Cell(0, 0, $registration_number, 0, 1, 'R', 0, '', 1);

                $pdf->setY(169);
                $pdf->setX(67);
                $address = 'السودان';
                $pdf->Cell(0, 0, $address, 0, 1, 'R', 0, '', 1);

                $pdf->setY(177);
                $pdf->setX(67);
                $phone_numbers = '1234567890';
                $pdf->Cell(0, 0, $phone_numbers, 0, 1, 'R', 0, '', 1);

                $pdf->setY(185);
                $pdf->setX(67);
                $email = 'mosaab.emam123@gmail.com';
                $pdf->Cell(0, 0, $email, 0, 1, 'R', 0, '', 1);

                $pdf->setY(193);
                $pdf->setX(67);
                $representative = 'Mosaab Emam';
                $pdf->Cell(0, 0, $representative, 0, 1, 'R', 0, '', 1);
            }
        }
        $pdf->Output(public_path('test' . now()->toDateString() . '.pdf'), 'F');
        return response()->download(public_path('test' . now()->toDateString() . '.pdf'))->deleteFileAfterSend(true);
        return view('admin.contracts.create');
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

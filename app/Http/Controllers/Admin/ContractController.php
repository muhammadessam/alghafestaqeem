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

                $pdf->setFontSize(12);
                $pdf->setY(154);
                $pdf->setX(67);
                $client_name = 'فلان الفلاني بن فلان العلاني';
                $pdf->Cell(0, 0, $client_name, 0, 1, 'R', 0, '', 1);

                $pdf->setY(162);
                $pdf->setX(67);
                $registration_number = '1234567890';
                $pdf->Cell(0, 0, $registration_number, 0, 1, 'R', 0, '', 1);

                $pdf->setY(170);
                $pdf->setX(67);
                $address = 'السودان';
                $pdf->Cell(0, 0, $address, 0, 1, 'R', 0, '', 1);

                $pdf->setY(178);
                $pdf->setX(67);
                $phone_numbers = '1234567890';
                $pdf->Cell(0, 0, $phone_numbers, 0, 1, 'R', 0, '', 1);

                $pdf->setY(186);
                $pdf->setX(67);
                $email = 'mosaab.emam123@gmail.com';
                $pdf->Cell(0, 0, $email, 0, 1, 'R', 0, '', 1);

                $pdf->setY(194);
                $pdf->setX(67);
                $representative = 'Mosaab Emam';
                $pdf->Cell(0, 0, $representative, 0, 1, 'R', 0, '', 1);

                $purpose = 'الــبــيــع';
                $pdf->setY(230);
                $pdf->setX(58);
                $pdf->setFontSize(14);
                $pdf->Cell(0, 0, $purpose, 0, 1, 'R', 0, '', 1);
            }
            if ($pageNo == 2) {
                $purpose = 'البيع';
                $purpose_ln = 'بناءً على طلب الطرف الثاني فان الغرض من معرفة القيمة السوقية للعقار محل التقييم هو (' . $purpose . ').';
                $pdf->setY(186);
                $pdf->setX(20);
                $pdf->setFontSize(14);
                $pdf->Cell(0, 0, $purpose_ln, 0, 1, 'R', 0, '', 1);

                $pdf->setY(212);
                $pdf->setX(67);
                $pdf->setFontSize(12);
                $type = 'مجمع سكني';
                $area = '1000';
                $type_area_ln = 'العقار عبارة عن ' . $type . ' بمساحة: (' . $area . 'متر مربع)';
                $pdf->Cell(0, 0, $type_area_ln, 0, 1, 'R', 0, '', 1);

                $pdf->setY(220);
                $pdf->setX(67);
                $address = 'الحي الفلاني، شارع فلان بن فلان، جدة، السعودية';
                $address_ln = 'يقع العقار بـ: ' . $address;
                $pdf->Cell(0, 0, $address_ln, 0, 1, 'R', 0, '', 1);

                $pdf->setY(228);
                $pdf->setX(67);
                $registration_number = '1234567890';
                $registration_number_ln = 'رقم (' . $registration_number . ') بتاريخ: ' . date('Y/m/d');
                $pdf->Cell(0, 0, $registration_number_ln, 0, 1, 'R', 0, '', 1);
            }
            if ($pageNo == 3) {

                $pdf->setY(35);
                $pdf->setX(100);
                $no_of_assets = '1';
                $pdf->Cell(0, 0, $no_of_assets, 0, 1, 'R', 0, '', 1);

                $pdf->setY(35);
                $pdf->setX(125);
                $taqeem_cost = '10,000';
                $pdf->Cell(0, 0, $taqeem_cost, 0, 1, 'R', 0, '', 1);

                $pdf->setY(35);
                $pdf->setX(165);
                $total_cost = '10,000';
                $pdf->Cell(0, 0, $total_cost, 0, 1, 'R', 0, '', 1);

                $pdf->setY(43);
                $pdf->setX(165);
                $tax = '1,500';
                $pdf->Cell(0, 0, $tax, 0, 1, 'R', 0, '', 1);

                $pdf->setY(51);
                $pdf->setX(165);
                $total_in_numbers = '11,500';
                $pdf->Cell(0, 0, $total_in_numbers, 0, 1, 'R', 0, '', 1);

                $pdf->setY(59);
                $pdf->setX(125);
                $total_in_words = 'إحدى عشر الف وخمسمائة ريال فقط';
                $pdf->Cell(0, 0, $total_in_words, 0, 1, 'R', 0, '', 1);
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

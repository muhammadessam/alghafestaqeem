<?php

namespace App\Livewire;

use App\Helpers\MYPDF;
use Illuminate\Contracts\View\View;
use JetBrains\PhpStorm\NoReturn;
use Livewire\Component;
use setasign\Fpdi\PdfParser\CrossReference\CrossReferenceException;
use setasign\Fpdi\PdfParser\Filter\FilterException;
use setasign\Fpdi\PdfParser\PdfParserException;
use setasign\Fpdi\PdfParser\Type\PdfTypeException;
use setasign\Fpdi\PdfReader\PdfReaderException;
use setasign\Fpdi\Tcpdf\Fpdi;

class GeneratePdf extends Component
{


    public ?string $client_name = '';
    public ?string $title = '';
    public ?string $purpose = '';
    public ?string $city = '';
    public ?string $area = '';
    public ?string $serial = '';
    public $duration = 15;
    public ?string $general_type = '';
    public ?string $price_in_words = '';

    public array $groups = [
        [
            'number' => '',
            'type' => '',
            'price',
            'tax' => 0,
            'total' => 0
        ]
    ];

    public function addMore(): void
    {
        $this->groups[] = [
            'number' => '',
            'type' => '',
            'price',
        ];
    }

    public function removeGroup($index): void
    {
        if (count($this->groups) != 1) {
            array_splice($this->groups, $index, 1);
        }
    }

    #[NoReturn] public function updatedGroups($value, $key): void
    {
        [$index, $key] = explode('.', $key);
        if ($key == 'price') {
            $this->groups[$index]['tax'] = $this->groups[$index]['price'] * 0.15;
            $this->groups[$index]['total'] = ($this->groups[$index]['price'] * 0.15) + $this->groups[$index]['price'];
        }
    }

    /**
     * @throws CrossReferenceException
     * @throws PdfReaderException
     * @throws PdfParserException
     * @throws PdfTypeException
     * @throws FilterException
     */
    public function generate()
    {
        $this->validate([
            'title' => 'required',
            'client_name' => 'required',
            'purpose' => 'required',
            'city' => 'required',
            'area' => 'required',
            'serial' => 'required',
            'general_type' => 'required',
            'price_in_words' => 'required',
            'groups.*.number' => 'required',
            'groups.*.type' => 'required',
            'groups.*.price' => 'required|numeric',
            'duration' => 'required|numeric',
        ], [], [
            'title' => 'اللقب',
            'client_name' => 'اسم العميل',
            'purpose' => 'الغرض من التحويل',
            'city' => 'المدينة',
            'area' => 'الحي',
            'serial' => 'الرقم التسلسلي',
            'general_type' => 'الغرض من التقييم',
            'price_in_words' => 'السعر بالكلمات',
            'groups.*.number' => 'رقم الصك',
            'groups.*.type' => 'نوع العقار',
            'groups.*.price' => 'السعر',
            'duration' => 'مدة الانجاز'
        ]);
        $line_starts = 10;
        $page_width = 190;
        $pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        $pageCount = $pdf->setSourceFile(public_path('template.pdf'));
        $lg = array();
        $lg['a_meta_charset'] = 'UTF-8';
        $lg['a_meta_dir'] = 'rtl';
        $lg['a_meta_language'] = 'fa';
        $lg['w_page'] = 'page';
        $pdf->setLanguageArray($lg);
        $fontname = \TCPDF_FONTS::addTTFfont(public_path('ge_ss.otf'));
        $pdf->SetFont($fontname, '', 12, false);
        for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
            $templateId = $pdf->importPage($pageNo);
            $pdf->AddPage();
            $pdf->useTemplate($templateId, ['adjustPageSize' => true]);
            if ($pageNo == 1) {
                $pdf->setFontSize(36, 'B', '');
                $pdf->setY(105);
                $pdf->Cell(0, 0, 'عرض سعر', 0, 1, 'C', 0, '', 1);
                $pdf->setFontSize(24);
                $pdf->Cell(0, 0, 'اتعاب تقييم ' . $this->general_type, 0, 1, 'C', 0, '', 1);
                $pdf->Cell(0, 0, 'مدينة ' . $this->city, 0, 1, 'C', 0, '', 1);
                $pdf->Cell(0, 0, 'حي ' . $this->area, 0, 1, 'C', 0, '', 1);
                $pdf->setY(200);
                $pdf->Cell(0, 0, $this->serial, 0, 1, 'C', 0, '', 1);
                $pdf->Cell(0, 0, \Carbon\Carbon::now()->toDateString(), 0, 1, 'C', 0, '', 1);
            } elseif ($pageNo == 2) {
                $pdf->setFontSize(14);
                $pdf->MultiCell(60, 0, 'الموضوع: عرض سعر باتعاب التقييم', 0, 'R', 0, 1, 18, 35);
                $pdf->MultiCell(50, 0, \Carbon\Carbon::now()->toDateString(), 0, 'R', 0, 1, 165, 35);
                $pdf->Ln(4);
                $pdf->setX($line_starts);
                $pdf->Cell(0, 5, $this->title . '/' . $this->client_name, 0, 2, 'R', 0, '', 1);
                $pdf->Cell(0, 10, 'السلام عليكم ورحمة الله وبركاته', 0, 2, 'R', 0, '', 1);
                $txt = 'بناء علي طلبكم بخصوص تقديم عرض سعر اتعاب تقييم ' . $this->general_type . ' بمدينة ' . $this->city . ' وذلك لغرض ( ' . $this->purpose . ' ) نفيدكم باستعدادنا للقيام بأعمال التقييم وفقا للمعايير الدولية التقييم الدولية (IVS) لسنة (2022)، كما نود إبلاغكم بقيمة أتعاب الأعمال مفصلة كالتالي: ';
                $pdf->setX($line_starts);
                $pdf->MultiCell(0, 5, $txt . "\n", 0, 'R', 0, 2, $line_starts, '', true, 0, true);
                $header = array('التفاصيل', 'رقم الصك', 'اتعاب التقييم', 'الضريبة (15%)', 'المجموع');
                foreach ($this->groups as $index => $group) {
                    $this->groups[$index]['tax'] = $group['price'] * 0.15;
                    $this->groups[$index]['total'] = ($group['price'] * 0.15) + $group['price'];
                }
                $pdf->ColoredTable($header, $this->groups, $line_starts);
                $pdf->Ln(20);
                $pdf->setFillColor(242, 242, 242);
                $pdf->setX($line_starts);
                $pdf->Cell($page_width / 2, 8, 'اجمالي القيمة + الضريبة كتابةً ', 'TLRB', 0, 'R', 1);
                $pdf->Cell($page_width / 2, 8, $this->price_in_words, 'TLRB', 1, 'R', 1);
                $pdf->setFillColor(255, 255, 255);
                $html_txt = "<ul> <li>مدة الانجاز {$this->duration} يوم عمل بعد استلام جميع المستندات الازمةلانجاز المهمة</li> <li>وعليه نرجو منكم تحويل قيمة اتعاب التقييم علي الحساب البنكي التالي: </li> </ul>";
                $pdf->setX($line_starts);
                $pdf->MultiCell($page_width, 20, $html_txt, 'TLRB', 'R', 1, ln: 1, ishtml: true, valign: 'M');
                $pdf->setX($line_starts);
                $pdf->SetFillColor(14, 128, 158);
                $pdf->setTextColor(255, 255, 255);
                $pdf->Cell(0.4 * $page_width, 8, 'اسم الحساب', 1, 0, 'C', 1);
                $pdf->Cell(0.2 * $page_width, 8, 'اسم البنك', 1, 0, 'C', 1);
                $pdf->Cell(0.4 * $page_width, 8, 'رقم الايبان', 1, 1, 'C', 1);
                $pdf->setX($line_starts);
                $pdf->setFillColor(255, 255, 255);
                $pdf->setTextColor(0, 0, 0);
                $pdf->MultiCell(0.4 * $page_width, 15, 'شركة صالح علي الغفيص للتقييم العقاري مهنية شركة شخص واحد', 1, 'C', 0, 0, valign: 'M');
                $pdf->MultiCell(0.2 * $page_width, 15, 'مصرف الجزيرة', 1, 'C', 1, 0, valign: 'M');
                $pdf->MultiCell(0.4 * $page_width, 15, 'SA2360100002694445569001', 1, 'C', 0, 0, valign: 'M');


            }
        }
        $pdf->Output(public_path($this->client_name . now()->toDateString() . '.pdf'), 'F');
        return response()->download(public_path($this->client_name . now()->toDateString() . '.pdf'))->deleteFileAfterSend(true);
    }

    public function render(): View
    {
        return view('livewire.generate-pdf');
    }
}

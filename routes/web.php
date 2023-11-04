<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

use Illuminate\Support\Facades\Artisan;
use setasign\Fpdi\Tcpdf\Fpdi;

Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    Artisan::call('route:clear');

    return "Cache cleared successfully";
});
Route::group(['namespace' => 'App\\Http\\Controllers\\Website', 'as' => 'website.'], function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/rate-request', 'RateRequestsController@show')->name('rate-request.show');
    Route::post('/rate-request', 'RateRequestsController@store')->name('rate-request.store');
    Route::get('/contactUs', 'HomeController@contactUs')->name('contactUs');
    Route::get('/Prviacy-ploice', 'HomeController@Prviacyploice')->name('Prviacy-ploice');
    Route::get('/tracking', 'RateRequestsController@tracking')->name('tracking');
    Route::get('/tracking_number', 'RateRequestsController@tracking_request_no')->name('tracking_number');


});

Route::get('test-pdf', function () {
    $pdf = new \App\Helpers\MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

    $pageCount = $pdf->setSourceFile(public_path('template.pdf'));
    $lg = array();
    $lg['a_meta_charset'] = 'UTF-8';
    $lg['a_meta_dir'] = 'rtl';
    $lg['a_meta_language'] = 'fa';
    $lg['w_page'] = 'page';
    $pdf->setLanguageArray($lg);
    $pdf->SetFont('aealarabiya', '', 12);
    for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
        $templateId = $pdf->importPage($pageNo);
        $pdf->AddPage();
        $pdf->useTemplate($templateId, ['adjustPageSize' => true]);
        if ($pageNo == 1) {
            $pdf->setFontSize(36);
            $pdf->setY(105);
            $pdf->Cell(0, 0, 'عرض سعر', 0, 1, 'C', 0, '', 1);
            $pdf->setFontSize(24);
            $pdf->Cell(0, 0, 'اتعاب تقييم ', 0, 1, 'C', 0, '', 1);
            $pdf->Cell(0, 0, 'مدينة', 0, 1, 'C', 0, '', 1);
            $pdf->Cell(0, 0, 'حي', 0, 1, 'C', 0, '', 1);
            $pdf->setY(200);
            $pdf->Cell(0, 0, '3213546', 0, 1, 'C', 0, '', 1);
            $pdf->Cell(0, 0, \Carbon\Carbon::now()->toDateString(), 0, 1, 'C', 0, '', 1);
        } elseif ($pageNo == 2) {
            $pdf->setFontSize(12);
            $pdf->MultiCell(50, 0, 'الموضوع: عرض سعر باتعاب التقييم', 0, 'R', 0, 1, 18, 33);
            $pdf->MultiCell(50, 0, \Carbon\Carbon::now()->toDateString(), 0, 'R', 0, 1, 165, 34);
            $pdf->setFontSize(14);
            $pdf->setX(25);
            $pdf->Cell(0, 5, $this->title . '/' . $this->client_name, 0, 2, 'R', 0, '', 1);
            $pdf->Cell(0, 10, 'السلام عليكم ورحمة الله وبركاته', 0, 2, 'R', 0, '', 1);
            $txt = 'بناء علي طلبكم بخصوص تقديم عرض سعر اتعاب تقييم ' . $this->general_type . ' بمدينة ' . $this->city . ' وذلك لغرض ( ' . $this->purpose . ' ) نفيدكم باستعدادنا للقيام بأعمال التقييم وفقا للمعايير الدولية التقييم الدولية (IVS) لسنة (2022)، كما نود إبلاغكم بقيمة أتعاب الأعمال مفصلة كالتالي: ';
            $pdf->setX(25);
            $pdf->MultiCell(0, 5, $txt . "\n", 0, 'R', 0, 2, reseth: true);


        }
    }
    return $pdf->Output();
});
Route::get('/commands', function () {
    \Artisan::call('optimize');
    // \Artisan::call('storage:link');
    return \Artisan::call('db:seed --class=MainPermissionsTableDataSeeder --force');
    // return Artisan::call('migrate', ["--force" => true ]);
});

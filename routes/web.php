<?php

use App\Helpers\MYPDF;
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
    $line_starts = 10;
    $page_width = 190;
    $font_name = TCPDF_FONTS::addTTFfont(public_path('ge_ss.ttf'));
    $pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

    $pageCount = $pdf->setSourceFile(public_path('template.pdf'));
    $lg = array();
    $lg['a_meta_charset'] = 'UTF-8';
    $lg['a_meta_dir'] = 'rtl';
    $lg['a_meta_language'] = 'fa';
    $lg['w_page'] = 'page';
    $pdf->setLanguageArray($lg);
    $pdf->SetFont($font_name, 'B', 36, true);
    for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
        $templateId = $pdf->importPage($pageNo);
        $pdf->AddPage();
        $pdf->useTemplate($templateId, ['adjustPageSize' => true]);
        if ($pageNo == 1) {
            $pdf->setY(105);
            $pdf->Cell(0, 0, 'عرض سعر', 0, 1, 'C', 0, '', 1);
            $pdf->Cell(0, 0, 'بناء على طلبكم بخصوص تقديم عرض سعر أتعاب تقييم مجموعة عقارات بمدينه الطائف وذلك لغرض (معرفة القيمة السوقية)', 0, 1, 'C', 0, '', 1);
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

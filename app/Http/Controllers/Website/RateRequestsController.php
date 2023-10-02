<?php

namespace App\Http\Controllers\Website;

use App\Events\RequestEmailEvent;
use App\Http\Requests\RequestRate;
use App\Http\Controllers\Controller;
use App\Interfaces\CategoryRepositoryInterface;
use App\Interfaces\RateRequestRepositoryInterface;
use App\Models\RateRequest;
use Illuminate\Http\Request;


class RateRequestsController extends Controller
{
    private RateRequestRepositoryInterface $rateRepository;
    private CategoryRepositoryInterface $categoryRepository;
    private $path = 'rates';

    public function __construct(
        RateRequestRepositoryInterface $rateRepository,
        CategoryRepositoryInterface $categoryRepository,
    ) {
        $this->rateRepository = $rateRepository;
        $this->categoryRepository = $categoryRepository;
    }

    public function show()
    {
        $result = [];
        $result['goals'] = $this->categoryRepository->getPublishCategories('ApartmentGoal', 15,'list');
        $result['entities'] = $this->categoryRepository->getPublishCategories('ApartmentEntity', 15,'list');
        $result['types'] = $this->categoryRepository->getPublishCategories('ApartmentType', 15,'list');
        $result['usages'] = $this->categoryRepository->getPublishCategories('ApartmentUsage', 15,'list');

        return view('website.pages.rate', compact('result'));

    }

    public function store(RequestRate $request)
    {
        $data = $request->all();
        $data['request_no'] = ! empty(\App\Models\RateRequest::latest()->first()->id) ? \App\Models\RateRequest::latest()->first()->id * 100 : '1000';
        $images = $this->rateRepository->getImagesSettings();
        $evaluation = $this->rateRepository->createRateRequest($data);
        foreach ($images as $item) {
            if(! empty($data[$item]))
            {
                $evaluation->addMultipleMediaFromRequest([$item])
                ->each(function ($fileAdder) use($item) {
                        $fileAdder->toMediaCollection($item);
                });
            }

        }

        $title = 'رسائل الموقع رقم '.$data['request_no'];
        $content = __('website.RateRequestContent', ['item' => $evaluation]);
        $view = 'contact';
        // event(new RequestEmailEvent($title, $content, $view, $item));

        flash('تم إرسال رسالتك رقم '.$data['request_no'] .' بنجاح')->success();
        return redirect()->route('website.rate-request.show');
    }
    
    public function tracking()
    {
                return view('website.pages.tracking');

    }
       public function tracking_request_no(request $request)
    {
            if ($request->request_no) 
            {

                $order = RateRequest::where('request_no', $request->request_no)->first();
                if ($order) 
                {
                     $orderDetails = $order->getStatusApi();

                return view('website.pages.tracking',compact('orderDetails','order'));
                        

                
                }
                else
                {
                   flash('لا يوجد طلب بهذا الرقم')->error();
                  return redirect()->route('website.tracking');    
                }
            }
            else
            {
                   flash(' يجب أدخال رقم الطلب ')->error();
                  return redirect()->route('website.tracking');      
            }
    }
    
}
<?php

namespace App\Http\Controllers\Api;

use App\Events\RequestEmailEvent;
use App\Http\Requests\RequestRate;
use Illuminate\Http\Request;
use App\Models\RateRequest;
use App\Http\Resources\Rate_requestsResource;
use App\Interfaces\RateRequestRepositoryInterface;

class RateRequestsController extends ResponseController
{
    private RateRequestRepositoryInterface $rateRepository;
    private $path = 'rates';

    public function __construct(
        RateRequestRepositoryInterface $rateRepository,
    ) {
        $this->rateRepository = $rateRepository;
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

        return $this->successResponse([], trans(' تم استلام طلبك رقم ' .$data['request_no']. 'سيقوم فريق العمل بشركة صالح الغفيص للتقييم العقارى بالتواصل معك قريباَ'), 200);
    }
    
    
    public function tracking(request $request)
    {
         if ($request->request_no) 
            {
                $trackId=$request->request_no;
                  
                $order = RateRequest::where('request_no','=',$trackId)->first();
                if ($order) 
                {
                     $orderDetails = $order->getStatusApi();

                    return response()->json(
                        [
                         'order' => $order,
                         'status'=>$orderDetails,
                    ], 200);  
                        

                
                }
                else
                {
                    return response()->json([
                        'message' => 'لا يوجد طلب بهذا الرقم'.$trackId.'',
                    ], 503);    
                }
            }
            else
            {
                return response()->json([
                    'message' => 'يجب أدخال رقم الطلب',
                ], 503);        
            }
        
    }
}
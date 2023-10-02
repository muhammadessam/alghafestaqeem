<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\ServiceCompany;
use App\Models\Privacy;
use App\Models\Setting;


use App\Http\Resources\AboutResource;
use App\Http\Resources\CompanyResource;
use App\Http\Resources\ContentResource;
use App\Http\Resources\CounterResource;
use App\Http\Resources\PrivacyResource;
use App\Http\Resources\SettingResource;


use App\Interfaces\ContentRepositoryInterface;

class ContentController extends ResponseController
{
    private ContentRepositoryInterface $contentRepository;

    public function __construct(
        ContentRepositoryInterface $contentRepository
    ) {
        $this->contentRepository = $contentRepository;
    }
    
      
      
 public function show(Request $request)
    {
        $data = Setting::first();

        return $this->successResponse(
            ['show' =>$data->show_form],
            'Done',
            200
        );
    }

    public function objectives(Request $request)
    {
        $data = $this->contentRepository->getPublishContents('Objective', 15);

        return $this->successResponse(
            ['items' =>ContentResource::collection($data)],
            'Done',
            200
        );
    }
    
    public function privacy()
    {
         $data = Privacy::first();

        return $this->successResponse(
            ['Privacy' => new PrivacyResource($data)],
            'Done',
            200
        ); 
    }


    public function clients(Request $request)
    {
        $data = $this->contentRepository->getPublishContents('Client', 15);

        return $this->successResponse(
            ['items' =>ContentResource::collection($data)],
            'Done',
            200
        );
    }

    public function services(Request $request)
    {
        $data = $this->contentRepository->getPublishContents('Service', 15);

        return $this->successResponse(
            ['items' =>ContentResource::collection($data)],
            'Done',
            200
        );
    }

    public function counters(Request $request)
    {
        $data = $this->contentRepository->getPublishContents('Counter', 15);

        return $this->successResponse(
            ['items' =>CounterResource::collection($data)],
            'Done',
            200
        );
    }

    public function about(Request $request)
    {
        $data = $this->contentRepository->getPublishContents('About', 15);

        return $this->successResponse(
            ['items' =>AboutResource::collection($data)],
            'Done',
            200
        );
    }

    public function companyServices(Request $request)
    {
        $data = $this->contentRepository->getPublishContents('CompanyService', 15);

        return $this->successResponse(
            ['items' =>ContentResource::collection($data)],
            'Done',
            200
        );
    }

    public function companies(Request $request, $id)
    {
        $data = $this->contentRepository->getContentById($id);
        $companies_id = ServiceCompany::where('service_id', $id)
            ->pluck('company_id')->toArray();

        $companies = $this->contentRepository->getPublishContentsByIds('Company', $companies_id, 15);

        return $this->successResponse(
            [
                'items' =>  CompanyResource::collection($companies),
                'service' => new ContentResource($data)
            ],
            'Done',
            200
        );
    }
    
      public function contactUs()
    {
       

        return $this->successResponse(
            [
                'setting' => new SettingResource(Setting::first()),
            ],
            'Done',
            200
        );
    }
    
    

}
<?php

namespace App\Http\Controllers\Website;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Interfaces\ContentRepositoryInterface;
use App\Models\Privacy;


class HomeController extends Controller
{
    private ContentRepositoryInterface $contentRepository;

    public function __construct(
        ContentRepositoryInterface $contentRepository
    ) {
        $this->contentRepository = $contentRepository;
    }
    public function index(Request $request)
    {
        $result = [];

        $result['counters'] = $this->contentRepository->getPublishContents('Counter', 20);
        $result['objectives'] = $this->contentRepository->getPublishContents('Objective', 15);
        $result['services'] = $this->contentRepository->getPublishContents('Service', 15);
        $result['clients'] = $this->contentRepository->getPublishContents('Client', 15);
        $result['about'] = $this->contentRepository->getPublishContents('About', 15);
        $result['companyServices'] = $this->contentRepository->getPublishContents('CompanyService', 15);


        return view('website.home.index', compact('result'));
    }
      public function contactUs()
    {
        return view('website.contact');


    }
         public function Prviacyploice()
    {
        $Prviacyploice=Privacy::first();
               return view('website.Prviacyploice', compact('Prviacyploice'));


    }
    
}
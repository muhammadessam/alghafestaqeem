<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\ServiceCompany;
use App\Http\Resources\AboutResource;
use App\Http\Resources\CompanyResource;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\CounterResource;
use App\Interfaces\CategoryRepositoryInterface;

class CategoriesController extends ResponseController
{
    private CategoryRepositoryInterface $categoryRepository;

    public function __construct(
        CategoryRepositoryInterface $categoryRepository
    ) {
        $this->categoryRepository = $categoryRepository;
    }

    public function apartmentGoal(Request $request)
    {
        $data = $this->categoryRepository->getPublishCategories('ApartmentGoal', 15);

        return $this->successResponse(
            ['items' =>CategoryResource::collection($data)],
            'Done',
            200
        );
    }


    public function apartmentType(Request $request)
    {
        $data = $this->categoryRepository->getPublishCategories('ApartmentType', 15);

        return $this->successResponse(
            ['items' =>CategoryResource::collection($data)],
            'Done',
            200
        );
    }

    public function apartmentEntity(Request $request)
    {
        $data = $this->categoryRepository->getPublishCategories('ApartmentEntity', 15);

        return $this->successResponse(
            ['items' =>CategoryResource::collection($data)],
            'Done',
            200
        );
    }

    public function apartmentUsage(Request $request)
    {
        $data = $this->categoryRepository->getPublishCategories('ApartmentUsage', 15);

        return $this->successResponse(
            ['items' =>CategoryResource::collection($data)],
            'Done',
            200
        );
    }


}

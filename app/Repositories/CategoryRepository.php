<?php

namespace App\Repositories;

use Illuminate\Support\Str;
use App\Models\Category;
use App\Interfaces\CategoryRepositoryInterface;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function getAllCategories($scope)
    {
        return Category::$scope()->get();
    }

    public function getPublishCategories($scope, $page, $list = 'paginate')
    {
        $data = Category::$scope()->Ordered()->publish();
        if ($list == 'list') {
            $data = $data->take($page)->get();
        } elseif ($list == 'all') {
            $data = $data->get();
        } else {
            $data = $data->paginate($page);
        }
        return $data;
    }



    public function getPublishCategoriesByIds($scope,$ids ,$page, $list = 'paginate')
    {
        $data = Category::$scope()->whereIn('id', $ids)->Ordered()->publish();
        if ($list == 'list') {
            $data = $data->take($page)->get();
        } elseif ($list == 'all') {
            $data = $data->get();
        } else {
            $data = $data->paginate($page);
        }
        return $data;
    }

    public function getPaginateCategories($data, $scope)
    {
        $items = Category::$scope()->Recent();
        $status = $data['status'] ?? '-1';
        $search = $data['search'] ?? '';
        $from_date = $data['from_date'] ?? '';
        $to_date = $data['to_date'] ?? '';
        $category = $data['category'] ?? '';
        if (isset($search) && $search != '') {
            $items = $items->where(
                function ($q) use ($search) {
                    $q->where('id', 'like', '%' . $search . '%');
                    $q->orWhere('title', 'like', '%' . $search . '%');
                }
            );
        }
        if (isset($from_date) && $from_date != '') {
            $items = $items->whereDate('created_at', '>=', $from_date);
        }
        if (isset($to_date) && $to_date != '') {
            $items = $items->whereDate('created_at', '<=', $to_date);
        }
        if (isset($status) && $status != '-1') {
            $items = $items->where('active', $status);
        }

        $items = $items->paginate(25);

        return $items;
    }

    public function getCount($scope)
    {
        return Category::$scope()->count();
    }

    public function getCategoryById($categoryId)
    {
        return Category::findOrFail($categoryId);
    }

    public function getCategoryBySlug($categorieSlug)
    {
        return Category::where('slug', $categorieSlug)->publish()->first();
    }

    public function deleteCategory($categoryId)
    {
        Category::destroy($categoryId);
    }

    public function createCategory($categoryDetails)
    {
        $categoryDetails['slug'] = Str::slug($categoryDetails['title'], '-');

        return Category::create($categoryDetails);
    }

    public function updateCategory($categoryId, $newDetails)
    {
        $newDetails['slug'] = Str::slug($newDetails['title'], '-');
        return Category::find($categoryId)->update($newDetails);
    }
}
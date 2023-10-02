<?php

namespace App\Repositories;

use Illuminate\Support\Str;
use App\Models\Content;
use App\Interfaces\ContentRepositoryInterface;

class ContentRepository implements ContentRepositoryInterface
{
    public function getAllContents($scope)
    {
        return Content::$scope()->get();
    }

    public function getPublishContents($scope, $page, $list = 'paginate')
    {
        $data = Content::$scope()->Ordered()->publish();
        if ($list == 'list') {
            $data = $data->take($page)->get();
        } elseif ($list == 'all') {
            $data = $data->get();
        } else {
            $data = $data->paginate($page);
        }
        return $data;
    }



    public function getPublishContentsByIds($scope,$ids ,$page, $list = 'paginate')
    {
        $data = Content::$scope()->whereIn('id', $ids)->Ordered()->publish();
        if ($list == 'list') {
            $data = $data->take($page)->get();
        } elseif ($list == 'all') {
            $data = $data->get();
        } else {
            $data = $data->paginate($page);
        }
        return $data;
    }

    public function getPaginateContents($data, $scope)
    {
        $items = Content::$scope()->Recent();
        $status = $data['status'] ?? '-1';
        $search = $data['search'] ?? '';
        $from_date = $data['from_date'] ?? '';
        $to_date = $data['to_date'] ?? '';
        $content = $data['content'] ?? '';
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
        return Content::$scope()->count();
    }

    public function getContentById($contentId)
    {
        return Content::findOrFail($contentId);
    }

    public function getContentBySlug($contentSlug)
    {
        return Content::where('slug', $contentSlug)->publish()->first();
    }

    public function deleteContent($contentId)
    {
        Content::destroy($contentId);
    }

    public function createContent($contentDetails)
    {
        $contentDetails['slug'] = Str::slug($contentDetails['title'], '-');

        return Content::create($contentDetails);
    }

    public function updateContent($contentId, $newDetails)
    {
        $newDetails['slug'] = Str::slug($newDetails['title'], '-');
        return Content::find($contentId)->update($newDetails);
    }
}
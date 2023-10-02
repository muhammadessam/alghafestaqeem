<?php

namespace App\Repositories\Evaluation;

use Illuminate\Support\Str;
use App\Models\Evaluation\EvaluationCompany as Company;
use App\Interfaces\Evaluation\CompanyRepositoryInterface;

class CompanyRepository implements CompanyRepositoryInterface
{
    public function getAllCompanies()
    {
        return Company::get();
    }

    public function getPublishCompanies($page, $list = 'paginate')
    {
        $data = Company::Ordered()->publish();
        if ($list == 'list') {
            $data = $data->take($page)->get();
        } elseif ($list == 'all') {
            $data = $data->get();
        } else {
            $data = $data->paginate($page);
        }
        return $data;
    }

    public function getPaginateCompanies($data)
    {
        $items = Company::Recent();
        $status = $data['status'] ?? '-1';
        $search = $data['search'] ?? '';
        $from_date = $data['from_date'] ?? '';
        $to_date = $data['to_date'] ?? '';
        $company = $data['company'] ?? '';
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

    public function getCount()
    {
        return Company::count();
    }

    public function getCompanyById($companyId)
    {
        return Company::findOrFail($companyId);
    }

    public function getCompanyBySlug($companySlug)
    {
        return Company::where('slug', $companySlug)->publish()->first();
    }

    public function deleteCompany($companyId)
    {
        Company::destroy($companyId);
    }

    public function createCompany($companyDetails)
    {
        return Company::create($companyDetails);
    }

    public function updateCompany($companyId, $newDetails)
    {
        return Company::find($companyId)->update($newDetails);
    }
}

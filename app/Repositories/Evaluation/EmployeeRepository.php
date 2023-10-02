<?php

namespace App\Repositories\Evaluation;

use Illuminate\Support\Str;
use App\Models\Evaluation\EvaluationEmployee as Employee;
use App\Interfaces\Evaluation\EmployeeRepositoryInterface;

class EmployeeRepository implements EmployeeRepositoryInterface
{
    public function getAllEmployees()
    {
        return Employee::get();
    }

    public function getPublishEmployees( $page, $list = 'paginate')
    {
        $data = Employee::Ordered()->publish();
        if ($list == 'list') {
            $data = $data->take($page)->get();
        } elseif ($list == 'all') {
            $data = $data->get();
        } else {
            $data = $data->paginate($page);
        }
        return $data;
    }

    public function getPaginateEmployees($data, )
    {
        $items = Employee::Recent();
        $status = $data['status'] ?? '-1';
        $search = $data['search'] ?? '';
        $from_date = $data['from_date'] ?? '';
        $to_date = $data['to_date'] ?? '';
        $employee = $data['Employee'] ?? '';
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
        return Employee::count();
    }

    public function getEmployeeById($employeeId)
    {
        return Employee::findOrFail($employeeId);
    }

    public function getEmployeeBySlug($employeeSlug)
    {
        return Employee::where('slug', $employeeSlug)->publish()->first();
    }

    public function deleteEmployee($employeeId)
    {
        Employee::destroy($employeeId);
    }

    public function createEmployee($employeeDetails)
    {
        return Employee::create($employeeDetails);
    }

    public function updateEmployee($employeeId, $newDetails)
    {
        return Employee::find($employeeId)->update($newDetails);
    }
}
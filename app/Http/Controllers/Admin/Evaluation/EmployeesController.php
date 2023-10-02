<?php

namespace App\Http\Controllers\Admin\Evaluation;

use App\Helpers\Constants;
use Illuminate\Http\Request;
use App\Http\Requests\RequestRate;
use App\Http\Controllers\Controller;
use App\Http\Requests\ContentRequest;
use App\Models\Evaluation\EvaluationEmployee;
use App\Interfaces\Evaluation\EmployeeRepositoryInterface;

class EmployeesController extends Controller
{
    private EmployeeRepositoryInterface $employeeRepository;

    public function __construct(EmployeeRepositoryInterface $employeeRepository)
    {
        $this->employeeRepository = $employeeRepository;
         $this->middleware('auth');
        $this->middleware('checkPermission:evaluation-employees.index')->only(['index']);
        $this->middleware('checkPermission:evaluation-employees.show')->only(['show']);
        $this->middleware('checkPermission:evaluation-employees.edit')->only(['edit']);
        $this->middleware('checkPermission:evaluation-employees.delete')->only(['destroy']);
        $this->middleware('checkPermission:evaluation-employees.create')->only(['create']);
    }

    public function index(Request $request)
    {
        $result = [];
        $data = $request->all();
        $status = $data['status'] ?? '-1';
        $search = $data['search'] ?? '';
        $from_date = $data['from_date'] ?? '';
        $to_date = $data['to_date'] ?? '';
        $counts = $this->employeeRepository->getCount();
        $items = $this->employeeRepository->getPaginateEmployees($data);
        $statuses = Constants::Statuses;

        $result = [
            'from_date' => $from_date,
            'to_date' => $to_date,
            'items' => $items,
            'counts' => $counts,
            'status' => $status,
            'search' => $search,
            'statuses' => $statuses
        ];
        return view(
            'admin.evaluation.employees.index',
            compact('result')
        );
    }

    public function create(EvaluationEmployee $item)
    {
        return view('admin.evaluation.employees.create_and_edit', compact('item'));
    }

    public function store(ContentRequest $request)
    {
        $data = $request->all();

        $employee = $this->employeeRepository->createEmployee($data);

        if (isset($request->action) && $request->action == 'preview') {
            return redirect()->route('admin.evaluation-employees.store')
                    ->with('message', __('admin.AddedMessage'));
        }

        return redirect()->route('admin.evaluation-employees.index')
            ->with('message', __('admin.AddedMessage'));
    }

    public function show($id)
    {
        $item = $this->employeeRepository->getEmployeeById($id);
        return view('admin.evaluation.employees.show', compact('item'));
    }

    public function edit($id)
    {
        $item = $this->employeeRepository->getEmployeeById($id);
        $statuses = Constants::Statuses;
        return view('admin.evaluation.employees.create_and_edit', compact('item', 'statuses'));
    }

    public function update(ContentRequest $request, $id)
    {
        $data = $request->except(['_token', '_method' ]);

        $this->employeeRepository->updateEmployee($id, $data);

        return redirect()->route('admin.evaluation-employees.index')
            ->with('message', __('admin.UpdatedMessage'));
    }

    public function destroy($id)
    {
        $this->employeeRepository->deleteEmployee($id);

        return redirect()->route('admin.evaluation-employees.index')
            ->with('message', __('admin.DeletedMessage'));
    }
}

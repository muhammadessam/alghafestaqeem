<?php

namespace App\Http\Controllers\Admin\Evaluation;

use App\Helpers\Constants;
use Illuminate\Http\Request;
use App\Http\Requests\RequestRate;
use App\Http\Controllers\Controller;
use App\Http\Requests\ContentRequest;
use App\Models\Evaluation\EvaluationCompany;
use App\Interfaces\Evaluation\CompanyRepositoryInterface;

class CompaniesController extends Controller
{
    private CompanyRepositoryInterface $companyRepository;

    public function __construct(CompanyRepositoryInterface $companyRepository)
    {
        $this->companyRepository = $companyRepository;
         $this->middleware('auth');
        $this->middleware('checkPermission:evaluation-companies.index')->only(['index']);
        $this->middleware('checkPermission:evaluation-companies.show')->only(['show']);
        $this->middleware('checkPermission:evaluation-companies.edit')->only(['edit']);
        $this->middleware('checkPermission:evaluation-companies.delete')->only(['destroy']);
        $this->middleware('checkPermission:evaluation-companies.create')->only(['create']);
    }

    public function index(Request $request)
    {
        $result = [];
        $data = $request->all();
        $status = $data['status'] ?? '-1';
        $search = $data['search'] ?? '';
        $from_date = $data['from_date'] ?? '';
        $to_date = $data['to_date'] ?? '';
        $counts = $this->companyRepository->getCount();
        $items = $this->companyRepository->getPaginateCompanies($data);
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
            'admin.evaluation.companies.index',
            compact('result')
        );
    }

    public function create(EvaluationCompany $item)
    {
        return view('admin.evaluation.companies.create_and_edit', compact('item'));
    }

    public function store(ContentRequest $request)
    {
        $data = $request->all();

        $company = $this->companyRepository->createCompany($data);

        if (isset($request->action) && $request->action == 'preview') {
            return redirect()->route('admin.evaluation-companies.store')
                    ->with('message', __('admin.AddedMessage'));
        }

        return redirect()->route('admin.evaluation-companies.index')
            ->with('message', __('admin.AddedMessage'));
    }

    public function show($id)
    {
        $item = $this->companyRepository->getCompanyById($id);
        return view('admin.evaluation.companies.show', compact('item'));
    }

    public function edit($id)
    {
        $item = $this->companyRepository->getCompanyById($id);
        $statuses = Constants::Statuses;
        return view('admin.evaluation.companies.create_and_edit', compact('item', 'statuses'));
    }

    public function update(ContentRequest $request, $id)
    {
        $data = $request->except(['_token', '_method' ]);

        $this->companyRepository->updateCompany($id, $data);

        return redirect()->route('admin.evaluation-companies.index')
            ->with('message', __('admin.UpdatedMessage'));
    }

    public function destroy($id)
    {
        $this->companyRepository->deleteCompany($id);

        return redirect()->route('admin.evaluation-companies.index')
            ->with('message', __('admin.DeletedMessage'));
    }
}

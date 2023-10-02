<?php

namespace App\Http\Controllers\Admin;

use App\Models\Content;
use App\Helpers\Constants;
use Illuminate\Http\Request;
use App\Models\ServiceCompany;
use App\Http\Controllers\Controller;
use App\Http\Requests\ContentRequest;
use App\Interfaces\ContentRepositoryInterface;

class CompaniesController extends Controller
{
    private ContentRepositoryInterface $contentRepository;
    private $path = 'companies';
    private $scope = 'Company';


    public function __construct(ContentRepositoryInterface $contentRepository)
    {
        $this->contentRepository = $contentRepository;
        $this->middleware('auth');
        $this->middleware('checkPermission:companies.index')->only(['index']);
        $this->middleware('checkPermission:companies.show')->only(['show']);
        $this->middleware('checkPermission:companies.edit')->only(['edit']);
        $this->middleware('checkPermission:companies.delete')->only(['destroy']);
        $this->middleware('checkPermission:companies.create')->only(['create']);
    }

    public function index(Request $request)
    {
        $result = [];
        $data = $request->all();
        $status = $data['status'] ?? '-1';
        $search = $data['search'] ?? '';
        $from_date = $data['from_date'] ?? '';
        $to_date = $data['to_date'] ?? '';
        $counts = $this->contentRepository->getCount($this->scope);
        $items = $this->contentRepository->getPaginateContents($data, $this->scope);
        $result = [
            'from_date' => $from_date,
            'to_date' => $to_date,
            'items' => $items,
            'counts' => $counts,
            'status' => $status,
            'search' => $search,
        ];
        return view(
            'admin.'.$this->path.'.index',
            compact('result')
        );
    }

    public function show($id)
    {
        $item = $this->contentRepository->getContentById($id);
        return view('admin.'.$this->path.'.show', compact('item'));
    }

    public function create(Content $item)
    {
        $result['services'] = $this->contentRepository->getAllContents('CompanyService');
        return view('admin.'.$this->path.'.create_and_edit', compact('item', 'result'));
    }

    public function store(ContentRequest $request)
    {
        $data = $request->all();
        if ($request->hasFile('image')) {
            $data['image'] = \App\Helpers\Image::upload($request->file('image'), $this->path);
        }
        $data['type'] = Constants::CompanyType;

        $company = $this->contentRepository->createContent($data);

        //save services
        if ($request->service_id) {
            foreach ($request->service_id as $id) {
                ServiceCompany::updateOrCreate(
                    ['company_id'=> $company->id,'service_id'=> $id], ['company_id'=> $company->id,'service_id'=> $id]
                );
            }
        }

        if (isset($request->action) && $request->action == 'preview') {
            return redirect()->route('admin.'.$this->path.'.store')
                    ->with('message', __('admin.AddedMessage'));
        }

        return redirect()->route('admin.'.$this->path.'.index')
            ->with('message', __('admin.AddedMessage'));
    }

    public function edit($id)
    {
        $item = $this->contentRepository->getContentById($id);
        $result['services'] = $this->contentRepository->getAllContents('CompanyService');

        return view('admin.'.$this->path.'.create_and_edit', compact('item', 'result'));
    }

    public function update(ContentRequest $request, $id)
    {
        $data = $request->except(['_token', '_method' ]);
        if ($request->hasFile('image')) {
            $data['image'] = \App\Helpers\Image::upload($request->file('image'), $this->path);
        }
        $this->contentRepository->updateContent($id, $data);
        $company = $this->contentRepository->getContentById($id);
        if ($request->service_id) {
            ServiceCompany::where('company_id', $company->id)
                ->whereNotIn('service_id', $request->service_id)->delete();

            foreach ($request->service_id as $id) {
                ServiceCompany::updateOrCreate(
                    ['company_id'=> $company->id,'service_id'=> $id],
                    ['company_id'=> $company->id,'service_id'=> $id]
                );
            }
        }
        return redirect()->route('admin.'.$this->path.'.index')
            ->with('message', __('admin.UpdatedMessage'));
    }

    public function destroy($id)
    {
        $this->contentRepository->deleteContent($id);

        return redirect()->route('admin.'.$this->path.'.index')
            ->with('message', __('admin.DeletedMessage'));
    }
}

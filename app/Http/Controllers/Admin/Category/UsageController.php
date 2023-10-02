<?php

namespace App\Http\Controllers\Admin\Category;

use App\Models\Category;
use App\Helpers\Constants;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Interfaces\CategoryRepositoryInterface;

class UsageController extends Controller
{
    private CategoryRepositoryInterface $categoryRepository;
    private $path = 'usages';
    private $scope = 'ApartmentUsage';


    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
        $this->middleware('auth');
        $this->middleware('checkPermission:usages.index')->only(['index']);
        $this->middleware('checkPermission:usages.show')->only(['show']);
        $this->middleware('checkPermission:usages.edit')->only(['edit']);
        $this->middleware('checkPermission:usages.delete')->only(['destroy']);
        $this->middleware('checkPermission:usages.create')->only(['create']);
    }

    public function index(Request $request)
    {
        $result = [];
        $data = $request->all();
        $status = $data['status'] ?? '-1';
        $search = $data['search'] ?? '';
        $from_date = $data['from_date'] ?? '';
        $to_date = $data['to_date'] ?? '';
        $counts = $this->categoryRepository->getCount($this->scope);
        $items = $this->categoryRepository->getPaginateCategories($data, $this->scope);
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
        $item = $this->categoryRepository->getCategoryById($id);
        return view('admin.'.$this->path.'.show', compact('item'));
    }

    public function create(Category $item)
    {
        return view('admin.'.$this->path.'.create_and_edit', compact('item'));
    }

    public function store(CategoryRequest $request)
    {
        $data = $request->all();
        $data['type'] = Constants::ApartmentUsage;

        $this->categoryRepository->createCategory($data);

        if (isset($request->action) && $request->action == 'preview') {
            return redirect()->route('admin.'.$this->path.'.store')
                    ->with('message', __('admin.AddedMessage'));
        }

        return redirect()->route('admin.'.$this->path.'.index')
            ->with('message', __('admin.AddedMessage'));
    }

    public function edit($id)
    {
        $item = $this->categoryRepository->getCategoryById($id);
        return view('admin.'.$this->path.'.create_and_edit', compact('item'));
    }

    public function update(CategoryRequest $request, $id)
    {
        $data = $request->except(['_token', '_method' ]);

        $this->categoryRepository->updateCategory($id, $data);

        return redirect()->route('admin.'.$this->path.'.index')
            ->with('message', __('admin.UpdatedMessage'));
    }

    public function destroy($id)
    {
        $this->categoryRepository->deleteCategory($id);

        return redirect()->route('admin.'.$this->path.'.index')
            ->with('message', __('admin.DeletedMessage'));
    }
}
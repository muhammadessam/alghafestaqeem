<?php

namespace App\Http\Controllers\Admin;

use App\Models\Content;
use App\Helpers\Constants;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ContentRequest;
use App\Interfaces\ContentRepositoryInterface;

class ObjectivesController extends Controller
{
    private ContentRepositoryInterface $contentRepository;
    private $path = 'objectives';
    private $scope = 'Objective';

    public function __construct(ContentRepositoryInterface $contentRepository)
    {
        $this->contentRepository = $contentRepository;
        $this->middleware('auth');
        $this->middleware('checkPermission:objectives.index')->only(['index']);
        $this->middleware('checkPermission:objectives.show')->only(['show']);
        $this->middleware('checkPermission:objectives.edit')->only(['edit']);
        $this->middleware('checkPermission:objectives.delete')->only(['destroy']);
        $this->middleware('checkPermission:objectives.create')->only(['create']);
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
        return view('admin.'.$this->path.'.create_and_edit', compact('item'));
    }

    public function store(ContentRequest $request)
    {
        $data = $request->all();
        if ($request->hasFile('image')) {
            $data['image'] = \App\Helpers\Image::upload($request->file('image'), $this->path);
        }
        $data['type'] = Constants::ObjectiveType;

        $this->contentRepository->createContent($data);

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
        return view('admin.'.$this->path.'.create_and_edit', compact('item'));
    }

    public function update(ContentRequest $request, $id)
    {
        $data = $request->except(['_token', '_method' ]);
        if ($request->hasFile('image')) {
            $data['image'] = \App\Helpers\Image::upload($request->file('image'), $this->path);
        }
        $this->contentRepository->updateContent($id, $data);

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

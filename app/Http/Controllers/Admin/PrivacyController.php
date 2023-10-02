<?php

namespace App\Http\Controllers\Admin;

use App\Models\Privacy;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ContentRequest;
use App\Interfaces\ContentRepositoryInterface;

class PrivacyController extends Controller
{
    private ContentRepositoryInterface $contentRepository;
    private $path = 'privacy';
    private $scope = 'privacy';

    public function __construct(ContentRepositoryInterface $contentRepository)
    {
        $this->contentRepository = $contentRepository;
        $this->middleware('auth');
        $this->middleware('checkPermission:services.index')->only(['index']);
        $this->middleware('checkPermission:services.show')->only(['show']);
        $this->middleware('checkPermission:services.edit')->only(['edit']);
        $this->middleware('checkPermission:services.delete')->only(['destroy']);
        $this->middleware('checkPermission:services.create')->only(['create']);

    }

    public function index(Request $request)
    {
        $Privacy=Privacy::first();
        return view(
            'admin.'.$this->path.'.index',
            compact('Privacy')
        );
    }


    public function update(request $request, $id)
    {
        $Privacy=Privacy::find($id);
        $Privacy->privacy_en=$request->privacy_en;
        $Privacy->privacy_ar=$request->privacy_ar;
        $Privacy->save();


        
        $data = $request->except(['_token', '_method' ]);
        
        return redirect()->route('admin.'.$this->path.'.index')
            ->with('message', __('admin.UpdatedMessage'));
    }

   
}
<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Permission\Role;
use App\Http\Requests\AdminRequest;
use App\Http\Controllers\Controller;
use App\Interfaces\AdminRepositoryInterface;

class AdminsController extends Controller
{
    private AdminRepositoryInterface $adminRepository;
    private $path = 'admins';

    public function __construct(AdminRepositoryInterface $adminRepository)
    {
        $this->adminRepository = $adminRepository;
        $this->middleware('auth');
        $this->middleware('checkPermission:admins.index')->only(['index']);
        $this->middleware('checkPermission:admins.show')->only(['show']);
        $this->middleware('checkPermission:admins.edit')->only(['edit']);
        $this->middleware('checkPermission:admins.delete')->only(['destroy']);
        $this->middleware('checkPermission:admins.create')->only(['create']);
    }

    public function index(Request $request)
    {
        $result = [];
        $data = $request->all();
        $status = $data['status'] ?? '-1';
        $search = $data['search'] ?? '';
        $from_date = $data['from_date'] ?? '';
        $to_date = $data['to_date'] ?? '';
        $counts = $this->adminRepository->getCount();
        $items = $this->adminRepository->getPaginateAdmins($data);
        $result = [
            'from_date' => $from_date,
            'to_date' => $to_date,
            'items' => $items,
            'counts' => $counts,
            'status' => $status,
            'search' => $search,
        ];
        return view(
            'admin.admins.index',
            compact('result')
        );
    }

    public function show($id)
    {
        $item = $this->adminRepository->getAdminById($id);
        return view('admin.admins.show', compact('item'));
    }

    public function create(User $item)
    {
        $result['roles'] = Role::all();
        return view('admin.admins.create_and_edit', compact('item', 'result'));
    }

    public function store(AdminRequest $request)
    {
        $data = $request->all();
        if ($request->hasFile('image')) {
            $data['image'] = \App\Helpers\Image::upload($request->file('image'), $this->path);
        }
        $user = $this->adminRepository->createAdmin($data);
        $user->syncRoles([$request->role_id]);

        if (isset($request->action) && $request->action == 'preview') {
            return redirect()->route('admin.admins.store')
                    ->with('message', __('admin.AddedMessage'));
        }

        return redirect()->route('admin.admins.index')
            ->with('message', __('admin.AddedMessage'));
    }

    public function edit($id)
    {
        $item = $this->adminRepository->getAdminById($id);
        $result['roles'] = Role::all();

        return view('admin.admins.create_and_edit', compact('item','result'));
    }

    public function update(AdminRequest $request, $id)
    {
        $data = $request->except(['_token', '_method' ]);
        if(! $request->password ){
            $data = $request->except(['_token', '_method','password' ]);
        }
        if ($request->hasFile('image')) {
            $data['image'] = \App\Helpers\Image::upload($request->file('image'), $this->path);
        }

        $this->adminRepository->updateAdmin($id, $data);
        $user = $this->adminRepository->getAdminById($id);


        return redirect()->route('admin.admins.index')
            ->with('message', __('admin.UpdatedMessage'));
    }

    public function destroy($id)
    {
        $this->adminRepository->deleteAdmin($id);

        return redirect()->route('admin.admins.index')
            ->with('message', __('admin.DeletedMessage'));
    }
}

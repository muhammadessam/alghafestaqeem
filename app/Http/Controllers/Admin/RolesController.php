<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Constants;
use Illuminate\Http\Request;
use App\Models\Permission\Role;
use App\Http\Requests\RequestRate;
use App\Http\Controllers\Controller;

use App\Http\Requests\ContentRequest;
use App\Models\Permission\Permission;
use App\Interfaces\RoleRepositoryInterface;

class RolesController extends Controller
{
    private RoleRepositoryInterface $roleRepository;

    public function __construct(RoleRepositoryInterface $roleRepository)
    {
        $this->roleRepository = $roleRepository;
        $this->middleware('auth');
        $this->middleware('checkPermission:roles.index')->only(['index']);
        $this->middleware('checkPermission:roles.show')->only(['show']);
        $this->middleware('checkPermission:roles.edit')->only(['edit']);
        $this->middleware('checkPermission:roles.delete')->only(['destroy']);
        $this->middleware('checkPermission:roles.create')->only(['create']);
    }

    public function index(Request $request)
    {
        $result = [];
        $data = $request->all();
        $status = $data['status'] ?? '-1';
        $search = $data['search'] ?? '';
        $from_date = $data['from_date'] ?? '';
        $to_date = $data['to_date'] ?? '';
        $counts = $this->roleRepository->getCount();
        $items = $this->roleRepository->getPaginateRoles($data);

        $result = [
            'from_date' => $from_date,
            'to_date' => $to_date,
            'items' => $items,
            'counts' => $counts,
            'status' => $status,
            'search' => $search,

        ];
        return view(
            'admin.roles.index',
            compact('result')
        );
    }

    public function create(Role $item)
    {
        $mainPermissions = Permission::Parent()->get();

        return view('admin.roles.create_and_edit', compact('item', 'mainPermissions'));
    }

    public function store(ContentRequest $request)
    {
        $data = $request->all();

        $role = $this->roleRepository->createRole($data);

        $permissions = $request->permissions;
        if (!empty($permissions)) {
            foreach ($permissions as $permission) {
                $permission = Permission::where('id', $permission)->firstOrFail();
                $role->permissions()->detach($permission->id);
                $role->permissions()->attach($permission->id);
            }
        }
        if (isset($request->action) && $request->action == 'preview') {
            return redirect()->route('admin.roles.store')
                    ->with('message', __('admin.AddedMessage'));
        }

        return redirect()->route('admin.roles.index')
            ->with('message', __('admin.AddedMessage'));
    }

    public function show($id)
    {
        $item = $this->roleRepository->getRoleById($id);
        return view('admin.roles.show', compact('item'));
    }

    public function edit($id)
    {
        $item = $this->roleRepository->getRoleById($id);
        $mainPermissions = Permission::Parent()->get();
        return view('admin.roles.create_and_edit', compact('item', 'mainPermissions'));
    }

    public function update(ContentRequest $request, $id)
    {
        $data = $request->except(['_token', '_method' ]);

        $this->roleRepository->updateRole($id, $data);
        $role = $this->roleRepository->getRoleById($id);
        $permissions = $request->permissions;

        $role->permissions()->sync($permissions);

        return redirect()->route('admin.roles.index')
            ->with('message', __('admin.UpdatedMessage'));
    }

    public function destroy($id)
    {
        $this->roleRepository->deleteRole($id);

        return redirect()->route('admin.roles.index')
            ->with('message', __('admin.DeletedMessage'));
    }
}
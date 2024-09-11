<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    public function __construct()
    {
        // Uncomment and set up middleware as required
        // $this->middleware('permission:view roles', ['only' => ['index']]);
        // $this->middleware('permission:create role', ['only' => ['create', 'store']]);
        // $this->middleware('permission:edit role', ['only' => ['edit', 'update']]);
        // $this->middleware('permission:delete role', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $roles = Role::orderBy('id', 'DESC')->paginate(5);
        return view('roles.index', compact('roles'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        $permission = Permission::all(); // Fetch all permissions
        return view('roles.create', compact('permission'));
    }

    public function store(Request $request)
    {
        // Validate incoming request data
        $request->validate([
            'name' => 'required|unique|string|max:255',
            'permission' => 'required|array',
            
        ],
    [
        'name.required' => 'يجب ادخال الاسم',
        'name.unique' => 'الاسم موجود مسبقا',
        'permission.required' => 'يجب ادخال الصلاحيات',
    ]);

        // Create new role
        $role = Role::create(['name' => $request->input('name')]);

        // Sync permissions
        $permissions = $request->input('permission', []);
        
        $role->permissions()->sync($permissions);
        

        return redirect()->route('roles.index')->with('success', 'Role created successfully.');
    }

    public function show($id)
    {
        $role = Role::findOrFail($id);
        $rolePermissions = $role->permissions; // Use Eloquent relationships
        return view('roles.show', compact('role', 'rolePermissions'));
    }

    public function edit($id)
    {
        $role = Role::findOrFail($id);
        $permission = Permission::all();
        $rolePermissions = $role->permissions->pluck('id')->toArray(); // Use Eloquent relationships
        return view('roles.edit', compact('role', 'permission', 'rolePermissions'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'permission' => 'array',
        ]);

        $role = Role::findOrFail($id);
        $role->update(['name' => $request->input('name')]);
         // Sync permissions
         $permissions = $request->input('permission', []);
        
         $role->permissions()->sync($permissions);

        return redirect()->route('roles.index')->with('success', 'Role updated successfully.');
    }

    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();

        return redirect()->route('roles.index')->with('success', 'Role deleted successfully.');
    }
}

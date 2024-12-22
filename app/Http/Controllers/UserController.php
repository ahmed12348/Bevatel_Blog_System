<?php

namespace App\Http\Controllers;


use App\Imports\UserImport;
use App\Exports\UserExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        // Apply middleware based on permissions for each action
        $this->middleware('permission:create_users')->only(['create', 'store']);
        $this->middleware('permission:edit_users')->only(['edit', 'update']);
        $this->middleware('permission:delete_users')->only(['destroy']);
        $this->middleware('permission:view_users')->only(['show', 'index']);
   
    }

    public function index(Request $request)
    {
        
        $search = $request->input('search');
        $query = User::query();

        if ($search) {
            $query->where('name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%");
        }

        // Paginate the results
        $users = $query->paginate(10); // 10 users per page, adjust as needed

        return view('dashboard.users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('dashboard.users.create', compact('roles'));
    }

    public function store(Request $request)
    {




        // return $request;
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'office_code' => 'required',
            'job_title' => 'required',
            'optional1' => 'nullable',
            'optional2' => 'nullable',
            'roles' => 'required|array',
        ]);


        // // Validate the request data using Laravel's built-in validation


        // // Process the validated da





        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'office_code' => $request->office_code,
            'job_title' => $request->job_title,

            'optional1' => $request->optional1,
            'optional2' => $request->optional2,
        ]);


        $user->assignRole($request->roles);
        return redirect()->route('dashboard.users.index')->with('success', 'User created successfully.');
    }

    public function show($id)
    {

        $user = User::with('roles')->find($id);
        return
            view('dashboard.users.show', compact('user'));
    }

    public function edit($id)
    {
        $user = User::with('roles')->find($id);

        $roles = Role::all();
        return view('dashboard.users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, $id)
    {
        // return  $request;
        // return $request;
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'roles' => 'nullable',  // Add validation for roles if needed
            'roles.*' => 'exists:roles,id',
        ]);

        $user = User::find($id);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'office_code' => $request->office_code,
            'job_title' => $request->job_title,
            'optional1' => $request->optional1,
            'optional2' => $request->optional2,
        ]);

        if ($request->password) {
            $user->update(['password' => Hash::make($request->password)]);
        }


        if ($request->has('roles')) {

            $user->syncRoles($request->input('roles')); // Ensure the roles are passed correctly
        }
        return redirect()->route('dashboard.users.index')->with('success', 'User updated successfully.');
    }

    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
    //     public function restore($id)
    // {
    //     $user = User::withTrashed()->findOrFail($id);
    //     $user->restore();

    //     return redirect()->route('users.index')->with('success', 'User restored successfully.');
    // }

  
}

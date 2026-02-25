<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Symfony\Component\HttpFoundation\Response;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(Admin::class, 'admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admins = Admin::where('id', '!=', auth('admin')->id())->get();
        return response()->view('cms.admins.index', compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::where('guard_name', 'admin')->get();
        return response()->view('cms.admins.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator($request->all(), [
            'name' => 'required|string|min:3|max:50',
            'email' => 'required|string|email|unique:admins,email',
            'role_id' => 'required|integer|exists:roles,id',
        ]);
        if (!$validator->fails()) {
            $role = Role::findById($request->get('role_id'), 'admin');
            $admin = new Admin();
            $admin->name = $request->get('name');
            $admin->email = $request->get('email');
            $admin->password = Hash::make(12345);
            $isSaved = $admin->save();
            if ($isSaved) {
                $admin->assignRole($role);
            }
            return response()->json([
                'message' => $isSaved ? 'Admin saved successfully' : 'Failed to save admin'
            ], $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);
        } else {
            return response()->json([
                'message' => $validator->getMessageBag()->first()
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $admin)
    {
        $roles = Role::where('guard_name', 'admin')->get();
        $assignedRoleName = $admin->getRoleNames()[0];
        return response()->view('cms.admins.edit', compact(['admin', 'roles', 'assignedRoleName']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Admin $admin)
    {
        $validator = Validator($request->all(), [
            'name' => 'required|string|min:3|max:50',
            'email' => 'required|string|email|unique:admins,email,' . $admin->id,
            'role_id' => 'required|integer|exists:roles,id',
        ]);
        if (!$validator->fails()) {
            $role = Role::findById($request->get('role_id'), 'admin');
            $admin->name = $request->get('name');
            $admin->email = $request->get('email');
            $isSaved = $admin->save();
            if ($isSaved) {
                $admin->syncRoles($role);
            }
            return response()->json([
                'message' => $isSaved ? 'Admin updated successfully' : 'Failed to update admin'
            ], $isSaved ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
        } else {
            return response()->json([
                'message' => $validator->getMessageBag()->first()
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin)
    {
        $isDeleted = $admin->delete();
        return response()->json([
            'title' => $isDeleted ? 'Admin deleted successfully' : 'Failed to delete Admin',
            'icon' => $isDeleted ? 'success' : 'error'
        ], $isDeleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
    }
}

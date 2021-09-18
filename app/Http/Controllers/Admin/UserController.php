<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserRequestUpdate;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $user = User::all();

        return view('admin.user.index', compact('user'));
    }

    public function create()
    {
        $roles = Role::all();

        return view('admin.user.create', compact('roles'));
    }

    public function store(UserRequest $request, User $user)
    {
        $request->validated();

        if ($request->hasFile('avatar')) {
            $img = $request->file('avatar');
            $user['avatar'] = time().'-'. $img->getClientOriginalName();

            $filePath = public_path('/upload/user');
            $img->move($filePath, $user['avatar']);
        }

        User::Create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->get('password')),
            'role_id' => $request->role_id,
            'avatar' => $user['avatar'],
        ]);

        return redirect()->route('user.index')->with(['success' => 'User Created Successfully']);
    }

    public function edit(User $user)
    {   

        $roles = Role::all();
        return view('admin.user.edit', compact('user', 'roles'));
    }

    public function update(UserRequestUpdate $request, User $user)
    {
        $request->validated();

        if ($request->hasFile('avatar')) {
            $img = $request->file('avatar');
            $user['avatar'] = time().'-'. $img->getClientOriginalName();

            $filePath = public_path('/upload/user');
            $img->move($filePath, $user['avatar']);
        }

        if(!empty($request->password)) {
            $user->update([
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->get('password')),
                'role_id' => $request->role_id,
                'avatar' => $user['avatar'],
            ]);
        } else {
            $user->update([
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'role_id' => $request->role_id,
                'avatar' => $user['avatar'],
            ]);
        }

        return redirect()->back()->with(['success' => 'User Uodate Successfully']);
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->back()->with(['success' => 'User Delete Successfully']);
    }
}

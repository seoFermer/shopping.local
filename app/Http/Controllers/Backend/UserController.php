<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('name')->paginate();
        return view('backend.user.index', compact('users'));
    }

    public function show(User $user)
    {
        return view('backend.user.show', compact('user'));
    }

    public function create()
    {
        return view('backend.user.create');
    }

    public function store(StoreRequest $request, Role $role)
    {
        $data = $request->validated();

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'email_verified_at' => now(),
        ]);

        $role = $role->findByName(User::ROLE_USER);
        $user->assignRole($role->id);

        return redirect()->route('dashboard.user.index');
    }

    public function edit(User $user)
    {
        return view('backend.user.edit', compact('user'));
    }

    public function update(UpdateRequest $request, User $user)
    {
        $data = $request->validated();
        $user->update($data);

        return redirect()->route('dashboard.user.show', $user->id);
    }

    public function delete(User $user)
    {
        $user->delete();

        return redirect()->route('dashboard.user.index');
    }

}

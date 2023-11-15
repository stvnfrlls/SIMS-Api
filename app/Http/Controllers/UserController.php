<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Support\Arr;

class UserController extends Controller
{
    public function getAll()
    {
        $users = User::all();
        return response()->json($users);
    }

    public function storeUser(UserRequest $request)
    {
        $user = User::create($request->all());
        return response()->json($user);
    }

    public function getUser(User $user)
    {
        $user->load('userAddress');
        Arr::forget($user, ['email_verified_at', 'created_at', 'updated_at', 'deleted_at']);

        $cityMunicipalities = $user->userAddress;

        $cityMunicipalities->load('cityMunicipalities');

        return response()->json($user);
    }

    public function updateUser(UserRequest $request, User $user)
    {
        $user->update($request->all());
        return response()->json($user);
    }

    public function removeUser(User $user)
    {
        $user->delete();
    }
}

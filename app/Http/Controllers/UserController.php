<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class UserController extends Controller
{
    public function getAll()
    {
        $users = User::all();

        return response()->json($users);
    }

    public function storeUser(Request $request)
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

    public function updateUser(Request $request, User $user)
    {
        $user->update($request->all());
        return response()->json($user);
    }

    public function removeUser(User $user)
    {
        $user->delete();
    }
}

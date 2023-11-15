<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserAddressRequest;
use App\Models\UserAddress;

class UserAddressController extends Controller
{
    public function getAllAddress()
    {
        $userAddresses = UserAddress::orderBy("created_at", "desc")->paginate(10);
        return response()->json($userAddresses);
    }

    public function storeUserAddress(UserAddressRequest $request)
    {
        $userAddress = UserAddress::create($request->all());
        return response()->json($userAddress);
    }

    public function getUserAddress(UserAddress $userAddress)
    {
        return response()->json($userAddress);
    }

    public function updateUserAddress(UserAddressRequest $request, UserAddress $userAddress)
    {
        $userAddress->update($request->all());
        return response()->json($userAddress);
    }

    public function deleteUserAddress(UserAddress $userAddress)
    {
        $userAddress->delete();
    }
}

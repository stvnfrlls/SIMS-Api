<?php

namespace App\Http\Controllers;

use App\Models\UserAddress;
use Illuminate\Http\Request;

class UserAddressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getAllAddress()
    {
        $userAddresses = UserAddress::orderBy("created_at", "desc")->paginate(10);
        return response()->json($userAddresses);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeUserAddress(Request $request)
    {
        $userAddress = UserAddress::create($request->all());
        return response()->json($userAddress);
    }

    /**
     * Display the specified resource.
     */
    public function getUserAddress(UserAddress $userAddress)
    {
        return response()->json($userAddress);
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateUserAddress(Request $request, UserAddress $userAddress)
    {
        $userAddress->update($request->all());
        return response()->json($userAddress);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function deleteUserAddress(UserAddress $userAddress)
    {
        $userAddress->delete();
    }
}

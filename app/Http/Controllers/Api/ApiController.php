<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\User;

class ApiController extends Controller
{
	// public function __construct()
    // {
    //    $this->middleware('api-key');
    // }

    public function login(Request $request)
    {
    	$loginCheck = User::loginApi($request);
    	return response()->json($loginCheck, $loginCheck['code']);
    }

    public function registerAsesi(Request $request)
    {
    	$registerCheck = User::registerApi($request);
    	return response()->json($registerCheck, $registerCheck['code']);
    }

    public function EditProfile(Request $request, $id)
    {
    	$completeAkunCheck = User::EditProfile($request, $id);
    	return response()->json($completeAkunCheck, $completeAkunCheck['code']);
    }

    public function EditPassword(Request $request, $id)
    {
    	$completeAkunCheck = User::EditPassword($request, $id);
    	return response()->json($completeAkunCheck, $completeAkunCheck['code']);
    }
    

}

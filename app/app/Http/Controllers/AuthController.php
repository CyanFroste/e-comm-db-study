<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\user;
use App\StatusCode;

class AuthController extends Controller
{
	const BASE_URL = 'http://127.0.0.1:8001';

	// login
	public function login(Request $request)
	{
		try {
			$loginData = $request->validate([
				'phone' => 'required|digits:10',
				'password' => 'required'
			]);
			if (Auth::attempt($loginData)) {
				// sending request to the same port will kill this instance
				$response = Http::asForm()->post(self::BASE_URL . '/oauth/token', [
					'grant_type' => 'password',
					'client_id' => env('PASSWORD_GRANT_CLIENT_ID'),
					'client_secret' => env('PASSWORD_GRANT_CLIENT_SECRET'),
					'username' => $loginData['phone'],
					'password' => $loginData['password'],
					'scope' => '*',
				]);
				return response()->json(['user' => Auth::user(), 'token' => json_decode($response, true)], StatusCode::OK);
			}
			return response()->json(['message' => 'Invalid credentials'], StatusCode::UNAUTHORIZED);
		} catch (\Exception $e) {
			return response()->json(['message' => $e->validator->getMessageBag()], StatusCode::BAD_REQUEST);
		}
	}

	// register
	public function register(Request $request)
	{
		try {
			$credentials = $request->validate([
				'name' => 'required|max:55',
				'phone' => 'required|unique:users|digits:10',
				'email' => 'email',	
				'password' => 'required|confirmed'
			]);
			// decrypted password
			$password = $credentials['password'];
			// encrypting the password
			$credentials['password'] = bcrypt($request->password);
			$user = User::create($credentials);
			$response = Http::asForm()->post(self::BASE_URL . '/oauth/token', [
				'grant_type' => 'password',
				'client_id' => env('PASSWORD_GRANT_CLIENT_ID'),
				'client_secret' => env('PASSWORD_GRANT_CLIENT_SECRET'),
				'username' => $user['phone'],
				'password' => $password,
				'scope' => '*',
			]);
			return response()->json(['user' => $user, 'token' => json_decode($response, true)], StatusCode::OK);
		} catch (\Exception $e) {
			return response()->json(['message' => $e->validator->getMessageBag()], StatusCode::BAD_REQUEST);
		}
	}

	// logout
	public function logout(Request $request)
	{
		$request->user()->token()->revoke();
		return response()->json(['message' => 'Logged out'], StatusCode::OK);
	}

	// get current user
	public function user()
	{
		return response()->json(Auth::user(), StatusCode::OK);
	}
}

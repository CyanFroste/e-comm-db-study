<?php

namespace App\Http\Controllers;

use App\StatusCode;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class AuthHelperController extends Controller
{
	// forgot password
	public function forgot(Request $request)
	{
		try {
			$info = $request->validate([
				'email' => 'required|email'
			]);

			if (User::where('email', $info['email'])->doesntExist()) {
				return response()->json(['message' => 'User doesn\'t exist'], StatusCode::BAD_REQUEST);
			}

			$token = Str::random(10);


			DB::table('password_resets')->insert([
				'email' => $info['email'],
				'token' => $token,
				'created_at' => now()
			]);

			// send email to reset
			Mail::send('mails.reset', ['token' => $token], function ($message) use ($info) {
				$message->to($info['email']);
				$message->subject('Reset Password');
			});

			return response()->json(['message' => 'Check your mailbox'], StatusCode::OK);
			// return response()->json(['reset_token' => $token], StatusCode::OK);
		} catch (\Exception $e) {
			return response()->json(['message' => $e->getMessage()], StatusCode::BAD_REQUEST);
		}
	}

	// reset password
	public function reset(Request $request)
	{

		try {
			$info = $request->validate([
				'token' => 'required',
				'password' => 'required|confirmed'
			]);

			if (!$passwordReset = DB::table('password_resets')->where('token', $info['token'])->first()) {
				return response()->json(['message' => 'Invalid token'], StatusCode::BAD_REQUEST);
			}

			if (!$user = User::where('email', $passwordReset->email)->first()) {
				return response()->json(['message' => 'User doesn\'t Exist'], StatusCode::BAD_REQUEST);
			}

			// save new password
			$user->password = bcrypt($info['password']);
			$user->save();
			// delete token
			DB::table('password_resets')->where('token', $info['token'])->delete();


			return response()->json(['message' => 'Password Successfully Changed'], StatusCode::OK);
		} catch (\Exception $e) {
			return response()->json(['message' => $e->getMessage()], StatusCode::BAD_REQUEST);
		}
	}
}

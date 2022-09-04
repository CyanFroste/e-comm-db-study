<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
	use Notifiable, HasApiTokens, HasRoles;

	// to generate access token using phone number
	public function findForPassport($username)
	{
		return $this->where('phone', $username)->first();
	}

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name', 'phone', 'email', 'password', 'profile',
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password', 'remember_token',
	];

	/**
	 * The attributes that should be cast to native types.
	 *
	 * @var array
	 */
	protected $casts = [
		'email_verified_at' => 'datetime',
		'phone_verified_at' => 'datetime',
	];

	// relationships
	public function meta() {
		return $this->hasOne('App\UserMeta');
	}
	
	public function addresses(){
		return $this->hasMany('App\Address');
	}

	// public function orders()
	// {
	// 	return $this->belongsToMany('App\Order', 'transactions')
	//		->as('transaction')
	// 		->withTimestamps()
	// 		->withPivot([
	// 			'description', 'code', 'type', 'mode', 'status'
	// 		]);
	// }

	public function orders() {
		return $this->hasMany('App\Order');
	}

	public function carts() {
		return $this->hasMany('App\Cart');
	}

	public function reviews() {
		return $this->hasMany('App\ProductReview');
	}


}

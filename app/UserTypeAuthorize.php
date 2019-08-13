<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserTypeAuthorize extends Model
{
    protected $table = 'user_type_authorizes';
	protected $primaryKey = 'user_type_auth_id';
	public $timestamps = true;

	protected $casts = [
		'user_id' => 'int',
		'user_type_id' => 'int'
	];

	protected $dates = [
		'setupdate'
	];

	protected $fillable = [
		'user_id',
		'user_type_id',
		'setupdate'
	];
}

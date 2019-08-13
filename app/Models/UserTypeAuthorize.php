<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 17 Jul 2019 19:31:28 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class UserTypeAuthorize
 * 
 * @property int $user_type_auth_id
 * @property int $user_id
 * @property int $user_type_id
 * @property \Carbon\Carbon $setupdate
 *
 * @package App\Models
 */
class UserTypeAuthorize extends Eloquent
{
	protected $table = 'user_type_authorize';
	protected $primaryKey = 'user_type_auth_id';
	public $timestamps = false;

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

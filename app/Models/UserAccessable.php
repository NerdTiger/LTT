<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 17 Jul 2019 19:31:28 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class UserAccessable
 * 
 * @property int $user_accessable_id
 * @property string $user_loginname
 * @property int $access
 *
 * @package App\Models
 */
class UserAccessable extends Eloquent
{
	protected $table = 'user_accessable';
	protected $primaryKey = 'user_accessable_id';
	public $timestamps = false;

	protected $casts = [
		'access' => 'int'
	];

	protected $fillable = [
		'user_loginname',
		'access'
	];
}

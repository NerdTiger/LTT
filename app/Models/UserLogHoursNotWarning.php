<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 17 Jul 2019 19:31:28 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class UserLogHoursNotWarning
 * 
 * @property int $user_log_hours_warnings_id
 * @property int $user_id
 *
 * @package App\Models
 */
class UserLogHoursNotWarning extends Eloquent
{
	protected $primaryKey = 'user_log_hours_warnings_id';
	public $timestamps = false;

	protected $casts = [
		'user_id' => 'int'
	];

	protected $fillable = [
		'user_id'
	];
}

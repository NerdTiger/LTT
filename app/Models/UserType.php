<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 17 Jul 2019 19:31:28 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class UserType
 * 
 * @property int $user_type_id
 * @property string $user_type_name
 * @property string $user_entrymodel
 * @property string $user_entrymethod
 *
 * @package App\Models
 */
class UserType extends Eloquent
{
	protected $table = 'user_types';
	protected $primaryKey = 'user_type_id';
	public $timestamps = false;

	protected $fillable = [
		'user_type_name',
		'user_entrymodel',
		'user_entrymethod'
	];
}

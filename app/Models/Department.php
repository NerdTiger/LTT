<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 17 Jul 2019 19:31:27 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Department
 * 
 * @property int $department_id
 * @property string $department_code
 * @property string $department_name
 *
 * @package App\Models
 */
class Department extends Eloquent
{
	protected $primaryKey = 'department_id';
	public $timestamps = false;

	protected $fillable = [
		'department_code',
		'department_name'
	];
}

<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 17 Jul 2019 19:31:27 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class JobRole
 * 
 * @property int $job_role_id
 * @property string $job_role_name
 * @property int $job_role_active
 *
 * @package App\Models
 */
class JobRole extends Eloquent
{
	protected $primaryKey = 'job_role_id';
	public $timestamps = false;

	protected $casts = [
		'job_role_active' => 'int'
	];

	protected $fillable = [
		'job_role_name',
		'job_role_active'
	];
}

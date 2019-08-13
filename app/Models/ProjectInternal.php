<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 17 Jul 2019 19:31:28 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class ProjectInternal
 * 
 * @property int $project_internal_id
 * @property int $project_id
 * @property int $project_sb_department_id
 * @property int $project_department_manager_id
 * @property int $project_internal_project_type_id
 *
 * @package App\Models
 */
class ProjectInternal extends Eloquent
{
	protected $table = 'project_internal';
	protected $primaryKey = 'project_internal_id';
	public $timestamps = false;

	protected $casts = [
		'project_id' => 'int',
		'project_sb_department_id' => 'int',
		'project_department_manager_id' => 'int',
		'project_internal_project_type_id' => 'int'
	];

	protected $fillable = [
		'project_id',
		'project_sb_department_id',
		'project_department_manager_id',
		'project_internal_project_type_id'
	];
}

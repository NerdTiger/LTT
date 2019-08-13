<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 17 Jul 2019 19:31:28 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class ProjectResource
 * 
 * @property int $project_resource_id
 * @property int $project_resource_project_lead
 * @property int $project_resource_project_id
 * @property int $project_resource_resource_id
 * @property int $project_resource_project_client_manager_id
 * @property int $project_resource_role_id
 * @property string $project_resource_title
 * @property float $project_resource_sales_beacon_rate
 * @property float $project_resource_client_rate
 * @property float $project_resource_hours
 * @property int $project_resource_require_schedule
 * @property string $project_resource_comment
 * @property int $project_resource_active
 * @property string $project_resource_jobrole
 * @property int $project_resource_is_bonus
 *
 * @package App\Models
 */
class ProjectResource extends Eloquent
{
	protected $table = 'project_resource';
	protected $primaryKey = 'project_resource_id';
	public $timestamps = false;

	protected $casts = [
		'project_resource_project_lead' => 'int',
		'project_resource_project_id' => 'int',
		'project_resource_resource_id' => 'int',
		'project_resource_project_client_manager_id' => 'int',
		'project_resource_role_id' => 'int',
		'project_resource_sales_beacon_rate' => 'float',
		'project_resource_client_rate' => 'float',
		'project_resource_hours' => 'float',
		'project_resource_require_schedule' => 'int',
		'project_resource_active' => 'int',
		'project_resource_is_bonus' => 'int'
	];

	protected $fillable = [
		'project_resource_project_lead',
		'project_resource_project_id',
		'project_resource_resource_id',
		'project_resource_project_client_manager_id',
		'project_resource_role_id',
		'project_resource_title',
		'project_resource_sales_beacon_rate',
		'project_resource_client_rate',
		'project_resource_hours',
		'project_resource_require_schedule',
		'project_resource_comment',
		'project_resource_active',
		'project_resource_jobrole',
		'project_resource_is_bonus'
	];
}

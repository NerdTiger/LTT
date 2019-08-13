<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 17 Jul 2019 19:31:28 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class ProjectStatus
 * 
 * @property int $project_status_id
 * @property string $project_status
 *
 * @package App\Models
 */
class ProjectStatus extends Eloquent
{
	protected $table = 'project_status';
	protected $primaryKey = 'project_status_id';
	public $timestamps = false;

	protected $fillable = [
		'project_status'
	];
}

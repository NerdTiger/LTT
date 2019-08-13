<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 17 Jul 2019 19:31:28 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class ProjectLocation
 * 
 * @property int $project_location_id
 * @property string $project_location_abbr
 * @property string $project_location_comments
 *
 * @package App\Models
 */
class ProjectLocation extends Eloquent
{
	protected $table = 'project_location';
	protected $primaryKey = 'project_location_id';
	public $timestamps = false;

	protected $fillable = [
		'project_location_abbr',
		'project_location_comments'
	];
}

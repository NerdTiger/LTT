<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 17 Jul 2019 19:31:27 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class InternalProjectType
 * 
 * @property int $internal_project_type_id
 * @property string $internal_project_type_name
 *
 * @package App\Models
 */
class InternalProjectType extends Eloquent
{
	protected $table = 'internal_project_type';
	protected $primaryKey = 'internal_project_type_id';
	public $timestamps = false;

	protected $fillable = [
		'internal_project_type_name'
	];
}

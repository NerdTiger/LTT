<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 17 Jul 2019 19:31:27 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class ProjectCompany
 * 
 * @property int $project_company_id
 * @property string $project_company_name
 * @property int $project_company_active
 *
 * @package App\Models
 */
class ProjectCompany extends Eloquent
{
	protected $table = 'project_company';
	protected $primaryKey = 'project_company_id';
	public $timestamps = false;

	protected $casts = [
		'project_company_active' => 'int'
	];

	protected $fillable = [
		'project_company_name',
		'project_company_active'
	];
}

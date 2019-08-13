<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 17 Jul 2019 19:31:28 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class ProjectPayee
 * 
 * @property int $project_payee_id
 * @property string $project_payee_name
 * @property int $project_payee_active
 *
 * @package App\Models
 */
class ProjectPayee extends Eloquent
{
	protected $table = 'project_payee';
	protected $primaryKey = 'project_payee_id';
	public $timestamps = false;

	protected $casts = [
		'project_payee_active' => 'int'
	];

	protected $fillable = [
		'project_payee_name',
		'project_payee_active'
	];
}

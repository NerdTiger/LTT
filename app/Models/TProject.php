<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 17 Jul 2019 19:31:28 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class TProject
 * 
 * @property int $project_id
 * @property int $project_year
 * @property int $project_submitter
 * @property \Carbon\Carbon $project_created_date
 * @property int $project_priority
 * @property int $project_renewal
 * @property int $project_number
 * @property string $project_title
 * @property int $project_location
 * @property int $project_functional_area_id
 * @property string $project_division
 * @property float $project_budget
 * @property int $project_commission
 * @property int $project_bonus
 * @property int $project_cisco_rate_card
 * @property int $project_company
 * @property string $project_salesbeacon_company
 * @property string $project_sponsor
 * @property string $project_sponsor_title
 * @property \Carbon\Carbon $project_start
 * @property \Carbon\Carbon $project_end
 * @property float $project_original_hours
 * @property int $project_practice_area_id
 * @property string $project_currency
 * @property int $project_payee
 * @property int $project_status
 * @property string $project_notes
 * @property int $project_type
 * @property int $project_active
 * @property int $project_remaining_hours
 *
 * @package App\Models
 */
class TProject extends Eloquent
{
	protected $table = 't_project';
	protected $primaryKey = 'project_id';
	public $timestamps = false;

	protected $casts = [
		'project_year' => 'int',
		'project_submitter' => 'int',
		'project_priority' => 'int',
		'project_renewal' => 'int',
		'project_number' => 'int',
		'project_location' => 'int',
		'project_functional_area_id' => 'int',
		'project_budget' => 'float',
		'project_commission' => 'int',
		'project_bonus' => 'int',
		'project_cisco_rate_card' => 'int',
		'project_company' => 'int',
		'project_original_hours' => 'float',
		'project_practice_area_id' => 'int',
		'project_payee' => 'int',
		'project_status' => 'int',
		'project_type' => 'int',
		'project_active' => 'int',
		'project_remaining_hours' => 'int'
	];

	protected $dates = [
		'project_created_date',
		'project_start',
		'project_end'
	];

	protected $fillable = [
		'project_year',
		'project_submitter',
		'project_created_date',
		'project_priority',
		'project_renewal',
		'project_number',
		'project_title',
		'project_location',
		'project_functional_area_id',
		'project_division',
		'project_budget',
		'project_commission',
		'project_bonus',
		'project_cisco_rate_card',
		'project_company',
		'project_salesbeacon_company',
		'project_sponsor',
		'project_sponsor_title',
		'project_start',
		'project_end',
		'project_original_hours',
		'project_practice_area_id',
		'project_currency',
		'project_payee',
		'project_status',
		'project_notes',
		'project_type',
		'project_active',
		'project_remaining_hours'
	];
}

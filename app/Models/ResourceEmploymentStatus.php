<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 17 Jul 2019 19:31:28 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class ResourceEmploymentStatus
 * 
 * @property int $resource_employment_status_id
 * @property string $resource_status
 * @property bool $auto_invoice
 * @property string $bill_address
 *
 * @package App\Models
 */
class ResourceEmploymentStatus extends Eloquent
{
	protected $table = 'resource_employment_status';
	protected $primaryKey = 'resource_employment_status_id';
	public $timestamps = false;

	protected $casts = [
		'auto_invoice' => 'bool'
	];

	protected $fillable = [
		'resource_status',
		'auto_invoice',
		'bill_address'
	];
}

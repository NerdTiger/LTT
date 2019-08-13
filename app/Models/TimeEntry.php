<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 17 Jul 2019 19:31:28 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class TimeEntry
 * 
 * @property int $entry_id
 * @property \Carbon\Carbon $entry_date
 * @property float $entry_hours
 * @property int $entry_project_resource_id
 * @property \Carbon\Carbon $entry_timestamp
 * @property string $entry_details
 * @property bool $entry_deleted
 *
 * @package App\Models
 */
class TimeEntry extends Eloquent
{
	protected $table = 'time_entry';
	protected $primaryKey = 'entry_id';
	public $timestamps = false;

	protected $casts = [
		'entry_hours' => 'float',
		'entry_project_resource_id' => 'int',
		'entry_deleted' => 'bool'
	];

	protected $dates = [
		'entry_date',
		'entry_timestamp'
	];

	protected $fillable = [
		'entry_date',
		'entry_hours',
		'entry_project_resource_id',
		'entry_timestamp',
		'entry_details',
		'entry_deleted'
	];
}

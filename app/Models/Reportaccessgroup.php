<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 17 Jul 2019 19:31:28 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Reportaccessgroup
 * 
 * @property int $group_id
 * @property string $groupname
 * @property int $report_id
 * @property string $reportname
 * @property string $comments
 * @property string $addedBy
 * @property \Carbon\Carbon $addedDate
 *
 * @package App\Models
 */
class Reportaccessgroup extends Eloquent
{
	protected $table = 'reportaccessgroup';
	protected $primaryKey = 'group_id';
	public $timestamps = false;

	protected $casts = [
		'report_id' => 'int'
	];

	protected $dates = [
		'addedDate'
	];

	protected $fillable = [
		'groupname',
		'report_id',
		'reportname',
		'comments',
		'addedBy',
		'addedDate'
	];
}

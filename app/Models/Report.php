<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 17 Jul 2019 19:31:28 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Report
 * 
 * @property int $report_id
 * @property string $report_title
 * @property string $report_description
 * @property string $linkaddress
 * @property string $comments
 * @property string $addedBy
 * @property \Carbon\Carbon $addedDate
 *
 * @package App\Models
 */
class Report extends Eloquent
{
	protected $primaryKey = 'report_id';
	public $timestamps = false;

	protected $dates = [
		'addedDate'
	];

	protected $fillable = [
		'report_title',
		'report_description',
		'linkaddress',
		'comments',
		'addedBy',
		'addedDate'
	];
}

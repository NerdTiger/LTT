<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 17 Jul 2019 19:31:27 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Eventslog
 * 
 * @property int $log_id
 * @property string $log_action
 * @property string $log_subject
 * @property string $log_comments
 * @property string $log_author
 * @property \Carbon\Carbon $log_date
 *
 * @package App\Models
 */
class Eventslog extends Eloquent
{
	protected $table = 'eventslog';
	protected $primaryKey = 'log_id';
	public $timestamps = false;

	protected $dates = [
		'log_date'
	];

	protected $fillable = [
		'log_action',
		'log_subject',
		'log_comments',
		'log_author',
		'log_date'
	];
}

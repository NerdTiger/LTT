<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 17 Jul 2019 19:31:28 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Reportaccess
 * 
 * @property int $RA_id
 * @property int $report_id
 * @property string $report_title
 * @property int $user_id
 * @property string $user_name
 * @property string $user_mail
 * @property string $mail_option
 * @property int $authorizedby
 * @property \Carbon\Carbon $authorizeddate
 *
 * @package App\Models
 */
class Reportaccess extends Eloquent
{
	protected $table = 'reportaccess';
	protected $primaryKey = 'RA_id';
	public $timestamps = false;

	protected $casts = [
		'report_id' => 'int',
		'user_id' => 'int',
		'authorizedby' => 'int'
	];

	protected $dates = [
		'authorizeddate'
	];

	protected $fillable = [
		'report_id',
		'report_title',
		'user_id',
		'user_name',
		'user_mail',
		'mail_option',
		'authorizedby',
		'authorizeddate'
	];
}

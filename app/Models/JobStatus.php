<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 17 Jul 2019 19:31:27 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class JobStatus
 * 
 * @property int $js_id
 * @property string $js_name
 * @property string $js_color
 * @property string $js_hor_img
 *
 * @package App\Models
 */
class JobStatus extends Eloquent
{
	protected $table = 'job_status';
	protected $primaryKey = 'js_id';
	public $timestamps = false;

	protected $fillable = [
		'js_name',
		'js_color',
		'js_hor_img'
	];
}

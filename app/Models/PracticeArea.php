<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 17 Jul 2019 19:31:27 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class PracticeArea
 * 
 * @property int $practice_area_id
 * @property string $practice_area_name
 * @property int $practice_area_active
 *
 * @package App\Models
 */
class PracticeArea extends Eloquent
{
	protected $table = 'practice_area';
	protected $primaryKey = 'practice_area_id';
	public $timestamps = false;

	protected $casts = [
		'practice_area_active' => 'int'
	];

	protected $fillable = [
		'practice_area_name',
		'practice_area_active'
	];
}

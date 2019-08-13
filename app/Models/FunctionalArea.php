<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 17 Jul 2019 19:31:27 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class FunctionalArea
 * 
 * @property int $functional_area_id
 * @property string $functional_area_name
 *
 * @package App\Models
 */
class FunctionalArea extends Eloquent
{
	protected $table = 'functional_area';
	protected $primaryKey = 'functional_area_id';
	public $timestamps = false;

	protected $fillable = [
		'functional_area_name'
	];
}

<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 17 Jul 2019 19:31:27 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Option
 * 
 * @property int $option_id
 * @property string $option_name
 * @property string $option_value
 *
 * @package App\Models
 */
class Option extends Eloquent
{
	protected $table = 'options';
	protected $primaryKey = 'option_id';
	public $timestamps = false;

	protected $fillable = [
		'option_name',
		'option_value'
	];
}

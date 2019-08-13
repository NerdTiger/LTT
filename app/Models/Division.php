<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 17 Jul 2019 19:31:27 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Division
 * 
 * @property int $division_id
 * @property string $division_name
 *
 * @package App\Models
 */
class Division extends Eloquent
{
	protected $table = 'division';
	protected $primaryKey = 'division_id';
	public $timestamps = false;

	protected $fillable = [
		'division_name'
	];
}

<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 17 Jul 2019 19:31:27 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Location
 * 
 * @property int $location_id
 * @property string $location_abbr
 * @property string $location_name
 *
 * @package App\Models
 */
class Location extends Eloquent
{
	protected $table = 'location';
	protected $primaryKey = 'location_id';
	public $timestamps = false;

	protected $fillable = [
		'location_abbr',
		'location_name'
	];
}

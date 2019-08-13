<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 17 Jul 2019 19:31:27 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Currency
 * 
 * @property int $currency_id
 * @property string $currency_type
 *
 * @package App\Models
 */
class Currency extends Eloquent
{
	protected $table = 'currency';
	protected $primaryKey = 'currency_id';
	public $timestamps = false;

	protected $fillable = [
		'currency_type'
	];
}

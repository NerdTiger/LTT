<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 17 Jul 2019 19:31:28 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class UserDiversity
 * 
 * @property int $id
 * @property string $diversity
 *
 * @package App\Models
 */
class UserDiversity extends Eloquent
{
	protected $table = 'user_diversity';
	public $timestamps = false;

	protected $fillable = [
		'diversity'
	];
}

<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 17 Jul 2019 19:31:28 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Projectcm
 * 
 * @property int $id
 * @property string $CM_name
 * @property string $CM_comments
 *
 * @package App\Models
 */
class Projectcm extends Eloquent
{
	protected $table = 'projectcm';
	public $timestamps = false;

	protected $fillable = [
		'CM_name',
		'CM_comments'
	];
}

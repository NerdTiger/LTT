<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 17 Jul 2019 19:31:28 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Title
 * 
 * @property int $title_id
 * @property string $title_name
 *
 * @package App\Models
 */
class Title extends Eloquent
{
	protected $table = 'title';
	protected $primaryKey = 'title_id';
	public $timestamps = false;

	protected $fillable = [
		'title_name'
	];
}

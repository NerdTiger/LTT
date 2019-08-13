<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 17 Jul 2019 19:31:28 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class SystemMessage
 * 
 * @property int $system_message_id
 * @property int $message_type
 * @property string $message_text
 *
 * @package App\Models
 */
class SystemMessage extends Eloquent
{
	protected $primaryKey = 'system_message_id';
	public $timestamps = false;

	protected $casts = [
		'message_type' => 'int'
	];

	protected $fillable = [
		'message_type',
		'message_text'
	];
}

<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 17 Jul 2019 19:31:27 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Groupmember
 * 
 * @property int $groupMember_id
 * @property int $group_id
 * @property string $groupname
 * @property int $user_id
 * @property string $username
 * @property string $comments
 * @property string $addedBy
 * @property \Carbon\Carbon $addedDate
 *
 * @package App\Models
 */
class Groupmember extends Eloquent
{
	protected $table = 'groupmember';
	protected $primaryKey = 'groupMember_id';
	public $timestamps = false;

	protected $casts = [
		'group_id' => 'int',
		'user_id' => 'int'
	];

	protected $dates = [
		'addedDate'
	];

	protected $fillable = [
		'group_id',
		'groupname',
		'user_id',
		'username',
		'comments',
		'addedBy',
		'addedDate'
	];
}

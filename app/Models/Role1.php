<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 17 Jul 2019 19:31:28 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Role1
 * 
 * @property int $role_id
 * @property string $role_name
 * @property bool $is_external
 * @property bool $is_internal
 *
 * @package App\Models
 */
class Role1 extends Eloquent
{
	protected $table = 'role1';
	protected $primaryKey = 'role_id';
	public $timestamps = false;

	protected $casts = [
		'is_external' => 'bool',
		'is_internal' => 'bool'
	];

	protected $fillable = [
		'role_name',
		'is_external',
		'is_internal'
	];
}

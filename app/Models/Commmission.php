<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 17 Jul 2019 19:31:27 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Commmission
 * 
 * @property int $commmission_id
 * @property int $commission_project_id
 * @property float $commmission_amount
 * @property string $commmission_currency
 * @property int $commission_payee_id
 *
 * @package App\Models
 */
class Commmission extends Eloquent
{
	protected $table = 'commmission';
	protected $primaryKey = 'commmission_id';
	public $timestamps = false;

	protected $casts = [
		'commission_project_id' => 'int',
		'commmission_amount' => 'float',
		'commission_payee_id' => 'int'
	];

	protected $fillable = [
		'commission_project_id',
		'commmission_amount',
		'commmission_currency',
		'commission_payee_id'
	];
}

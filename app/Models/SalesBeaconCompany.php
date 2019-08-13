<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 17 Jul 2019 19:31:28 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class SalesBeaconCompany
 * 
 * @property int $sales_beacon_company_id
 * @property string $sales_beacon_company
 *
 * @package App\Models
 */
class SalesBeaconCompany extends Eloquent
{
	protected $table = 'sales_beacon_company';
	protected $primaryKey = 'sales_beacon_company_id';
	public $timestamps = false;

	protected $fillable = [
		'sales_beacon_company'
	];
}

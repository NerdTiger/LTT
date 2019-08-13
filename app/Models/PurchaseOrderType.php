<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 17 Jul 2019 19:31:28 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class PurchaseOrderType
 * 
 * @property int $purchase_order_type_id
 * @property string $purchase_order_type
 *
 * @package App\Models
 */
class PurchaseOrderType extends Eloquent
{
	protected $table = 'purchase_order_type';
	protected $primaryKey = 'purchase_order_type_id';
	public $timestamps = false;

	protected $fillable = [
		'purchase_order_type'
	];
}

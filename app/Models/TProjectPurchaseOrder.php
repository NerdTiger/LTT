<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 17 Jul 2019 19:31:28 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class TProjectPurchaseOrder
 * 
 * @property int $project_purchase_order_id
 * @property int $project_id
 * @property string $purchase_order
 * @property string $description
 * @property int $purchase_order_type_id
 * @property int $purchase_order_hours
 * @property float $purchase_order_value
 *
 * @package App\Models
 */
class TProjectPurchaseOrder extends Eloquent
{
	protected $table = 't_project_purchase_order';
	protected $primaryKey = 'project_purchase_order_id';
	public $timestamps = false;

	protected $casts = [
		'project_id' => 'int',
		'purchase_order_type_id' => 'int',
		'purchase_order_hours' => 'int',
		'purchase_order_value' => 'float'
	];

	protected $fillable = [
		'project_id',
		'purchase_order',
		'description',
		'purchase_order_type_id',
		'purchase_order_hours',
		'purchase_order_value'
	];
}

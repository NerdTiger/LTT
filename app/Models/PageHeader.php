<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 17 Jul 2019 19:31:27 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class PageHeader
 * 
 * @property int $page_header_id
 * @property string $page_header_name
 * @property string $page_header_value
 *
 * @package App\Models
 */
class PageHeader extends Eloquent
{
	protected $table = 'page_header';
	protected $primaryKey = 'page_header_id';
	public $timestamps = false;

	protected $fillable = [
		'page_header_name',
		'page_header_value'
	];
}

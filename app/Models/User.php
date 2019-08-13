<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 17 Jul 2019 19:31:28 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class User
 * 
 * @property int $user_id
 * @property string $user_name
 * @property string $user_lastname
 * @property int $user_position
 * @property string $user_cell
 * @property string $user_home
 * @property string $user_work
 * @property string $user_email
 * @property string $user_website
 * @property string $user_company
 * @property string $user_comments
 * @property string $user_picture
 * @property string $user_role
 * @property int $user_agency
 * @property int $user_agent
 * @property \Carbon\Carbon $user_registered
 * @property int $user_active
 * @property \Carbon\Carbon $user_updated
 * @property int $user_group
 * @property int $user_author
 * @property string $user_street
 * @property string $user_city
 * @property string $user_prov
 * @property string $user_zip
 * @property string $user_country
 * @property string $user_currency
 * @property string $user_username
 * @property float $user_rate
 * @property string $user_code
 * @property int $user_rank
 * @property \Carbon\Carbon $user_lastlogged
 * @property \Carbon\Carbon $user_lastloggedout
 * @property int $user_online
 * @property string $user_ip
 * @property string $user_lasturl
 * @property float $user_cost
 * @property \Carbon\Carbon $user_available_date
 * @property int $user_future_weekly_hrs
 * @property int $user_max_weekly_hrs
 * @property int $user_min_weekly_hrs
 * @property int $user_estimate_hrs
 * @property bool $user_available_now
 * @property float $user_tax
 * @property string $user_tax_number
 * @property float $user_tax_other
 * @property string $user_tax_other_number
 * @property string $user_billing_name
 * @property int $user_health_plan_opt_in
 * @property float $user_health_plan_deduction
 * @property int $user_rrsp_opt_in
 * @property float $user_rrsp_deduction
 * @property \Carbon\Carbon $user_last_hours_update
 * @property string $user_photo
 * @property string $user_bio
 * @property string $user_interests
 * @property string $user_title
 * @property string $user_preferred_email
 * @property string $user_preferred_phone
 * @property string $user_skill_1
 * @property string $user_skill_2
 * @property string $user_skill_3
 * @property string $user_skill_4
 * @property string $user_skill_5
 * @property int $user_max_hours_per_week
 * @property string $user_kudos_1
 * @property string $user_kudos_2
 * @property string $user_kudos_3
 * @property string $user_kudos_4
 * @property string $user_kudos_5
 * @property int $user_timezone_utc_offset
 * @property string $user_skill1
 * @property string $user_skill2
 * @property string $user_skill3
 * @property string $user_skill4
 * @property string $user_skill5
 * @property string $img
 * @property string $user_bios
 * @property string $user_preferredEmail
 * @property string $user_preferredPhone
 * @property string $user_kudo1
 * @property string $user_kudo2
 * @property string $user_kudo3
 * @property string $user_kudo4
 * @property string $user_kudo5
 * @property int $user_timezone
 * @property int $users_mdina_start_year
 * @property int $users_cisco_access
 * @property string $cisco_skill1
 * @property string $cisco_skill2
 * @property string $cisco_skill3
 * @property string $cisco_skill4
 * @property string $cisco_skill5
 * @property string $user_personalInterest
 * @property string $user_role1
 * @property string $user_role2
 * @property string $user_role3
 * @property string $user_role4
 * @property int $user_showdirectory	
 * @property string $user_typeofperson
 * @property int $diversity_id
 * @property int $src_employee_id
 * @property \Carbon\Carbon $lastupdate
 * @property int $user_resource_status_id
 * @property int $user_role_id
 *
 * @package App\Models
 */
class User extends Eloquent
{
	protected $table = 'users';
	protected $primaryKey = 'user_id';
	public $timestamps = false;

	protected $casts = [
		'user_position' => 'int',
		'user_agency' => 'int',
		'user_agent' => 'int',
		'user_active' => 'int',
		'user_group' => 'int',
		'user_author' => 'int',
		'user_rate' => 'float',
		'user_rank' => 'int',
		'user_online' => 'int',
		'user_cost' => 'float',
		'user_future_weekly_hrs' => 'int',
		'user_max_weekly_hrs' => 'int',
		'user_min_weekly_hrs' => 'int',
		'user_estimate_hrs' => 'int',
		'user_available_now' => 'bool',
		'user_tax' => 'float',
		'user_tax_other' => 'float',
		'user_health_plan_opt_in' => 'int',
		'user_health_plan_deduction' => 'float',
		'user_rrsp_opt_in' => 'int',
		'user_rrsp_deduction' => 'float',
		'user_max_hours_per_week' => 'int',
		'user_timezone_utc_offset' => 'int',
		'user_timezone' => 'int',
		'users_mdina_start_year' => 'int',
		'users_cisco_access' => 'int',
		'user_showdirectory' => 'int',
		'diversity_id' => 'int',
		'src_employee_id' => 'int',
		'user_resource_status_id' => 'int',
		'user_role_id' => 'int'
	];

	protected $dates = [
		'user_registered',
		'user_updated',
		'user_lastlogged',
		'user_lastloggedout',
		'user_available_date',
		'user_last_hours_update',
		'lastupdate'
	];

	protected $fillable = [
		'user_name',
		'user_lastname',
		'user_position',
		'user_cell',
		'user_home',
		'user_work',
		'user_email',
		'user_website',
		'user_company',
		'user_comments',
		'user_picture',
		'user_role',
		'user_agency',
		'user_agent',
		'user_registered',
		'user_active',
		'user_updated',
		'user_group',
		'user_author',
		'user_street',
		'user_city',
		'user_prov',
		'user_zip',
		'user_country',
		'user_currency',
		'user_username',
		'user_rate',
		'user_code',
		'user_rank',
		'user_lastlogged',
		'user_lastloggedout',
		'user_online',
		'user_ip',
		'user_lasturl',
		'user_cost',
		'user_available_date',
		'user_future_weekly_hrs',
		'user_max_weekly_hrs',
		'user_min_weekly_hrs',
		'user_estimate_hrs',
		'user_available_now',
		'user_tax',
		'user_tax_number',
		'user_tax_other',
		'user_tax_other_number',
		'user_billing_name',
		'user_health_plan_opt_in',
		'user_health_plan_deduction',
		'user_rrsp_opt_in',
		'user_rrsp_deduction',
		'user_last_hours_update',
		'user_photo',
		'user_bio',
		'user_interests',
		'user_title',
		'user_preferred_email',
		'user_preferred_phone',
		'user_skill_1',
		'user_skill_2',
		'user_skill_3',
		'user_skill_4',
		'user_skill_5',
		'user_max_hours_per_week',
		'user_kudos_1',
		'user_kudos_2',
		'user_kudos_3',
		'user_kudos_4',
		'user_kudos_5',
		'user_timezone_utc_offset',
		'user_skill1',
		'user_skill2',
		'user_skill3',
		'user_skill4',
		'user_skill5',
		'img',
		'user_bios',
		'user_preferredEmail',
		'user_preferredPhone',
		'user_kudo1',
		'user_kudo2',
		'user_kudo3',
		'user_kudo4',
		'user_kudo5',
		'user_timezone',
		'users_mdina_start_year',
		'users_cisco_access',
		'cisco_skill1',
		'cisco_skill2',
		'cisco_skill3',
		'cisco_skill4',
		'cisco_skill5',
		'user_personalInterest',
		'user_role1',
		'user_role2',
		'user_role3',
		'user_role4',
		'user_showdirectory',
		'user_typeofperson',
		'diversity_id',
		'src_employee_id',
		'lastupdate',
		'user_resource_status_id',
		'user_role_id'
	];
}

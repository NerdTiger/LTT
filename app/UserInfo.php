<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'user_name', 'user_lastname', 'user_position', 'user_cell', 'user_home', 'user_work', 'user_email', 'user_website', 'user_company', 'user_comments', 'user_picture', 'user_role', 'user_agency', 'user_agent', 'user_registered', 'user_active', 'user_updated', 'user_group', 'user_author', 'user_street', 'user_city', 'user_prov', 'user_zip', 'user_country', 'user_currency', 'user_username', 'user_rate', 'user_code', 'user_rank', 'user_lastlogged', 'user_lastloggedout', 'user_online', 'user_ip', 'user_lasturl', 'user_cost', 'user_available_date', 'user_future_weekly_hrs', 'user_max_weekly_hrs', 'user_min_weekly_hrs', 'user_estimate_hrs', 'user_available_now', 'user_tax', 'user_tax_number', 'user_tax_other', 'user_tax_other_number', 'user_billing_name', 'user_health_plan_opt_in', 'user_health_plan_deduction', 'user_rrsp_opt_in', 'user_rrsp_deduction', 'user_last_hours_update', 'user_photo', 'user_bio', 'user_interests', 'user_title', 'user_preferred_email', 'user_preferred_phone', 'user_skill_1', 'user_skill_2', 'user_skill_3', 'user_skill_4', 'user_skill_5', 'user_max_hours_per_week', 'user_kudos_1', 'user_kudos_2', 'user_kudos_3', 'user_kudos_4', 'user_kudos_5', 'user_timezone_utc_offset', 'user_skill1', 'user_skill2', 'user_skill3', 'user_skill4', 'user_skill5', 'img', 'user_bios', 'user_preferredEmail', 'user_preferredPhone', 'user_kudo1', 'user_kudo2', 'user_kudo3', 'user_kudo4', 'user_kudo5', 'user_timezone', 'users_mdina_start_year', 'users_cisco_access', 'cisco_skill1', 'cisco_skill2', 'cisco_skill3', 'cisco_skill4', 'cisco_skill5', 'user_personalInterest', 'user_role1', 'user_role2', 'user_role3', 'user_role4', 'user_showdirectory', 'user_typeofperson', 'diversity_id', 'src_employee_id', 'lastupdate', 'user_resource_status_id', 'user_role_id'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = ['user_available_now' => 'boolean'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['log_date', 'addedDate', 'lastupdate', 'project_created_date', 'project_start', 'project_end', 'authorizeddate', 'addedDate', 'addedDate', 'project_created_date', 'project_start', 'project_end', 'entry_date', 'entry_timestamp', 'setupdate', 'user_registered', 'user_updated', 'user_lastlogged', 'user_lastloggedout', 'user_available_date', 'user_last_hours_update', 'lastupdate'];

}
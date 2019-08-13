<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Models\Project;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(Project::class, function (Faker $faker) {
    $project_year = 2019;
    $project_submitter = 430;
    $project_priority = 0;
    $project_renewal = 1;
    $project_number = 15000;
    $project_location = 2;
    $project_functional_area_id = 3;
    $project_budget = 20000;
    $project_commission = 1000;
    $project_bonus = 3000;
    $project_cisco_rate_card = 0;
    $project_company = 2;
    $project_original_hours = 400;
    $project_practice_area_id = 4;
    $project_payee = 2;
    $project_status = 1;
    $project_type = 0;
    $project_active = 1;
    $project_remaining_hours = 400;

    return [
		'project_year' => $project_year,
		'project_submitter' => $project_submitter,
		'project_priority' => $project_priority,
		'project_renewal' => $project_renewal,
		'project_number' => $project_location,
		'project_location' => $project_location,
		'project_functional_area_id' => $project_functional_area_id,
		'project_budget' => $project_budget,
		'project_commission' => $project_commission,
		'project_bonus' => $project_bonus,
		'project_cisco_rate_card' => $project_cisco_rate_card,
		'project_company' => $project_company,
		'project_original_hours' => $project_original_hours,
		'project_practice_area_id' => $project_practice_area_id,
		'project_payee' => $project_payee,
		'project_status' => $project_status,
		'project_type' => $project_type,
		'project_active' => $project_active,
		'project_remaining_hours' => $project_remaining_hours
    ];
});

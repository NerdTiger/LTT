<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_types', function (Blueprint $table) {
            $table->bigIncrements('user_type_id');
            $table->string('user_type_name');
            $table->string('user_entrymodel');
            $table->string('user_entrymethod');
            $table->timestamps();
        });
        DB::table('user_types')->insert([[
            'user_type_name' => 'User',
            'user_entrymodel' => 'project',
            'user_entrymethod' => 'index',
        ],
        [
            'user_type_name' => 'Client Manager',
            'user_entrymodel' => 'project',
            'user_entrymethod' => 'index',
        ],[
            'user_type_name' => 'Contract Manager',
            'user_entrymodel' => 'project',
            'user_entrymethod' => 'index',
        ],[
            'user_type_name' => 'UserManagement',
            'user_entrymodel' => 'project',
            'user_entrymethod' => 'index',
        ],[
            'user_type_name' => 'TT Admin',
            'user_entrymodel' => 'project',
            'user_entrymethod' => 'index',
        ],[
            'user_type_name' => 'IT Admin',
            'user_entrymodel' => 'project',
            'user_entrymethod' => 'index',
        ]]       
    );

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_types');
    }
}

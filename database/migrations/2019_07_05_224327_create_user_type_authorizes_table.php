<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTypeAuthorizesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_type_authorizes', function (Blueprint $table) {
            $table->bigIncrements('user_type_auth_id');
            $table->bigInteger('user_id');
            $table->bigInteger('user_type_id');
            $table->timestamp('setupdate')->nullable();
            $table->timestamps();
        });
        DB::table('user_type_authorizes')->insert([
            'user_id' => 296,
            'user_type_id' => 128
        ]
    );
    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_type_authorizes');
    }
}

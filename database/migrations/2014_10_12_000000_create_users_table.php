<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('sex');
            $table->string('city');
            $table->string('birth')->nullable();
            $table->string('picture')->nullable();
            $table->integer('role')->default(0);
            $table->boolean('check')->default(0);
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
        DB::table('users')->insert(
            array(
                'firstname'=>'admin',
                'lastname'=>'user',
                'city'=> 'Cambodia,Phnom Penh',
                'sex'=> 'Male',
                'birth'=> null,
                'picture'=> 'user.png',
                'email' => 'sreyrotoun@gmail.com',
                'role' =>1,
                'password' => bcrypt('password'),
                'remember_token' => Str::random(10)
            ));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}

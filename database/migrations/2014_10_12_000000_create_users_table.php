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
                'city'=> 'Battambong',
                'sex'=> 'Male',
                'birth'=> null,
                'picture'=> 'user.png',
                'email' => 'admin@example.com',
                'role' =>1,
                'password' => bcrypt('password'),
                'remember_token' => Str::random(10)
            )
            );
            DB::table('users')->insert(
                array(
                    'firstname'=>'normal',
                    'lastname'=>'user',
                    'city'=>'Banteaymeanchey',
                    'sex'=> 'Female',
                    'birth'=> null,
                    'picture'=> 'user.png',
                    'email' => 'normal@example.com',
                    'role' => 0,
                    'password' => bcrypt('password'),
                    'remember_token' => Str::random(10)
                )
            ); 
    
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

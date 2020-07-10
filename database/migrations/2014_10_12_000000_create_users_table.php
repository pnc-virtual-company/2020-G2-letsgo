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
                'sex'=> 'male',
                'birth'=> null,
                'picture'=> 'https://image.freepik.com/free-vector/businessman-profile-cartoon_18591-58479.jpg',
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
                    'sex'=> 'female',
                    'birth'=> null,
                    'picture'=> 'https://cdn5.vectorstock.com/i/1000x1000/51/79/colorful-cartoon-human-female-happy-face-vector-13895179.jpg',
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

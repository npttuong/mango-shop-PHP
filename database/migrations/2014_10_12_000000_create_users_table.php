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
            // $table->id();
            // $table->string('name');
            // $table->string('email')->unique();
            // $table->timestamp('email_verified_at')->nullable();
            // $table->string('password');
            // $table->rememberToken();
            // $table->timestamps();

            // Code của Nguyễn Châu Phúc Huy
            $table->id();
            $table->string('username');
            $table->string('email')->unique();
            $table->string('phone_number');
            $table->string('city');
            $table->string('password');
            $table->string('role_name')->default('user');
            $table->string('avatar');
            $table->rememberToken();
            $table->timestamps();

            // Kết thúc
        });
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

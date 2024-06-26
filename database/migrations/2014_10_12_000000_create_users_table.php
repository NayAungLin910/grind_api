<?php

use App\ConstantValues\UserRolesConstantValues;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id()->nullable(false);
            $table->string('name')->unique()->nullable(false);
            $table->string('email')->unique()->nullable(false);
            $table->string('profileImage');
            $table->enum('role', UserRolesConstantValues::USER_ROLE_ENUM_ARRAY)->default(UserRolesConstantValues::USER_ROLE);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable(false);
            $table->rememberToken();
            $table->timestamps();
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
};

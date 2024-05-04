<?php

use App\ConstantValues\StatusConstantValues;
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
        Schema::create('completed_steps', function (Blueprint $table) {
            $table->id();
            $table->foreignId('step_id')->constrained(
                table: 'steps',
                column: 'id'
            );
            $table->foreignId('user_id')->constrained(
                table: 'users',
                column: 'id'
            );
            $table->enum('status', StatusConstantValues::STATUS_ENUM_ARRAY)->default(StatusConstantValues::STATUS_UNCOMPLETE)->nullable(false);
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
        Schema::dropIfExists('completed_steps');
    }
};

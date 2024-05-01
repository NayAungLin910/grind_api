<?php

use App\ConstantValues\StatusConstantValues;
use App\ConstantValues\StepConstantValues;
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
        Schema::create('steps', function (Blueprint $table) {
            $table->id()->nullable(false);
            $table->foreignId('sectionId')->constrained(
                table: 'sections',
                column: 'id',
            );
            $table->enum('type', StepConstantValues::STEP_ENUM_ARRAY)->default(StepConstantValues::READING_TYPE)->nullable(false);
            $table->text('title')->nullable(false);
            $table->text('video');
            $table->longText('description')->nullable(false);
            $table->longText('readingContext');
            $table->enum('status', StatusConstantValues::STATUS_ENUM_ARRAY)->default(StatusConstantValues::STATUS_ENUM_DEFAULT_VALUE);
            $table->timestamp('timeGiven');
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
        Schema::dropIfExists('steps');
    }
};

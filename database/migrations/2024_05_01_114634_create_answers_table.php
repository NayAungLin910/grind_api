<?php

use App\ConstantValues\AnswerConstantValues;
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
        Schema::create('answers', function (Blueprint $table) {
            $table->id()->nullable(false);
            $table->foreignId('questionId')->constrained(
                table: 'questions',
                column: 'id'
            );
            $table->longText('description')->nullable(false);
            $table->longText('explanation')->nullable();
            $table->boolean('status')->default(AnswerConstantValues::INCORRECT_ANSWER_TYPE);
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
        Schema::dropIfExists('answers');
    }
};

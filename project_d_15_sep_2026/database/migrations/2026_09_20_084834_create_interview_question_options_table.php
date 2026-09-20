<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('interview_question_options', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('question_id')
                ->index();

            $table->string('option_key', 10);

            $table->text('option_text');

            $table->unsignedTinyInteger('is_correct')
                ->default(0);

            $table->unsignedInteger('option_order')
                ->default(0);

            $table->timestamps();

            $table->index([
                'question_id',
                'option_order',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('interview_question_options');
    }
};

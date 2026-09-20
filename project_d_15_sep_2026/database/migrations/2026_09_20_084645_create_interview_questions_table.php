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
        Schema::create('interview_questions', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('interview_id')
                ->index();

            $table->enum('question_type', [
                'mcq',
                'paragraph',
                'media',
            ])->index();

            $table->text('question');

            /*
             * Paragraph:
             * short / long
             */
            $table->enum('answer_type', [
                'short',
                'long',
            ])->nullable();

            /*
             * Media:
             * audio / video / image
             */
            $table->enum('media_type', [
                'audio',
                'video',
                'image',
            ])->nullable();

            /*
             * Media question instructions.
             */
            $table->text('instructions')->nullable();

            /*
             * Maximum upload size in MB.
             */
            $table->unsignedInteger('max_file_size')
                ->nullable();

            /*
             * Number/order of question.
             */
            $table->unsignedInteger('question_order')
                ->default(0);

            /*
             * Marks assigned to question.
             */
            $table->decimal('marks', 8, 2)
                ->default(0);

            $table->unsignedTinyInteger('is_required')
                ->default(1);

            $table->unsignedTinyInteger('is_active')
                ->default(1);

            $table->unsignedBigInteger('created_by')
                ->nullable()
                ->index();

            $table->timestamps();

            $table->softDeletes();

            $table->index([
                'interview_id',
                'question_order',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('interview_questions');
    }
};

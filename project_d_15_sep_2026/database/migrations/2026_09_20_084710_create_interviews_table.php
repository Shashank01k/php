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
        Schema::create('interviews', function (Blueprint $table) {
            $table->id();

            $table->string('title', 255);

            $table->text('description')->nullable();

            $table->text('instructions')->nullable();

            $table->unsignedInteger('duration')
                ->nullable()
                ->comment('Duration in minutes');

            $table->enum('status', [
                'draft',
                'published',
                'closed',
            ])->default('draft');

            $table->unsignedTinyInteger('is_active')
                ->default(1)
                ->comment('1: active, 0: inactive');

            $table->unsignedBigInteger('created_by')
                ->nullable()
                ->index();

            $table->timestamps();

            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('interviews');
    }
};

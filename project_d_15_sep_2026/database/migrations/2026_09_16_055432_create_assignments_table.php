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
        Schema::create('assignments', function (Blueprint $table) {

            $table->id();

            $table->string('title', 255);

            $table->text('description')
                ->nullable();

            $table->string('technology', 100)
                ->nullable();

            // User who will receive/complete the assignment
            $table->unsignedBigInteger('assigned_to')
                ->nullable();

            // User who assigned the task
            $table->unsignedBigInteger('assigned_by')
                ->nullable();

            // User who created/added this assignment
            $table->unsignedBigInteger('created_by')
                ->nullable();

            // Assignment progress status
            $table->enum('status', [
                'pending',
                'in_progress',
                'completed',
                'cancelled',
            ])->default('pending');

            // Active / inactive
            $table->unsignedTinyInteger('is_active')
                ->default(1)
                ->comment('1 = Active, 0 = Inactive');

            $table->enum('priority', [
                'low',
                'medium',
                'high',
            ])->default('medium');

            $table->date('due_date')
                ->nullable();

            $table->dateTime('created_at')
                ->nullable();

            $table->dateTime('updated_at')
                ->nullable();

            // Indexes
            $table->index('assigned_to');
            $table->index('assigned_by');
            $table->index('created_by');
            $table->index('status');
            $table->index('is_active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assignments');
    }
};
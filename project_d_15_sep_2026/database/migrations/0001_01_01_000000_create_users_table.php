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
        Schema::create('users', function (Blueprint $table) {

            // Primary Key
            $table->id();

            // User Information
            $table->string('first_name', 100);
            $table->string('last_name', 100);
            $table->string('user_name', 50);
            $table->string('email', 100);

            // Authentication
            $table->string('password', 255);
            $table->string('token', 255)->nullable();

            // User Type
            $table->tinyInteger('user_type')
                ->nullable()
                ->comment('1 Super Admin, 2 Admin, 3 Sub Admin, 4 User');

            // Temporary Password
            $table->string('temp_password', 255)
                ->nullable()
                ->comment('Token for password reset or authentication');

            // Contact Information
            $table->string('phone', 20);

            // Other User Information
            $table->enum('gender', [
                'male',
                'female',
                'other',
            ])->default('other');

            $table->integer('state');

            $table->text('address');

            // Status
            $table->boolean('status')
                ->default(true)
                ->comment('1: active, 0: inactive');

            // Created By
            $table->integer('created_by')
                ->nullable()
                ->comment('ID of the admin/user who created this user');

            // Timestamps
            $table->timestamps();

            // Soft Delete
            $table->softDeletes();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
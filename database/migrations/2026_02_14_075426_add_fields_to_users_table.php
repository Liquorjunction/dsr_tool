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
        Schema::table('users', function (Blueprint $table) {
            $table->string('username')->unique()->after('name');
            $table->string('profile_picture')->nullable()->after('email');
            $table->string('phone_number')->unique()->after('email')->nullable();
            $table->string('date_of_birth')->after('email')->nullable();
            $table->string('remarks')->after('email')->nullable();
            $table->string('password_reset_token')->nullable()->after('password');
            $table->dateTime('password_reset_token_expires_at')->nullable()->after('password_reset_token');
            $table->dateTime('password_reset_token_requested_at')->nullable()->after('password_reset_token_expires_at');
            $table->string('email_verification_token')->nullable()->after('email_verified_at');
            $table->dateTime('email_verification_token_requested_at')->nullable()->after('email_verification_token');
            $table->dateTime('email_verification_token_expires_at')->nullable()->after('email_verified_at');
            $table->enum('status', ['active', 'inactive', 'suspended'])->default('active')->after('remarks');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('username');
            $table->dropColumn('profile_picture');
            $table->dropColumn('phone_number');
            $table->dropColumn('date_of_birth');
            $table->dropColumn('remarks');
            $table->dropColumn('password_reset_token');
            $table->dropColumn('password_reset_token_expires_at');
            $table->dropColumn('password_reset_token_requested_at');
            $table->dropColumn('email_verification_token');
            $table->dropColumn('email_verification_token_requested_at');
            $table->dropColumn('email_verification_token_expires_at');
            $table->dropColumn('status');
            $table->dropColumn('deleted_at');
        });
    }
};

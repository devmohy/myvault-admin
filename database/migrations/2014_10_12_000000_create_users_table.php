<?php

use App\Models\Business;
use App\Models\Role;
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
            $table->ulid('id')->primary();
            $table->string('email')->index();
            $table->string('first_name')->nullable()->index();
            $table->string('last_name')->nullable()->index();
            $table->string('phone_number')->nullable()->index();
            $table->foreignIdFor(Role::class)->index();
            $table->foreignIdFor(Business::class)->nullable()->index();
            $table->timestamp('email_verified_at')->nullable()->index();
            $table->string('password')->nullable()->index();
            $table->string('status')->index();
            $table->timestamp('last_active')->nullable()->index();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};

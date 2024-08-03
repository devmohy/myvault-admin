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
        Schema::create('user_invites', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->string('email')->index();
            $table->string('role_id')->index();
            $table->string('business_id')->nullable()->index();
            $table->string('status')->index();
            $table->timestamp('accepted_at')->nullable()->index();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_invites');
    }
};

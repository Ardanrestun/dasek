<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement('CREATE SCHEMA IF NOT EXISTS access');

        Schema::create('access.roles', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name')->unique();
            $table->timestamps();
        });


        Schema::create('access.users', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->foreignUuid('role_id');
            $table->string('remember_token')->nullable();
            $table->timestamps();
        });


        Schema::table('access.users', function (Blueprint $table) {
            $table->foreign('role_id')->references('id')->on('access.roles')->onDelete('cascade');
        });


        Schema::create('access.sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignUuid('user_id')->nullable()->index();
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
        
        Schema::dropIfExists('access.sessions');
        Schema::dropIfExists('access.users');
        Schema::dropIfExists('access.roles');
        DB::statement('DROP SCHEMA IF EXISTS access CASCADE');
    }
};

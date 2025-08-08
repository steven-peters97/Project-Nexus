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
            $table->string('id', 19)->primary();
            $table->string('guild_id', 19);
            $table->string('username', 32);
            $table->string('nickname', 32)->nullable();
            $table->string('email');
            $table->integer('combat_div_id')->nullable();
            $table->integer('ind_div_id')->nullable();
            $table->integer('is_banned')->default(0);
            $table->string('avatar')->nullable();
            $table->string('discord_token');
            $table->string('discord_refresh_token');
            $table->string('discord_expires_in');
            $table->timestamps();
        });
    }
};

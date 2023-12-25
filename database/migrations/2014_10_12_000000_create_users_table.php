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
            $table->id();
            $table->string('external_id')->unique();
            $table->string('email')->unique();
            $table->string('password');

            $table->unsignedBigInteger('referrer_id')->nullable();
            $table->string('ref_code')->unique();

            $table->boolean('active')->default(true);
            $table->boolean('blocked')->default(false);

            $table->rememberToken();
            $table->timestamps();

            $table->foreign('referrer_id')
                ->references('id')
                ->on('users')
                ->onDelete('set null');

            $table->index('external_id');
            $table->index('email');
            $table->index('referrer_id');
            $table->index('ref_code');
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

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
        Schema::create('partners', function (Blueprint $table) {
            $table->id();

            $table->text('name')->nullable();
            $table->text('email')->nullable();
            $table->text('pic')->nullable();
            

            $table->timestamps();
            $table->dateTime('deleted_at')->nullable();
            $table->integer('ordering')->nullable();
            $table->text('uuid')->nullable();
            $table->bigInteger('created_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('partners');
    }
};

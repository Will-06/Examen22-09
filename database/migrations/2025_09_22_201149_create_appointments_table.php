<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->text('notes')->nullable();
            $table->date('date')->nullable();
            $table->foreignId('business_id')->constrained()->OnDelete('cascade');
            $table->foreignId('user_id')->constrained()->OnDelete('cascade');
            $table->foreignId('service_id')->constrained()->OnDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('appointments');
    }
};

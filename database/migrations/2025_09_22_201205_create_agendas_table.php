<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('agendas', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('schedule')->nullable();
            $table->foreignId('business_id')->constrained()->OnDelete('cascade');
            $table->foreignId('user_id')->constrained()->OnDelete('cascade');
            $table->foreignId('service_id')->constrained()->OnDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('agendas');
    }
};
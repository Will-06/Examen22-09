<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('group')->nullable();
            $table->foreignId('status_id')->constrained()->OnDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('categories');
    }
};

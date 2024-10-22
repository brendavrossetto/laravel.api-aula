<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
 
    public function up(): void
    {
        Schema::create('people', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('address');
            $table->string('state');
            $table->string('country');
            $table->string('phone');
            $table->date('birthDate');
            $table->timestamps();
        });
    }

    
    public function down(): void
    {
        Schema::dropIfExists('people');
    }
};

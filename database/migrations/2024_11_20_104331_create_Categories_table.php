<?php
 
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
 
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('Categories', function (Blueprint $table) {
            $table->id();
            $table->string('category_name');
            $table->string('price');
            $table->string('category_code');
            $table->text('description');
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('Categories');
    }
};
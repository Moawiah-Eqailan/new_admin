<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');  // ربط بالـ users table
            $table->foreignId('item_id')->constrained()->onDelete('cascade');  // ربط بالـ items table
            $table->integer('quantity')->default(1);  // لتخزين كمية المنتج في السلة
            $table->timestamps();  // لتخزين تاريخ الإنشاء والتعديل
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');  // حذف الجدول في حالة التراجع عن الـ migration
    }
}

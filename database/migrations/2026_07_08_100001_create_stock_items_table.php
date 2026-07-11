<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('stock_items', function (Blueprint $table) {
            $table->id();
            $table->string('name');                       // ชื่อรายการ
            $table->string('unit', 30)->nullable();        // หน่วย เช่น ชิ้น, กล่อง, ขวด
            $table->decimal('price', 12, 2)->default(0);    // ราคาต่อหน่วย
            $table->decimal('stock_qty', 12, 2)->default(0); // จำนวนที่มีทั้งหมด
            $table->decimal('used_qty', 12, 2)->default(0);  // จำนวนที่ใช้ไปแล้ว
            $table->string('checked_by')->nullable();       // ผู้เช็คสต๊อกล่าสุด
            $table->date('checked_at')->nullable();         // วันที่เช็คล่าสุด
            $table->timestamps();

            // หมายเหตุ: "คงเหลือ" และ "% คงเหลือ" ไม่เก็บเป็นคอลัมน์
            // แต่คำนวณสดใน Model (stock_qty - used_qty) กันตัวเลขไม่ตรงกันภายหลัง
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('stock_items');
    }
};

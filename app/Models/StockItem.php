<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'unit',
        'price',
        'stock_qty',
        'used_qty',
        'checked_by',
        'checked_at',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'stock_qty' => 'decimal:2',
        'used_qty' => 'decimal:2',
        'checked_at' => 'date',
    ];

    // ให้ remaining_qty และ remaining_percent แนบมากับ array/json ของ model อัตโนมัติ
    protected $appends = ['remaining_qty', 'remaining_percent'];

    /**
     * จำนวนคงเหลือ = มีทั้งหมด - ใช้ไปแล้ว
     * คำนวณสดทุกครั้ง ไม่เก็บเป็นคอลัมน์แยก เพื่อไม่ให้ตัวเลขเพี้ยนจากการแก้ไขไม่ตรงกัน
     */
    public function getRemainingQtyAttribute(): float
    {
        return (float) $this->stock_qty - (float) $this->used_qty;
    }

    /**
     * % คงเหลือเทียบกับสต๊อกทั้งหมด ใช้แสดงแถบสถานะ/สีแจ้งเตือนในหน้ารายการ
     */
    public function getRemainingPercentAttribute(): float
    {
        if ((float) $this->stock_qty <= 0) {
            return 0;
        }

        return round(($this->remaining_qty / (float) $this->stock_qty) * 100, 1);
    }
}

<?php

namespace Database\Seeders;

use App\Models\StockItem;
use Illuminate\Database\Seeder;

class StockItemSeeder extends Seeder
{
    /**
     * นำเข้ารายการจริงจากไฟล์แผนจัดซื้อจัดหาเวชภัณฑ์ที่มิใช่ยา
     * หน่วยจ่ายกลาง (CSSD) ประจำปี 2569 — รวม 91 รายการ
     * (รวมรายการในหมวด "ขอจัดซื้อเพิ่มเติมเนื่องจากหมุนเวียนใช้ไม่เพียงพอ" ด้วย)
     *
     * การแมปข้อมูล:
     *   - price     = ราคาต่อหน่วยจากไฟล์
     *   - stock_qty = จำนวนที่ต้องการ/จำนวนที่ขอจัดซื้อ (ใช้เป็นจำนวนตั้งต้นในคลัง)
     *   - used_qty  = 0 ทุกรายการ (ยังไม่มีข้อมูลการใช้จริง เริ่มนับจากศูนย์)
     *   - checked_by / checked_at = ยังไม่มีข้อมูล ปล่อยว่างไว้ให้ไปกรอกตอนเช็คสต๊อกจริงครั้งแรก
     */
    public function run(): void
    {
        $items = [
            ['name' => 'ก้อส 2x2(10 ชิ้น)', 'unit' => 'ห่อ', 'price' => 6.00, 'stock_qty' => 20000.00],
            ['name' => 'ก้อส 3x3(5 ชิ้น)', 'unit' => 'ห่อ', 'price' => 3.73, 'stock_qty' => 40000.00],
            ['name' => 'ก้อส 3x3(10 ชิ้น)', 'unit' => 'ห่อ', 'price' => 6.70, 'stock_qty' => 32000.00],
            ['name' => 'ก้อส 4x4(10 ชิ้น)', 'unit' => 'ห่อ', 'price' => 10.00, 'stock_qty' => 12000.00],
            ['name' => 'Top ก้อส 3x6', 'unit' => 'ห่อ', 'price' => 8.00, 'stock_qty' => 15000.00],
            ['name' => 'Top ก้อส 8x12', 'unit' => 'ห่อ', 'price' => 15.00, 'stock_qty' => 13000.00],
            ['name' => 'Top ก้อส 3x6 (non sterile)', 'unit' => 'ชิ้น', 'price' => 3.50, 'stock_qty' => 3200.00],
            ['name' => 'สำลีเล็ก 5 ก้อน', 'unit' => 'ห่อ', 'price' => 1.70, 'stock_qty' => 22500.00],
            ['name' => 'สำลีเล็ก 10 ก้อน', 'unit' => 'ห่อ', 'price' => 2.50, 'stock_qty' => 30000.00],
            ['name' => 'สำลีเล็ก 20 ก้อน', 'unit' => 'ห่อ', 'price' => 5.00, 'stock_qty' => 25000.00],
            ['name' => 'สำลีเล็ก 30 ก้อน', 'unit' => 'ห่อ', 'price' => 6.30, 'stock_qty' => 17000.00],
            ['name' => 'ซองเวชภัณฑ์แบบเรียบ 2.2 นิ้ว', 'unit' => 'ม้วน', 'price' => 325.00, 'stock_qty' => 32.00],
            ['name' => 'ซองเวชภัณฑ์แบบเรียบ 3 นิ้ว', 'unit' => 'ม้วน', 'price' => 420.00, 'stock_qty' => 50.00],
            ['name' => 'ซองเวชภัณฑ์แบบเรียบ 4 นิ้ว', 'unit' => 'ม้วน', 'price' => 555.00, 'stock_qty' => 35.00],
            ['name' => 'ซองเวชภัณฑ์แบบเรียบ 5 นิ้ว', 'unit' => 'ม้วน', 'price' => 675.00, 'stock_qty' => 16.00],
            ['name' => 'ซองเวชภัณฑ์แบบเรียบ 6 นิ้ว', 'unit' => 'ม้วน', 'price' => 825.00, 'stock_qty' => 30.00],
            ['name' => 'ซองเวชภัณฑ์แบบเรียบ 8 นิ้ว', 'unit' => 'ม้วน', 'price' => 1100.00, 'stock_qty' => 20.00],
            ['name' => 'ซองเวชภัณฑ์แบบเรียบ 10 นิ้ว', 'unit' => 'ม้วน', 'price' => 1800.00, 'stock_qty' => 6.00],
            ['name' => 'ซองเวชภัณฑ์แบบเรียบ 12 นิ้ว', 'unit' => 'ม้วน', 'price' => 2100.00, 'stock_qty' => 4.00],
            ['name' => 'ซองเวชภัณฑ์แบบขยาย 3 นิ้ว', 'unit' => 'ม้วน', 'price' => 685.00, 'stock_qty' => 4.00],
            ['name' => 'ซองเวชภัณฑ์แบบขยาย 4 นิ้ว', 'unit' => 'ม้วน', 'price' => 745.00, 'stock_qty' => 10.00],
            ['name' => 'ซองเวชภัณฑ์แบบขยาย 6 นิ้ว', 'unit' => 'ม้วน', 'price' => 885.00, 'stock_qty' => 20.00],
            ['name' => 'ซองเวชภัณฑ์แบบขยาย 8 นิ้ว', 'unit' => 'ม้วน', 'price' => 1035.00, 'stock_qty' => 20.00],
            ['name' => 'ซองเวชภัณฑ์แบบขยาย 10 นิ้ว', 'unit' => 'ม้วน', 'price' => 1185.00, 'stock_qty' => 20.00],
            ['name' => 'ซองเวชภัณฑ์แบบขยาย 12 นิ้ว', 'unit' => 'ม้วน', 'price' => 1315.00, 'stock_qty' => 10.00],
            ['name' => 'sterigage', 'unit' => 'กล่อง', 'price' => 3959.00, 'stock_qty' => 35.00],
            ['name' => 'comply EO', 'unit' => 'ห่อ', 'price' => 450.00, 'stock_qty' => 250.00],
            ['name' => 'comply steam', 'unit' => 'ห่อ', 'price' => 325.00, 'stock_qty' => 250.00],
            ['name' => 'comply plasma', 'unit' => 'ห่อ', 'price' => 1000.00, 'stock_qty' => 20.00],
            ['name' => 'attest EO', 'unit' => 'กล่อง', 'price' => 3250.00, 'stock_qty' => 25.00],
            ['name' => 'attest Steam ชนิด 3 ชั่วโมง', 'unit' => 'กล่อง', 'price' => 2970.00, 'stock_qty' => 10.00],
            ['name' => 'attest Steam ชนิด 1 ชั่วโมง', 'unit' => 'กล่อง', 'price' => 280.00, 'stock_qty' => 550.00],
            ['name' => 'attest Plasma', 'unit' => 'กล่อง', 'price' => 9000.00, 'stock_qty' => 7.00],
            ['name' => 'น้ำยาล้างเครื่องมือด้วยมือ', 'unit' => 'แกลลอน', 'price' => 2400.00, 'stock_qty' => 70.00],
            ['name' => 'pose clean', 'unit' => 'แกลลอน', 'price' => 960.00, 'stock_qty' => 50.00],
            ['name' => 'น้ำยากัดสนิม SR1,2', 'unit' => 'กล่อง', 'price' => 3000.00, 'stock_qty' => 5.00],
            ['name' => 'surgistain', 'unit' => 'แกลลอน', 'price' => 2675.00, 'stock_qty' => 7.00],
            ['name' => 'Prewash', 'unit' => 'ขวด', 'price' => 850.00, 'stock_qty' => 72.00],
            ['name' => 'SR3', 'unit' => 'ขวด', 'price' => 3500.00, 'stock_qty' => 4.00],
            ['name' => 'ไม้ Papsmear', 'unit' => 'กล่อง', 'price' => 180.00, 'stock_qty' => 15.00],
            ['name' => 'ไม้กดลิ้น', 'unit' => 'กล่อง', 'price' => 150.00, 'stock_qty' => 80.00],
            ['name' => 'แปรงล้างเครื่องมือ', 'unit' => 'อัน', 'price' => 300.00, 'stock_qty' => 70.00],
            ['name' => 'แปรงล้างท่อsuction(H-60-FL-025)', 'unit' => 'อัน', 'price' => 350.00, 'stock_qty' => 4.00],
            ['name' => 'แปรงล้างสายคอลลูเกต(1แพค:2อัน)', 'unit' => 'แพค', 'price' => 1770.00, 'stock_qty' => 2.00],
            ['name' => 'แปรงล้างสายsuctionยาว(TH-10-Fx-100)', 'unit' => 'อัน', 'price' => 1550.00, 'stock_qty' => 2.00],
            ['name' => 'แปรงล้างsyring irrigate', 'unit' => 'อัน', 'price' => 350.00, 'stock_qty' => 6.00],
            ['name' => 'Bowie dick pask test', 'unit' => 'ชิ้น', 'price' => 120.00, 'stock_qty' => 750.00],
            ['name' => 'วาสลีนก้อส', 'unit' => 'ห่อ', 'price' => 45.00, 'stock_qty' => 600.00],
            ['name' => 'วาสลีน โรลก้อส', 'unit' => 'ห่อ', 'price' => 110.00, 'stock_qty' => 60.00],
            ['name' => 'กาวน์ล้างของ', 'unit' => 'ตัว', 'price' => 10.00, 'stock_qty' => 2400.00],
            ['name' => 'หมวกตัวหนอน', 'unit' => 'ชิ้น', 'price' => 1.30, 'stock_qty' => 2200.00],
            ['name' => 'TT.tube ขนาดต่างๆ(5min-13min)', 'unit' => 'อัน', 'price' => 850.00, 'stock_qty' => 160.00],
            ['name' => 'Guide wire (ขนาด S,M,L)', 'unit' => 'อัน', 'price' => 135.00, 'stock_qty' => 200.00],
            ['name' => 'กระบอกน้ำให้ความชื้น(Jar O2)', 'unit' => 'กป', 'price' => 185.00, 'stock_qty' => 80.00],
            ['name' => 'หลอดแก๊สEOขนาด 100 กรัม', 'unit' => 'หลอด', 'price' => 290.00, 'stock_qty' => 120.00],
            ['name' => 'หลอดแก๊สEOขนาด 170 กรัม', 'unit' => 'หลอด', 'price' => 430.00, 'stock_qty' => 160.00],
            ['name' => 'หลอดแก๊สEOขนาด 340 กรัม', 'unit' => 'หลอด', 'price' => 850.00, 'stock_qty' => 170.00],
            ['name' => 'หลอดแก๊ส plasma', 'unit' => 'หลอด', 'price' => 750.00, 'stock_qty' => 240.00],
            ['name' => 'ลูกสูบยางแดงเบอร์7', 'unit' => 'ลูก', 'price' => 98.00, 'stock_qty' => 48.00],
            ['name' => 'กหระดาษกราฟ 09', 'unit' => 'ม้วน', 'price' => 101.60, 'stock_qty' => 50.00],
            ['name' => 'กระดาษกราฟ 11+แก๊ส+พลาสมา', 'unit' => 'ม้วน', 'price' => 161.00, 'stock_qty' => 50.00],
            ['name' => 'Ambu bag ผู้ใหญ่ (ซิลิโคน)', 'unit' => 'อัน', 'price' => 3000.00, 'stock_qty' => 10.00],
            ['name' => 'Resurvior (ซิลิโคน)', 'unit' => 'อัน', 'price' => 1000.00, 'stock_qty' => 10.00],
            ['name' => 'สายหัวเหมือน', 'unit' => 'เส้น', 'price' => 22.00, 'stock_qty' => 50.00],
            ['name' => 'canular เด็กโต', 'unit' => 'เส้น', 'price' => 19.00, 'stock_qty' => 300.00],
            ['name' => 'air way ขนาดต่างๆ', 'unit' => 'อัน', 'price' => 15.00, 'stock_qty' => 500.00],
            ['name' => 'collar mask ผู้ใหญ่', 'unit' => 'อัน', 'price' => 85.00, 'stock_qty' => 60.00],
            ['name' => 'น้ำยาล้างทำความสะอาดเครื่องมือแพทย์', 'unit' => 'แกลลอน', 'price' => 3600.00, 'stock_qty' => 20.00],
            ['name' => 'collar mask เด็ก', 'unit' => 'อัน', 'price' => 85.00, 'stock_qty' => 10.00],
            ['name' => 'ซิลิโคนtube(1ม้วน:15เมตร)', 'unit' => 'ม้วน', 'price' => 1790.00, 'stock_qty' => 1.00],
            ['name' => 'เครื่องวัดน้ำไขสันหลัง', 'unit' => 'อัน', 'price' => 3000.00, 'stock_qty' => 3.00],
            ['name' => 'หม้อสวนอุจจาระ', 'unit' => 'หม้อ', 'price' => 510.00, 'stock_qty' => 3.00],
            ['name' => 'หัวสวนอุจจาระ+หัวDouch', 'unit' => 'ชุด', 'price' => 190.00, 'stock_qty' => 40.00],
            ['name' => 'ถาดทำแผล', 'unit' => 'ใบ', 'price' => 350.00, 'stock_qty' => 30.00],
            ['name' => 'Forceps มีเขี้ยว / 14 ซม.', 'unit' => 'อัน', 'price' => 345.00, 'stock_qty' => 60.00],
            ['name' => 'Forceps ไม่มีเขี้ยว / 14 ซม.', 'unit' => 'อัน', 'price' => 355.00, 'stock_qty' => 80.00],
            ['name' => 'Forceps มีเขี้ยว / 16 ซม.', 'unit' => 'อัน', 'price' => 425.00, 'stock_qty' => 50.00],
            ['name' => 'กรรไกรตัดฝีเย็บ', 'unit' => 'อัน', 'price' => 750.00, 'stock_qty' => 5.00],
            ['name' => 'กรรไกรตัดเนื้อ 14ซม', 'unit' => 'อัน', 'price' => 600.00, 'stock_qty' => 10.00],
            ['name' => 'probe', 'unit' => 'อัน', 'price' => 200.00, 'stock_qty' => 5.00],
            ['name' => 'กรรไกรตัดไหม 14 ซม.', 'unit' => 'อัน', 'price' => 580.00, 'stock_qty' => 10.00],
            ['name' => 'กรรไกรตัดก้อส (14 ซม)', 'unit' => 'อัน', 'price' => 500.00, 'stock_qty' => 6.00],
            ['name' => 'สติกเกอร์สีเขียว(1ม้วน:1000ดวง)', 'unit' => 'ม้วน', 'price' => 1100.00, 'stock_qty' => 200.00],
            ['name' => 'สติกเกอร์สีเหลือง(1ม้วน:500ดวง)', 'unit' => 'ม้วน', 'price' => 700.00, 'stock_qty' => 235.00],
            ['name' => 'สติกเกอร์สีฟ้า(ม้วนละ2000ดวง)', 'unit' => 'ม้วน', 'price' => 1200.00, 'stock_qty' => 100.00],
            ['name' => 'ชุดตรวจเอทีพี', 'unit' => 'หลอด', 'price' => 200.00, 'stock_qty' => 500.00],
            ['name' => 'alcohol pad(1กล่องมี100ชิ้น)', 'unit' => 'กล่อง', 'price' => 98.00, 'stock_qty' => 2300.00],
            ['name' => 'tissue forceps 1.2 teeth ยาว 25 ซม(10 นิ้ว)', 'unit' => 'อัน', 'price' => 670.00, 'stock_qty' => 20.00],
            ['name' => 'needle holder ความยาว 16 ซม.', 'unit' => 'อัน', 'price' => 670.00, 'stock_qty' => 6.00],
            ['name' => 'sono check', 'unit' => 'หลอด', 'price' => 120.00, 'stock_qty' => 60.00],
            ['name' => 'Non-tooth forceps ยาว 16 ซม', 'unit' => 'อัน', 'price' => 400.00, 'stock_qty' => 30.00],
        ];

        foreach ($items as $item) {
            StockItem::updateOrCreate(
                ['name' => $item['name']],
                $item
            );
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductoProveedorSeeder extends Seeder
{
    public function run()
    {
        DB::table('producto_proveedor')->insert([
            ['id'=>1,'producto_id'=>1,'proveedor_id'=>4,'precio_compra'=>55.00,'codigo_proveedor'=>'PROV-ACE-001','principal'=>1],
            ['id'=>2,'producto_id'=>2,'proveedor_id'=>3,'precio_compra'=>18.00,'codigo_proveedor'=>'PROV-FIL-002','principal'=>1],
            ['id'=>3,'producto_id'=>3,'proveedor_id'=>5,'precio_compra'=>45.00,'codigo_proveedor'=>'PROV-FRE-003','principal'=>1],
            ['id'=>4,'producto_id'=>4,'proveedor_id'=>8,'precio_compra'=>35.00,'codigo_proveedor'=>'PROV-BUJ-004','principal'=>1],
            ['id'=>5,'producto_id'=>5,'proveedor_id'=>6,'precio_compra'=>80.00,'codigo_proveedor'=>'PROV-CAD-005','principal'=>1],
            ['id'=>6,'producto_id'=>6,'proveedor_id'=>6,'precio_compra'=>65.00,'codigo_proveedor'=>'PROV-COR-006','principal'=>1],
            ['id'=>7,'producto_id'=>7,'proveedor_id'=>7,'precio_compra'=>180.00,'codigo_proveedor'=>'PROV-LLA-007','principal'=>1],
            ['id'=>8,'producto_id'=>8,'proveedor_id'=>2,'precio_compra'=>170.00,'codigo_proveedor'=>'PROV-AMO-008','principal'=>1],
            ['id'=>9,'producto_id'=>9,'proveedor_id'=>8,'precio_compra'=>90.00,'codigo_proveedor'=>'PROV-LED-009','principal'=>1],
            ['id'=>10,'producto_id'=>10,'proveedor_id'=>10,'precio_compra'=>260.00,'codigo_proveedor'=>'PROV-CAS-010','principal'=>1],
        ]);
    }
}
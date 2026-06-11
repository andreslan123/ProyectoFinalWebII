<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PromocionSeeder extends Seeder
{
    public function run()
    {
        DB::table('promociones')->insert([
            ['id'=>1,'estado_id'=>23,'titulo'=>'Descuento en aceites Honda','descripcion'=>'Promoción especial en aceites para mantenimiento preventivo.','valor_descuento'=>10.00,'fecha_inicio'=>'2026-06-01','fecha_fin'=>'2026-06-30'],
            ['id'=>2,'estado_id'=>23,'titulo'=>'Frenos seguros','descripcion'=>'Descuento para pastillas de freno seleccionadas.','valor_descuento'=>15.00,'fecha_inicio'=>'2026-06-01','fecha_fin'=>'2026-06-30'],
            ['id'=>3,'estado_id'=>23,'titulo'=>'Rebaja en casco racing','descripcion'=>'Precio especial para cascos integrales.','valor_descuento'=>40.00,'fecha_inicio'=>'2026-06-01','fecha_fin'=>'2026-06-25'],
            ['id'=>4,'estado_id'=>23,'titulo'=>'Promo transmision','descripcion'=>'Descuento en cadena reforzada.','valor_descuento'=>12.00,'fecha_inicio'=>'2026-06-05','fecha_fin'=>'2026-07-05'],
            ['id'=>5,'estado_id'=>24,'titulo'=>'Oferta futura en llantas','descripcion'=>'Promoción programada para llantas tubeless.','valor_descuento'=>8.00,'fecha_inicio'=>'2026-07-01','fecha_fin'=>'2026-07-31'],
            ['id'=>6,'estado_id'=>23,'titulo'=>'Faro LED en oferta','descripcion'=>'Descuento directo para faro LED auxiliar.','valor_descuento'=>20.00,'fecha_inicio'=>'2026-06-01','fecha_fin'=>'2026-06-20'],
            ['id'=>7,'estado_id'=>23,'titulo'=>'Bujias NGK','descripcion'=>'Descuento por mantenimiento de encendido.','valor_descuento'=>10.00,'fecha_inicio'=>'2026-06-01','fecha_fin'=>'2026-06-30'],
            ['id'=>8,'estado_id'=>25,'titulo'=>'Campaña pasada de filtros','descripcion'=>'Promoción vencida de filtros de aceite.','valor_descuento'=>5.00,'fecha_inicio'=>'2026-05-01','fecha_fin'=>'2026-05-31'],
            ['id'=>9,'estado_id'=>23,'titulo'=>'Amortiguador reforzado','descripcion'=>'Rebaja en suspension trasera.','valor_descuento'=>30.00,'fecha_inicio'=>'2026-06-02','fecha_fin'=>'2026-06-28'],
            ['id'=>10,'estado_id'=>23,'titulo'=>'Corona Bajaj','descripcion'=>'Descuento para corona de transmision.','valor_descuento'=>10.00,'fecha_inicio'=>'2026-06-03','fecha_fin'=>'2026-06-30'],
        ]);
    }
}
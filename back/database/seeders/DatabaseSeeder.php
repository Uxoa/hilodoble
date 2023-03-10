<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Item;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Item::factory()->create([
            'itemName'=> 'Riñonera',
            'category'=>'bolsos',
            'description'=>'Riñonera realizada con lona reciclada. Bolsillo posterior, cremallera y correa ajustable.',
            'image'=>'https://hilodoble.com/wp-content/uploads/2021/06/rinonera_colorful_1-scaled.jpg',
            'stockQuantity'=>'4',
            'purchaseQuantity'=>'1',
            'price'=>'15']);

        Item::factory()->create([
            'itemName'=> 'Monedero',
            'category'=>'bolsos',
            'description'=>'Monedero realizado con cámara de bicicleta. Cierre de cremallera y bolsillo frontal también de cremallera. Un monedero que te durará toda la vida',
            'image'=>'https://hilodoble.com/wp-content/uploads/2021/06/monedorogoma_1-300x300.jpg',
            'stockQuantity'=>'5',
            'purchaseQuantity'=>'1',
            'price'=>'13']);

        Item::factory()->create([
            'itemName'=> 'Maletín',
            'category'=>'bolsos',
            'description'=>'Funda para portátil realizada con lonas publicitarias recicladas. Dos asas para mano. Forrado de foam. Proteja su dispositivo con esta resistente y original funda.',
            'image'=>'https://hilodoble.com/wp-content/uploads/2021/06/IMG_20210520_130855-300x300.jpg',
            'stockQuantity'=>'3',
            'purchaseQuantity'=>'1',
            'price'=>'20']);

        Item::factory()->create([
            'itemName'=> 'Funda tablet/ipad',
            'category'=>'bolsos',
            'description'=>'Protege tu table o ipad con esta funda realizada con lona reciclada.',
            'image'=>'https://hilodoble.com/wp-content/uploads/2021/06/fundaipad_fuego_1-300x300.jpg',
            'stockQuantity'=>'6',
            'purchaseQuantity'=>'1',
            'price'=>'15']);

        Item::factory()->create([
            'itemName'=> 'Carpeta de gomas',
            'category'=>'papelería',
            'description'=>'Carpeta de Hilo Doble con cubiertas duras y resistentes y con un bolsillo interior para tu documentación o tarjetas de visita.',
            'image'=>'https://hilodoble.com/wp-content/uploads/2021/06/carpetagomas_maps_1-300x300.jpg',
            'stockQuantity'=>'7',
            'purchaseQuantity'=>'1',
            'price'=>'13']);

        Item::factory()->create([
            'itemName'=> 'Bolsa de viaje',
            'category'=>'bolsos',
            'description'=>'Bolsa de viaje de lona reciclada. Asa ajustable e interior forrado de foam. Dos bolsillos interiores. Gran capacidad y muy resistente.',
            'image'=>'https://hilodoble.com/wp-content/uploads/2021/06/bolsaviaje_museum_3-300x300.jpg',
            'stockQuantity'=>'8',
            'purchaseQuantity'=>'1',
            'price'=>'40']);
    
        Item::factory(3)->create();


        User::factory()->create();

        User::factory()->create(['name' => 'admin', 'email' => 'admin@admin.com', 'isAdmin' => true]);

        User::factory()->create(['name' => 'user1', 'email' => 'user1@user1.com', 'isAdmin' => false]);

    
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Cliente; #<-- importante

class ClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        /*
        Cliente::create([
            'nombre' => 'Comercial El Progreso S.A.',
            'nit' => '900123456-7',
            'email' => 'contacto@elprogreso.com',
            'telefono' => '3001234567',
            'direccion' => 'Calle 10 #5-20, Bogotá',
        ]);

        Cliente::create([
            'nombre' => 'Distribuidora Andina Ltda.',
            'nit' => '900987654-3',
            'email' => 'ventas@andina.com',
            'telefono' => '3109876543',
            'direccion' => 'Carrera 45 #12-30, Medellín',
        ]);

        Cliente::create([
            'nombre' => 'Tecnología y Suministros S.A.S.',
            'nit' => '901234567-8',
            'email' => 'info@tecnosuministros.com',
            'telefono' => '3201112233',
            'direccion' => 'Av. Circunvalar #8-15, Cali',
        ]);
        */


        $clientes = [
            ['nombre' => 'Comercial El Progreso S.A.', 'nit' => '900123456-7', 'email' => 'contacto@elprogreso.com', 'telefono' => '3001234567', 'direccion' => 'Bogotá'],
            ['nombre' => 'Distribuidora Andina Ltda.', 'nit' => '900987654-3', 'email' => 'ventas@andina.com', 'telefono' => '3109876543', 'direccion' => 'Medellín'],
            ['nombre' => 'Tecnología y Suministros S.A.S.', 'nit' => '901234567-8', 'email' => 'info@tecno.com', 'telefono' => '3201112233', 'direccion' => 'Cali'],
        ];

        foreach ($clientes as $cliente) {
            Cliente::create($cliente);
        }

    }
}

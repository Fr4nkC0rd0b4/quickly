<?php

use App\Status;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        Status::create([
            'name' => 'Nuevo'
        ]);
        Status::create([
            'name' => 'Aceptado'
        ]);
        Status::create([
            'name' => 'Completado'
        ]);
        Status::create([
            'name' => 'Cancelado'
        ]);
    }
}

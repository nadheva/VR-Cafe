<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Resepsionis;

class ResepsionisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Resepsionis::create([
            'id' => '1',
            'nama' => 'Resepsionis 1',
            'foto' => 'storage/resepsionis/sample.jpg',
            'email' => 'respsionis1@mail.com',
            'no_telp' => '08573500000'
        ]);

        Resepsionis::create([
            'id' => '2',
            'nama' => 'Resepsionis 2',
            'foto' => 'storage/resepsionis/sample.jpg',
            'email' => 'respsionis2@mail.com',
            'no_telp' => '08573500000'
        ]);

        Resepsionis::create([
            'id' => '3',
            'nama' => 'Resepsionis 3',
            'foto' => 'storage/resepsionis/sample.jpg',
            'email' => 'respsionis3@mail.com',
            'no_telp' => '08573500000'
        ]);

        Resepsionis::create([
            'id' => '4',
            'nama' => 'Resepsionis 4',
            'foto' => 'storage/resepsionis/sample.jpg',
            'email' => 'respsionis4@mail.com',
            'no_telp' => '08573500000'
        ]);
    }
}

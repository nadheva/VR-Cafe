<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Perangkat;

class PerangkatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Perangkat::create([
            'kode_perangkat' => '2001',
            'nama' => 'Oculus 1',
            'slug' => 'Oculus 1',
            'gambar' => 'storage/perangkat/sample.jpg',
            'gambar_detail' => '["storage\/perangkat\/gambar_detail\/sample.jpg"]',
            'stok' => '10',
            'harga' => '20000',
            'deskripsi' => 'Barang bagus'
        ]);

        Perangkat::create([
            'kode_perangkat' => '2002',
            'nama' => 'Oculus 2',
            'slug' => 'Oculus 2',
            'gambar' => 'storage/perangkat/sample.jpg',
            'gambar_detail' => '["storage\/perangkat\/gambar_detail\/sample.jpg"]',
            'stok' => '10',
            'harga' => '20000',
            'deskripsi' => 'Barang bagus'
        ]);

        Perangkat::create([
            'kode_perangkat' => '2003',
            'nama' => 'Oculus 3',
            'slug' => 'Oculus 3',
            'gambar' => 'storage/perangkat/sample.jpg',
            'gambar_detail' => '["storage\/perangkat\/gambar_detail\/sample.jpg"]',
            'stok' => '10',
            'harga' => '20000',
            'deskripsi' => 'Barang bagus'
        ]);
    }
}

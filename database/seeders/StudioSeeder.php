<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Studio;

class StudioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Studio::create([
            'kode_studio' => '3001',
            'nama' => 'Studio 1',
            'slug' => 'Studio-1',
            'gambar' => 'storage/studio/sample-1.jpg',
            'gambar_detail' => '["storage\/studio\/gambar_detail\/detail-1.jpg"]',
            'banner' => 'storage/studio/banner/banner-1.jpg',
            'harga' => '20000',
            'jumlah' => '4',
            'ukuran' => '20',
            'monitor' => '3',
            'perangkat_vr' => '4',
            'pc_desktop' => '5',
            'deskripsi' => 'Studio bagus',
            'resepsionis_id' => '1'
        ]);

        Studio::create([
            'kode_studio' => '3002',
            'nama' => 'Studio 2',
            'slug' => 'Studio-2',
            'gambar' => 'storage/studio/sample-2.jpg',
            'gambar_detail' => '["storage\/studio\/gambar_detail\/detail-2.jpg"]',
            'banner' => 'storage/studio/banner/banner-2.jpg',
            'harga' => '20000',
            'jumlah' => '4',
            'ukuran' => '20',
            'monitor' => '3',
            'perangkat_vr' => '4',
            'pc_desktop' => '5',
            'deskripsi' => 'Studio bagus',
            'resepsionis_id' => '2'
        ]);

        Studio::create([
            'kode_studio' => '3003',
            'nama' => 'Studio 3',
            'slug' => 'Studio-3',
            'gambar' => 'storage/studio/sample-3.jpg',
            'gambar_detail' => '["storage\/studio\/gambar_detail\/detail-3.jpg"]',
            'banner' => 'storage/studio/banner/banner-3.jpg',
            'harga' => '20000',
            'jumlah' => '4',
            'ukuran' => '20',
            'monitor' => '3',
            'perangkat_vr' => '4',
            'pc_desktop' => '5',
            'deskripsi' => 'Studio bagus',
            'resepsionis_id' => '3'
        ]);
    }
}

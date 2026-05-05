<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SidebarCategory;
use App\Models\SidebarItem;

class SidebarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
{
    // E-Survey
    $survey = SidebarCategory::create([
        'nama_kategori' => 'E-Survey',
        'slug' => 'e-survey',
        'urutan' => 1
    ]);

    SidebarItem::create([
        'category_id' => $survey->id,
        'judul' => 'Kuesioner VMTS Dosen',
        'link' => '#'
    ]);

    SidebarItem::create([
        'category_id' => $survey->id,
        'judul' => 'Kuesioner VMTS Mahasiswa',
        'link' => '#'
    ]);

    // Fakultas
    $fakultas = SidebarCategory::create([
        'nama_kategori' => 'Fakultas',
        'slug' => 'fakultas',
        'urutan' => 2
    ]);

    SidebarItem::create([
        'category_id' => $fakultas->id,
        'judul' => 'Fakultas Hukum'
    ]);
}
}

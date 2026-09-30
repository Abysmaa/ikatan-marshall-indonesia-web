<?php

namespace Database\Seeders;

use App\Models\CoverageArea;
use App\Models\Equipment;
use App\Models\Service;
use App\Models\Setting;
use Illuminate\Database\Seeder;

class ContentSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            ['Race Captain', 'race-captain', 'Koordinator utama tim marshal dan komunikasi antarpos.', 'Mengkoordinasikan marshal, mengawasi kegiatan lapangan, dan memastikan koordinasi antarpos berjalan.'],
            ['Bike Marshal', 'bike-marshal', 'Mendampingi peserta dan membantu pengaturan jalur.', 'Mendampingi peserta, membantu pengaturan jalur, memberikan bantuan, dan menjaga keamanan jalur.'],
            ['Sweeper', 'sweeper', 'Memantau peserta terakhir dan membantu saat ada kendala.', 'Memantau peserta terakhir, berada di bagian belakang peserta, dan membantu peserta yang mengalami kendala.'],
            ['Frontliner', 'frontliner', 'Mendukung registrasi, verifikasi, race pack, dan informasi.', 'Melayani peserta, membantu registrasi atau verifikasi, distribusi race pack, dan memberikan informasi event.'],
            ['Backliner', 'backliner', 'Menangani logistik dan kebutuhan race pack.', 'Mengatur logistik, memastikan kebutuhan race pack, dan mengatur distribusi kebutuhan event.'],
            ['Water Station', 'water-station', 'Menyiapkan layanan hidrasi dan menjaga area tetap tertata.', 'Menyiapkan minuman, melayani peserta, menjaga kebutuhan water station, dan kebersihan area.'],
            ['Refreshment', 'refreshment', 'Menyiapkan distribusi makanan dan minuman peserta.', 'Menyiapkan refreshment dan mengatur distribusi makanan atau minuman.'],
            ['Pacer', 'pacer', 'Mendampingi peserta menjaga pace dan target waktu.', 'Membantu peserta mencapai target waktu, menjaga pace, memberikan motivasi, dan menjaga konsistensi kecepatan.'],
            ['Timing System Management', 'timing-system-management', 'Dukungan pencatatan waktu dan pengelolaan hasil event.', 'Mencakup pengelolaan timing system, pencatatan waktu peserta, monitoring timing, pengelolaan data waktu, dan dukungan result event.'],
        ];

        foreach ($services as $order => [$name, $slug, $shortDescription, $description]) {
            Service::updateOrCreate(['slug' => $slug], [
                'name' => $name,
                'short_description' => $shortDescription,
                'description' => $description,
                'sort_order' => $order + 1,
                'status' => true,
            ]);
        }

        foreach (['Jabodetabek', 'Serang', 'Bandung', 'Surabaya', 'Batam', 'Bali'] as $name) {
            CoverageArea::updateOrCreate(['slug' => str($name)->slug()], [
                'name' => $name,
                'description' => 'Wilayah layanan awal. Detail cakupan dan ketersediaan tim dikonfirmasi saat perencanaan event.',
                'status' => true,
            ]);
        }

        foreach (['Bendera Pacer', 'Cone', 'Signage', 'Barricade / Pembatas', 'Balloon Gate', 'LED / Digital Timer'] as $order => $name) {
            Equipment::updateOrCreate(['slug' => str($name)->slug()], [
                'name' => $name,
                'availability' => 'Konfirmasi ketersediaan',
                'sort_order' => $order + 1,
                'status' => true,
            ]);
        }

        foreach ([
            'organization_name' => 'Ikatan Marshall Indonesia',
            'tagline' => '#TreatWithEmpathy',
            'hero_title_first' => 'EVENT BERGERAK.',
            'hero_title_second' => 'SEMUA TERJAGA.',
            'hero_description' => 'Dukungan marshal yang sigap, terkoordinasi, dan selalu ingat bahwa setiap event adalah tentang manusia.',
            'about_lead' => 'Ikatan Marshall Indonesia mendukung penyelenggaraan event melalui tim lapangan yang paham tugas, peka terhadap situasi, dan siap membantu peserta.',
            'about_description' => 'Kami percaya event yang tertib bukan hanya soal alur yang tepat. Cara kita memperlakukan peserta, kru, dan sesama tim sama pentingnya.',
        ] as $key => $value) {
            Setting::updateOrCreate(['key' => $key], [
                'value' => $value,
                'type' => 'text',
            ]);
        }
    }
}

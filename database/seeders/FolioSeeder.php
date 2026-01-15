<?php

namespace Database\Seeders;

use App\Models\Folio;
use Illuminate\Database\Seeder;

class FolioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $folio = [
            [
                'title' => 'Langit Senja',

                'banner' => 'langit-senja.png',
                'trailer' => 'langit-senja.mp4',

                // DESKRIPSI PALING PENDEK (HOMEPAGE)
                'desc_home' => 'Kisah pertemuan singkat yang mengubah cara dua orang memandang arti pulang.',

                // DESKRIPSI SEDANG (SAMPING TRAILER)
                'desc_side' => 'Sebuah pertemuan singkat di waktu yang tidak terduga membawa dua orang pada makna baru tentang rumah dan perasaan yang tertinggal.',

                // DESKRIPSI PANJANG (BAWAH TRAILER)
                'desc_full' => "Langit Senja bercerita tentang dua individu yang dipertemukan kembali dalam waktu yang sangat singkat.\n\n".
                    "Melalui percakapan sederhana dan suasana senja yang tenang, keduanya mulai mempertanyakan arti pulang dan keputusan yang pernah mereka ambil.\n\n".
                    'Film ini menyajikan kisah emosional yang dekat dengan realita kehidupan, tentang kehilangan, harapan, dan kesempatan kedua.',
            ],

            [
                'title' => 'Detik Terakhir',

                'banner' => 'detik-terakhir.png',
                'trailer' => 'detik-terakhir.mp4',

                'desc_home' => 'Ketegangan muncul saat sebuah rahasia terungkap hanya dalam hitungan menit.',

                'desc_side' => 'Dalam situasi yang semakin menekan, setiap detik menjadi penentu antara kebenaran dan konsekuensi.',

                'desc_full' => "Detik Terakhir adalah film bergenre thriller yang berfokus pada satu momen krusial dalam hidup seorang tokoh.\n\n".
                    "Ketika sebuah rahasia terungkap, waktu menjadi musuh terbesar dan keputusan harus diambil tanpa kesempatan untuk mengulang.\n\n".
                    'Film ini menghadirkan ketegangan intens dengan tempo cepat dan atmosfer yang terus menekan hingga akhir.',
            ],

            [
                'title' => 'Di Balik Layar',

                'banner' => 'di-balik-layar.png',
                'trailer' => 'di-balik-layar.mp4',

                'desc_home' => 'Cerita tentang mimpi, kegagalan, dan harapan di dunia perfilman independen.',

                'desc_side' => 'Perjalanan para pembuat film yang berjuang di balik layar untuk mewujudkan mimpi mereka.',

                'desc_full' => "Di Balik Layar mengisahkan kehidupan para sineas independen yang berjuang dengan keterbatasan dan tekanan industri.\n\n".
                    "Film ini memperlihatkan sisi manusiawi dari proses kreatif: kegagalan, konflik, dan semangat untuk terus melangkah.\n\n".
                    'Sebuah cerita reflektif tentang mimpi yang tidak selalu berjalan mulus, namun tetap layak diperjuangkan.',
            ],
        ];

        foreach ($folio as $folio) {
            Folio::create($folio);
        }
    }
}

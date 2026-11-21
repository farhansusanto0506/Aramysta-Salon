<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            [
                'title'       => 'Paket Wedding',
                'image'       => 'services/PaketWedding.jpg',
                'prices'      => implode("\n", [
                    '2,5 Jt Nett (Paket Wedding Violet)',
                ]),
                'highlights'  => implode("\n", [
                    '- Bride service: wedding make-up & busana akad/wedding sepasang (selain adat)',
                    '- Free henna & kupal',
                    '- Free normal softlens & free transport (maks. 5 km)',
                ]),
                'is_featured' => false,
            ],
            [
                'title'       => 'Paket Siraman',
                'image'       => 'services/PaketSiraman.jpg',
                'prices'      => implode("\n", [
                    '800k (Paket Basic)',
                    '1,5jt (Paket Lengkap)',
                ]),
                'highlights'  => implode("\n", [
                    '- Make-up siraman & attire siraman sepasang',
                    '- Melati artificial siraman (bando dan kemul)',
                    '- Dekorasi siraman 2 - 3 mtr (Paket Lengkap)',
                ]),
                'is_featured' => false,
            ],
            [
                'title'       => 'Paket Wisuda Aramysta',
                'image'       => 'services/PaketWisuda.jpg',
                'prices'      => implode("\n", [
                    'Start 50k (Simple Hairdo)',
                    'Start 150k (Make-up Only)',
                    'Start 250k (All in One Wisuda Package)',
                    'Start 600k (Premium Wisuda Package)',
                ]),
                'highlights'  => implode("\n", [
                    '- Make-up as request, fotogenic, dan awet seharian',
                    '- Free simple hijab do / pilihan simple hairdo',
                    '- Pilihan kebaya wisuda (All in One) atau premium kebaya (Premium Package)',
                ]),
                'is_featured' => false,
            ],
        ];

        foreach ($services as $service) {
            Service::updateOrCreate(
                ['title' => $service['title']],
                $service
            );
        }
    }
}
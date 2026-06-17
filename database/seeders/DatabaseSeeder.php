<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Service;
use App\Models\Technician;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create user
        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);

        // Create services
        $services = [
            [
                'service_name' => 'Reparasi Elektronik',
                'slug' => 'reparasi-elektronik',
                'description' => "Memperbaiki peralatan elektronik\nGaransi 7 hari\nHarga terjangkau",
                'base_price' => 150000,
            ],
            [
                'service_name' => 'Servis AC',
                'slug' => 'servis-ac',
                'description' => "Pembersihan komprehensif\nPerawatan berkala\nTeknis berpengalaman",
                'base_price' => 200000,
            ],
            [
                'service_name' => 'Perbaikan Air Conditioning',
                'slug' => 'perbaikan-ac',
                'description' => "Isi freon\nGanti komponen rusak\nGaransi pekerjaan",
                'base_price' => 250000,
            ],
        ];

        $serviceIds = [];
        foreach ($services as $service) {
            $s = Service::create($service);
            $serviceIds[] = $s->id;
        }

        // Create technician users
        $techUsers = [];
        for ($i = 1; $i <= 3; $i++) {
            $techUser = User::create([
                'name' => "Teknisi $i",
                'email' => "technician$i@example.com",
                'password' => Hash::make('password'),
                'role' => 'technician',
                'phone' => '08' . rand(1000000000, 9999999999),
                'address' => "Jakarta, Indonesia",
            ]);
            $techUsers[] = $techUser;
        }

        // Create technicians with services
        foreach ($techUsers as $index => $techUser) {
            Technician::create([
                'user_id' => $techUser->id,
                'service_id' => $serviceIds[$index % count($serviceIds)],
                'specialist' => ['Elektronik', 'AC', 'Plumbing'][$index % 3],
                'experience' => (2 + $index),
                'rating' => (4.5 - ($index * 0.1)),
                'availability_status' => 'available',
            ]);
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@levantbms.com'],
            [
                'name' => 'LevantBMS Admin',
                'password' => bcrypt('password'),
                'role' => User::ROLE_ADMIN,
                'email_verified_at' => now(),
            ]
        );

        $this->call([
            ContentSeeder::class,
            SettingSeeder::class,
            PostSeeder::class,
            ServiceSeeder::class,
            GallerySeeder::class,
            PartnerSeeder::class,
            FaqSeeder::class,
            SeoSeeder::class,
        ]);
    }
}

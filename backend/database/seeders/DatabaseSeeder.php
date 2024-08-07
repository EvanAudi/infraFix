<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            RandomUserSeeder::class,
            DamageTypeSeeder::class,
            DaerahSeeder::class,
            NonAnonymousReportSeeder::class,
            AnonymousReportSeeder::class,
            ReportImageSeeder::class,
            CaseSeeder::class,
            MilestoneSeeder::class,
            CommentSeeder::class
        ]);
    }
}

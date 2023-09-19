<?php

namespace IntimateTales\Database\seeders;

use Illuminate\Database\Seeder;
use IntimateTales\App\Models\PluginModel;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        PluginModel::factory()->count(10)->create();
    }
}

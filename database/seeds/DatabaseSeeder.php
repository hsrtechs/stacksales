<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CompanySeeder::class);
        $this->call(CertificateCategorySeeder::class);
        $this->call(QualificationSeeder::class);
        $this->call(UserSeeder::class);
    }
}

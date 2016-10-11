<?php

use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Company::class,100)->create()->each(function ($u){
            $u->Certificates()->save(factory(App\Certificate::class)->make());
        });
    }
}

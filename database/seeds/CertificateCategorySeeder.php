<?php

use Illuminate\Database\Seeder;

class CertificateCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $levels = [
            ['name' => '证件名称', 'category' => 1],
            ['name' => '一级建造师', 'category' => 2],
            ['name' => '二级建造师', 'category' => 2],
            ['name' => '造价师', 'category' => 3],
            ['name' => '助理工程师', 'category' => 4],
            ['name' => '工程师', 'category' => 4],
            ['name' => '高级工程师', 'category' => 4],
            ['name' => '初级技工', 'category' => 5],
            ['name' => '中级技工', 'category' => 5],
            ['name' => '高级技工', 'category' => 5],
            ['name' => '技师', 'category' => 5],
            ['name' => '高级技师', 'category' => 5],
            ['name' => '材料员', 'category' => 6],
            ['name' => '质检员', 'category' => 6],
            ['name' => '安全员', 'category' => 6],
            ['name' => '资料员', 'category' => 6],
            ['name' => '施工员', 'category' => 6],
            ['name' => '预算员', 'category' => 6],
            ['name' => '安全考核A证', 'category' => 7],
            ['name' => '安全考核B证', 'category' => 7],
            ['name' => '安全考核C证', 'category' => 7],
            ['name' => '建设厅特种', 'category' => 8],
            ['name' => '安监局特种', 'category' => 8],
        ];

        $certificates = [
            ['name' => '种类', 'category' => 1],
            ['name' => '建造师', 'category' => 1],
            ['name' => '造价师', 'category' => 1],
            ['name' => '工程师', 'category' => 1],
            ['name' => '技术工种', 'category' => 2],
            ['name' => '关键岗位', 'category' => 2],
            ['name' => '安全考核', 'category' => 3],
            ['name' => '特种作业', 'category' => 3],
        ];

        $categories = ['大类','资质证书','安全许可'];
        $faker = Faker\Factory::create();

        foreach ($categories as $category)
        {
            $cc = new \App\CertificateCategory;
            $cc->name = $category;
            $cc->saveOrFail();

        }

        foreach ($certificates as $certificate)
        {
            $cc = DB::table('companies')->select('id')->get();

            $c = new \App\Certificate;
            $c->name = $certificate['name'];
            $c->internal_number = $faker->unique()->randomNumber(6,true);
            $c->role = $faker->userName;
            $c->info = $faker->realText();
            $c->issue = $faker->date();
            $c->expiry = $faker->date();
            $c->renewal = \Carbon\Carbon::now()->addMonth(random_int(1,5));
            $c->status = 1;
            $c->category_id = $certificate['category'];
            $c->company_id = $cc->random()->id ?: 1;
            $c->saveOrFail();
        }

        foreach ($levels as $level)
        {
            $cl = new \App\CertificateLevel;
            $cl->name = $level['name'];
            $cl->certificate_id = $level['category'];
            $cl->saveOrFail();
        }
    }
}

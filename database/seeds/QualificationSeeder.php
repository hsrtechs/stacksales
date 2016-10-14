<?php

use App\Qualification;
use App\QualificationCategory;
use App\QualificationLevel;
use Illuminate\Database\Seeder;

class QualificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $qcnames = ['承包序列', '施工总承包序列', '专业承包序列'];
        foreach ($qcnames as $qcname)
        {
            $qc = new QualificationCategory;
            $qc->name = $qcname;
            $qc->saveOrFail();
        }

        $qlnames = ['特级', '一级', '二级', '三级', '不分等级'];

        foreach ($qlnames as $qlname)
        {
            $ql = new QualificationLevel;
            $ql->value = $qlname;
            $ql->saveOrFail();
        }

        $qnames = [
            ['fname' => '建筑工程施工总承包', 'level' => [1],'cat' => [1]],
            ['fname' => '公路工程施工总承包', 'level' => [1,2,3,4],'cat' => [2]],
            ['fname' => '铁路工程施工总承包', 'level' => [1,2,3,4],'cat' => [2]],
            ['fname' => '港口与航道工程施工总承包', 'level' => [1,2,3,4],'cat' => [2]],
            ['fname' => '水利水电工程施工总承包	', 'level' => [1,2,3,4],'cat' => [2]],
            ['fname' => '电力工程施工总承包', 'level' => [1,2,3,4],'cat' => [2]],
            ['fname' => '矿山工程施工总承包', 'level' => [1,2,3,4],'cat' => [2]],
            ['fname' => '冶金工程施工总承包', 'level' => [1,2,3,4],'cat' => [2]],
            ['fname' => '石油化工工程施工总承包	', 'level' => [1,2,3,4],'cat' => [2]],
            ['fname' => '市政公用工程施工总承包	', 'level' => [1,2,3,4],'cat' => [2]],
            ['fname' => '通信公用工程施工总承包	', 'level' => [2,3,4],'cat' => [2]],
            ['fname' => '机电公用工程施工总承包	', 'level' => [2,3,4],'cat' => [2]],
            ['fname' => '地基基础工程专业承包', 'level' => [2,3,4],'cat' => [3]],
            ['fname' => '起重设备安装工程专业承包', 'level' => [2,3,4],'cat' => [3]],
            ['fname' => '搅拌混凝土工程专业承包	', 'level' => [5],'cat' => [3]],
            ['fname' => '电子与智能化工程专业承包', 'level' => [2,3],'cat' => [3]],
            ['fname' => '消防设施工程专业承包', 'level' => [2,3],'cat' => [3]],
            ['fname' => '防水防腐保温工程专业承包', 'level' => [2,3],'cat' => [3]],
            ['fname' => '桥梁工程专业承包资质', 'level' => [2,3,4],'cat' => [3]],
            ['fname' => '隧道工程专业承包', 'level' => [2,3,4],'cat' => [3]],
            ['fname' => '钢结构工程专业承包', 'level' => [2,3,4],'cat' => [3]],
            ['fname' => '模板脚手架专业承包', 'level' => [5],'cat' => [3]],
            ['fname' => '建筑装修装饰工程专业承包', 'level' => [2,3],'cat' => [3]],
            ['fname' => '建筑机电安装工程专业承包', 'level' => [2,3,4],'cat' => [3]],
            ['fname' => '建筑幕墙工程专业承包', 'level' => [2,3],'cat' => [3]],
            ['fname' => '古建筑工程专业承包', 'level' => [2,3,4],'cat' => [3]],
            ['fname' => '城市及道路照明工程专业承包', 'level' => [2,3,4],'cat' => [3]],
            ['fname' => '公路路面工程专业承包', 'level' => [2,3,4],'cat' => [3]],
            ['fname' => '公路路基工程专业承包', 'level' => [2,3,4],'cat' => [3]],
            ['fname' => '公路交通工程专业承包 (公路安全设施)', 'level' => [2,3],'cat' => [3]],
            ['fname' => '公路交通工程专业承包 (公路机电工程)', 'level' => [2,3],'cat' => [3]],
            ['fname' => '铁路电务工程专业承包', 'level' => [2,3,4],'cat' => [3]],
            ['fname' => '铁路铺轨架梁工程专业承包', 'level' => [2,3],'cat' => [3]],
            ['fname' => '铁路电气化工程专业承包	', 'level' => [2,3,4],'cat' => [3]],
            ['fname' => '机场场道工程专业承包', 'level' => [2,3],'cat' => [3]],
            ['fname' => '名航空管工程及机场弱电系统工程专业承包', 'level' => [2,3],'cat' => [3]],
            ['fname' => '机场目视助航工程专业承包', 'level' => [2,3],'cat' => [3]],
            ['fname' => '港口与海岸工程专业承包	', 'level' => [2,3,4],'cat' => [3]],
            ['fname' => '航道工程专业承包', 'level' => [2,3,4],'cat' => [3]],
            ['fname' => '通航建筑物工程专业承包	', 'level' => [2,3,4],'cat' => [3]],
            ['fname' => '港航设备安装及水上交管工程专业承包', 'level' => [2,3],'cat' => [3]],
            ['fname' => '水工金属结构制作与安装工程专业承包', 'level' => [2,3,4],'cat' => [3]],
            ['fname' => '水利水电机电安装工程专业承包', 'level' => [2,3,4],'cat' => [3]],
            ['fname' => '河湖整治工程专业承包', 'level' => [2,3,4],'cat' => [3]],
            ['fname' => '输变电工程专业承包', 'level' => [2,3,4],'cat' => [3]],
            ['fname' => '核工程专业承包', 'level' => [2,3],'cat' => [3]],
            ['fname' => '海洋石油工程专业承包', 'level' => [2,3],'cat' => [3]],
            ['fname' => '环保工程专业承包', 'level' => [2,3,4],'cat' => [3]],
            ['fname' => '特种工程专业承包', 'level' => [5],'cat' => [3]],
        ];
        foreach ($qnames as $qname)
        {
            $q = new Qualification;
            $q->name = $qname['fname'];
            $q->friendlyname = $qname['fname'];
            $q->saveOrFail();
            $q->Levels()->attach($qname['level']);
            $q->Categories()->attach($qname['cat']);
        }
    }
}

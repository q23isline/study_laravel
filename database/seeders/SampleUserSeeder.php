<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SampleUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = now();
        $data = [];
        for ($i = 0; $i < 52; $i++) {
            $data[] = [
                'name' => $this->randomName(),
                'birth_day' => $this->randomDate(),
                'height' => rand(140, 200).'.'.rand(0, 9),
                'gender' => (string) rand(1, 2),
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        DB::table('sample_users')->insert($data);
    }

    /**
     * ランダムな名前を生成
     */
    private function randomName(): string
    {
        $lastNames = ['佐藤', '鈴木', '高橋', '田中', '伊藤', '渡辺', '山本', '中村', '小林', '加藤'];
        $firstNamesMale = ['太郎', '一郎', '健太', '翔', '直樹', '悠斗', '颯太', '大和', '陽翔', '陸'];
        $firstNamesFemale = ['花子', '美咲', 'さくら', '結衣', '葵', '玲奈', '七海', '莉子', '楓', '優奈'];

        $lastName = $lastNames[array_rand($lastNames)];
        if (rand(1, 2) === 1) {
            $firstName = $firstNamesMale[array_rand($firstNamesMale)];
        } else {
            $firstName = $firstNamesFemale[array_rand($firstNamesFemale)];
        }

        return $lastName.' '.$firstName;
    }

    /**
     * ランダムな日付を生成
     */
    private function randomDate(): string
    {
        $startTimestamp = strtotime('1950-01-01');
        $endTimestamp = strtotime('2005-12-31');
        $randomTimestamp = rand($startTimestamp, $endTimestamp);

        return date('Y-m-d', $randomTimestamp);
    }
}

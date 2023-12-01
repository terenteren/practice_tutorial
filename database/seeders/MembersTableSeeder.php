<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MembersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('members')->insert([
            'uid' => 'admin',
            'pwd' => '1234',
            'name' => '관리자',
            'tel' => '1234567890',
            'rank' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        for ($i = 1; $i <= 50; $i++) {
            DB::table('members')->insert([
                'uid' => 'id' . $i,
                'pwd' => '1234',
                'name' => 'tester' . $i,
                'tel' => '1234567890',
                'rank' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}

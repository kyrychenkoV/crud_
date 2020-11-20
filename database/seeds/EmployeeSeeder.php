<?php

use App\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('employees')->insert([
            'user_id' => 1,
            'department_id' => 1,
            'salary' => 1000,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('employees')->insert([
            'user_id' => 2,
            'department_id' => 2,
            'salary' => 1000,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}

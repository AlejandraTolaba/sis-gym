<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(ActivitySeeder::class);
        $this->call(StudentSeeder::class);
        $this->call(PlanSeeder::class);
        $this->call(MethodOfPaymentSeeder::class);
        $this->call(TeacherSeeder::class);
        $this->call(ProductSeeder::class);
    }
}

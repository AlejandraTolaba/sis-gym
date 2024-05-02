<?php

use Illuminate\Database\Seeder;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('teachers')->delete();
        $names = ['Marcela','Federico'];
        $lastnames = ['Lopez','Martinez'];
        $dni = ['21234321','19098890'];
        $birthdate = ['1971-03-01','1969-08-10'];
        $gender = ['F', 'M'];
        $address =['Vicente Lopez 500', 'España 789'];
        $phone_number = ['3874314787','38756894789'];
        $photos = ['avatar.png','avatar.png'];


        for ($i=0; $i <sizeof($names) ; $i++) {
            DB::table('teachers')
            ->insert([
                'name' => $names[$i],
                'lastname' => $lastnames[$i],
                'dni' => $dni[$i],
                'birthdate' => $birthdate[$i],
                'gender' => $gender[$i],
                'address' => $address[$i],
                'phone_number' => $phone_number[$i],
                'photo' => $photos[$i],
            ]);
        }
    }
}

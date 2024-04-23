<?php

use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('students')->delete();
        $names = ['Belén','Luis'];
        $lastnames = ['Lopez','Martinez'];
        $dni = ['40234321','38098890'];
        $birthdate = ['1997-03-01','1994-08-10'];
        $gender = ['F', 'M'];
        $address =['Vicente Lopez 146', 'España 234'];
        $phone_number = ['3874314848','38756894890'];
        $certificate = [true, true];
        $certificate_date = ['2019-03-11','2020-12-01'];
        $discharge_date = ['2019-03-01','2020-11-20'];


        for ($i=0; $i <sizeof($names) ; $i++) {
            DB::table('students')
            ->insert([
                'name' => $names[$i],
                'lastname' => $lastnames[$i],
                'dni' => $dni[$i],
                'birthdate' => $birthdate[$i],
                'gender' => $gender[$i],
                'address' => $address[$i],
                'phone_number' => $phone_number[$i],
                'certificate' => $certificate[$i],
                'certificate_date' => $certificate_date[$i],
                // 'discharge_date' => $discharge_date[$i],
            ]);
        }
    }
}

<?php

use Illuminate\Database\Seeder;

class InscriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('inscriptions')->delete();
        $registration_dates = ['2023-04-28','2023-06-02','2024-06-12'];
        $expiration_dates = ['2023-05-29','2023-07-03','2024-07-13'];
        $students_id = [1,2,1];
        $activities_id = [1,1,1];
        $plans_id = [3,3,3];
        $classes = [12,12,12];
        $inscriptions_id = [1,2,3];
        $methods_of_payment_id = [1,1,1];
        $amounts = [10000,12000,14000];
        $balances = [2000,0,0];

        
        for ($i=0; $i <sizeof($registration_dates) ; $i++) {
            DB::table('inscriptions')
            ->insert([
                'registration_date' => $registration_dates[$i],
                'expiration_date' => $expiration_dates[$i],
                'student_id' => $students_id[$i],
                'activity_id' => $activities_id[$i],
                'plan_id' => $plans_id[$i],
                'student_id' => $students_id[$i],
                'classes' => $classes[$i],
                'balance' => $balances[$i]
            ]);
            DB::table('inscription_method_of_payment')
            ->insert([
                'inscription_id' => $inscriptions_id[$i],
                'method_of_payment_id' => $methods_of_payment_id[$i],
                'amount' => $amounts[$i]
            ]);
            DB::table('movements')
            ->insert([
                'method_of_payment_id' => $methods_of_payment_id[$i],
                'concept' => "Inscripción N° ".$inscriptions_id[$i],
                'type' => 'INGRESO',
                'amount' => $amounts[$i]
            ]);
        }
    }
}

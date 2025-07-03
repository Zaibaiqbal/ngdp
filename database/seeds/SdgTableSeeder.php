<?php

use Illuminate\Database\Seeder;
use App\Sdg;
class SdgTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $sdg = Sdg::insert([
          'id' => 1,
          'name' => "1- No Poverty",
      ]);
      $sdg = Sdg::insert([
          'id' => 2,
          'name' => "2- Zero Hunger",
        ]);
        $sdg = Sdg::insert([
          'id' => 3,
          'name' => "3- Good Health and Well-being",
        ]);
        $sdg = Sdg::insert([
          'id' => 4,
          'name' => "4- Quality Education",
        ]);
        $sdg = Sdg::insert([
          'id' => 5,
          'name' => "5- Gender Equality",
        ]);
        $sdg = Sdg::insert([
          'id' => 6,
          'name' => "6- Clean Water and Sanitation",
        ]);
        $sdg = Sdg::insert([
          'id' => 7,
          'name' => "7- Affordable and Clean Energy",
        ]);
        $sdg = Sdg::insert([
          'id' => 8,
          'name' => "8- Decent Work and Economic Growth",
        ]);
        $sdg = Sdg::insert([
          'id' => 9,
          'name' => "9- Industry, Innovation, and Infrastructure",
        ]);
        $sdg = Sdg::insert([
          'id' => 10,
          'name' => "10- Reducing Inequality",
        ]);
        $sdg = Sdg::insert([
          'id' => 11,
          'name' => "11- Sustainable Cities and Communities",
        ]);
        $sdg = Sdg::insert([
          'id' => 12,
          'name' => "12- Responsible Consumption and Production",
        ]);
        $sdg = Sdg::insert([
          'id' => 13,
          'name' => "13- Climate Action",
        ]);
        $sdg = Sdg::insert([
          'id' => 14,
          'name' => "14- Life Below Water",
        ]);
        $sdg = Sdg::insert([
          'id' => 15,
          'name' => "15- Life on Land",
        ]);
        $sdg = Sdg::insert([
          'id' => 16,
          'name' => "16- Peace, Justice, and Strong Institutions",
        ]);
        $sdg = Sdg::insert([
          'id' => 17,
          'name' => "17- Partnerships for the Goals",
      ]);

    }
}

<?php

use Illuminate\Database\Seeder;
use App\KnowledgeTheme;

class knowledgeThemeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $count = -1;

        $data[++$count] = ['name' => 'Demographics', 'image' => 'icon-06.png' , 'created_at' => now()];

        $data[++$count] = ['name' => 'Education', 'image' => 'icon-06.png' , 'created_at' => now()];

        $data[++$count] = ['name' => 'Health', 'image' => 'icon-06.png' , 'created_at' => now()];

        $data[++$count] = ['name' => 'Economic Empowerment', 'image' => 'icon-06.png' , 'created_at' => now()];

        $data[++$count] = ['name' => 'Violence Against Women', 'image' => 'icon-06.png' , 'created_at' => now()];

        $data[++$count] = ['name' => 'Disabilities', 'image' => 'icon-06.png' , 'created_at' => now()];


        $data[++$count] = ['name' => 'Access to Justice', 'image' => 'icon-06.png' , 'created_at' => now()];

        $data[++$count] = ['name' => 'Public and Political Participation', 'image' => 'icon-06.png' , 'created_at' => now()];

        $data[++$count] = ['name' => 'Girl Child Rights', 'image' => 'icon-06.png' , 'created_at' => now()];

        $data[++$count] = ['name' => 'Access to Knowledge and ICT', 'image' => 'icon-06.png' , 'created_at' => now()];

        $data[++$count] = ['name' => 'Women in Peace and Conflicts', 'image' => 'icon-06.png' , 'created_at' => now()];

        $data[++$count] = ['name' => 'Portrayal in the media', 'image' => 'icon-06.png' , 'created_at' => now()];

        $data[++$count] = ['name' => 'Poverty and Social Protection', 'image' => 'icon-06.png' , 'created_at' => now()];

        $data[++$count] = ['name' => 'Women and Sustainable Development', 'image' => 'icon-06.png' , 'created_at' => now()];

        $data[++$count] = ['name' => 'Women in Emergencies/Disasters', 'image' => 'icon-06.png' , 'created_at' => now()];

        $data[++$count] = ['name' => 'Human Rights of Women', 'image' => 'icon-06.png' , 'created_at' => now()];

        $data[++$count] = ['name' => 'Gender Mainstreaming', 'image' => 'icon-06.png' , 'created_at' => now()];

        $data[++$count] = ['name' => 'National Commitments of Pakistan ', 'image' => 'icon-06.png' , 'created_at' => now()];

        $data[++$count] = ['name' => 'Women in Agriculture', 'image' => 'icon-06.png' , 'created_at' => now()];

        $data[++$count] = ['name' => 'Home-based Workers and Economy', 'image' => 'icon-06.png' , 'created_at' => now()];

        $data[++$count] = ['name' => 'Women and Environmental Protection', 'image' => 'icon-06.png' , 'created_at' => now()];

        knowledgeTheme::insert($data);

    }
}

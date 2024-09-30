<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ModelCompanies;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        /* 
            $companies = new ModelCompanies;
            $companies->name = 'Netcommerce';
            $companies->save(); 
        */

        /* 
            DB::table('companies')->insert([
                ['name' => 'Netcommerce'],
                ['name' => 'Another Company'],
            ]); 
        */

        ModelCompanies::factory(5)->create();
    }
}

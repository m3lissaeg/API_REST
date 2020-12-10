<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student;

class StudentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Let's truncate our existing records to start from scratch.
        Student::truncate();

        $faker = \Faker\Factory::create();

        // And now, let's create a few Students in our database:
        for ($i = 0; $i < 50; $i++) {
            Student::create([
                'name' => $faker->name,
                'lastName' => $faker->lastName,
                'age' => $faker->numberBetween($min = 10, $max = 900),
            ]);
        }
    }
}

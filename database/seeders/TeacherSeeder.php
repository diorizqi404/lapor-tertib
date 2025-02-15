<?php

    namespace Database\Seeders;

    use Illuminate\Database\Console\Seeds\WithoutModelEvents;
    use Illuminate\Database\Seeder;
    use Illuminate\Support\Facades\DB;
    use Faker\Factory as Faker;
    use Illuminate\Support\Facades\Hash;
    use Illuminate\Support\Str;

    class TeacherSeeder extends Seeder
    {
        /**
         * Run the database seeds.
         */
        public function run(): void
        {
            $faker = Faker::create();
            $amount = 100;

            for($i=0; $i < $amount; $i++)
            {
                DB::table('users')->insert([
                    'school_id' => '1',
                    'role' => 'teacher',
                    'name' => $faker->name,
                    'email' => $faker->unique()->safeEmail,
                    'phone' => $faker->phoneNumber,
                    'gender' => $faker->randomElement(['L', 'P']),
                    'password' => Hash::make('password'),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

    }

<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Log;

class UsersModelSeeder extends Seeder
{
    public function run(int $count, int $id): void
    {
        try {
            $faker = Faker::create();

            for ($i = 0; $i < $count; $i++) {

                $gender = $faker->randomElement([
                    'male',
                    'female',
                ]);

                $firstName = $faker->firstName();
                $lastName = $faker->lastName();

                $name = $firstName . ' ' . $lastName;

                $rememberToken = $this->getName();

                $stateId = random_int(1, 40);

                $password = $rememberToken;

                $data = [
                    'first_name' => $firstName,
                    'last_name' => $lastName,
                    'user_name' => $name,
                    'email' => $faker->unique()->safeEmail(),
                    'phone' => (string) random_int(
                        1111111111,
                        9999999999
                    ),
                    'password' => Hash::make($password),
                    'temp_password' => $rememberToken,
                    'token' => null,
                    'gender' => $gender,
                    'state' => $stateId,
                    'user_type' => User::USER,
                    'created_by' => $id,
                ];

                User::create($data);
            }

        } catch (\Throwable $th) {

            Log::error(
                'Dummy user data insertion failed: '
                . $th->getMessage()
            );
        }
    }

    public function getName(int $n = 8): string
    {
        $characters =
            '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        $randomString = '';

        for ($i = 0; $i < $n; $i++) {
            $index = random_int(
                0,
                strlen($characters) - 1
            );

            $randomString .= $characters[$index];
        }

        return $randomString;
    }
}
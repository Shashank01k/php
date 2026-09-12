<?php

namespace App\Database\Seeds;

use App\Models\User;
use CodeIgniter\Database\Seeder;

// class UsersModelSeeder extends Seeder
class UsersModelSeeder
{
    public function run(int $count = 5)
    {
        // echo "user seeder controller::"; die;
        //
        $usersModel = new User;

        for($i=0; $i<$count; $i++){

            $faker = \Faker\Factory::create();

            $gender = 'female';
            if($i%2 == 0){
                $gender = 'male';
            }

            $name = $faker->name;
            $lastSpacePos = strrpos($name, ' ');
            // Extract the substrings
            $firstName = substr($name, 0, $lastSpacePos);
            $lastName = substr($name, $lastSpacePos + 1);

            $rememberToken = self::getName();
            $password = $rememberToken;
            $stateId = rand(1,40);

            $data = [
                "first_name" => $firstName,
                "last_name" => $lastName,
                "user_name" => $name,
                "email" => $faker->email,
                "phone" => rand(1111111111,9999999999),
                "password" => $password,
                "temp_password" => $rememberToken,
                "token" => null,
                "gender" => $gender,
                "state" => $stateId,
                'user_type' => User::USER,
            ];
            $usersResponse = $usersModel->save($data);
        }
    }

    public function getName(int $n = 8) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
    
        for ($i = 0; $i < $n; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
        }
        return $randomString;
    }
}
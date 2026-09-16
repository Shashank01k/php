<?php

namespace App\Http\Controllers\Web\V1\Admin;

use App\Http\Controllers\Controller;
use Database\Seeders\UsersModelSeeder;
use Illuminate\Http\Request;

class SeederController extends Controller
{

    public function index()
    {
        $data = [
            'title' => 'Dummy User Seeder',
            'message' => 'Insert input number for create dummy Data...🤠🤠🤠',
        ];

        return view('admin.seeder.index', $data);
    }

    public function insertDummyData(Request $request)
    {
        $data = [
            'title' => 'Dummy User Seeder',
            'message' => 'Insert input number for create dummy Data...🤠🤠🤠',
        ];

        $number = $request->input('number');

        $id = (int) session('id');

        if ($number !== null && $number !== '') {

            $usersModelSeeder = new UsersModelSeeder();

            $usersModelSeeder->run(
                (int) $number,
                $id
            );

            $data['message'] =
                'Dummy Data Inserted Successfully...😎😎😎';
        }

        return view('admin.seeder.index', $data);
    }
}
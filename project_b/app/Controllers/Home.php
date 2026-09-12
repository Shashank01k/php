<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        $data = [
            "title"=> "Welcome Page",
        ];

        return view('welcome', $data);
    }
}

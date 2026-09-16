<?php

namespace App\Http\Controllers\Web\V1\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PageController extends Controller
{

    public function contact()
    {
        return view('pages.contact', [
            'title' => 'Contact Us',
        ]);
    }

    public function about()
    {
        return view('pages.about', [
            'title' => 'About Us',
        ]);
    }

    public function careers()
    {
        return view('pages.careers', [
            'title' => 'Careers',
        ]);
    }

    public function terms()
    {
        return view('pages.terms', [
            'title' => 'Terms',
        ]);
    }

    public function privacy()
    {
        return view('pages.privacy', [
            'title' => 'Privacy',
        ]);
    }
}
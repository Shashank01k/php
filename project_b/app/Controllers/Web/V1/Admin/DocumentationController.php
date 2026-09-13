<?php

namespace App\Controllers\Web\V1\Admin;

use App\Controllers\BaseController;

class DocumentationController extends BaseController
{
    public function index()
    {
        return view(
            'project_b/crud/admin/documentation/index',
            [
                'title' => 'Documentation'
            ]
        );
    }
}
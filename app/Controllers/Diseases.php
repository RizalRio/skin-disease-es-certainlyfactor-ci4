<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Diseases extends BaseController
{
    public function index()
    {
        return view('pages/diseases');
    }
}

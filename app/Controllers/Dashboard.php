<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Diseases;
use App\Models\Rules;
use App\Models\Symptoms;
use CodeIgniter\HTTP\ResponseInterface;

class Dashboard extends BaseController
{
    public function index()
    {
        $diseaseModel   = new Diseases();
        $symptomModel   = new Symptoms();
        $rulesModel     = new Rules();

        $data = [
            'title' => 'Dashboard',
            'data'  => [
                'totalDisease'  => $diseaseModel->countAll(),
                'totalSymptom'  => $symptomModel->countAll(),
                'totalRules'    => $rulesModel->countAll()
            ]
        ];

        return view('pages/dashboard', $data);
    }

}

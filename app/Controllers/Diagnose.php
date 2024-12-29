<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Diseases;
use App\Models\Rules;
use App\Models\Symptoms;
use CodeIgniter\HTTP\ResponseInterface;

class Diagnose extends BaseController
{
    public function index()
    {
        $symptomModel = new Symptoms();
        $dataSymptom = $symptomModel->findAll();

        $dataQuestion = [
            'Sangat yakin'  => 1.0,
            'Yakin'         => 0.8,
            'Cukup yakin'   => 0.6,
            'Kurang yakin'  => 0.4,
            'Tidak tahu'    => 0.2,
            'Tidak'         => 0
        ];

        $data = [
            'title'     => 'Diagnose',
            'symptoms'  => $dataSymptom,
            'question'  => $dataQuestion,
        ];

        return view('pages/diagnose', $data);
    }

    public function diagnose()
    {
        $selectedSymptoms = $this->request->getPost('symptoms');
        $userValues = $this->request->getPost('values');

        if (empty($selectedSymptoms)) {
            return redirect()->back()->with('error', 'Pilih minimal satu gejala.');
        }

        $ruleModel = new Rules();
        $diseaseModel = new Diseases();

        $rules = $ruleModel->whereIn('symptom_id', array_keys($selectedSymptoms))->findAll();

        if (empty($rules)) {
            return redirect()->back()->with('error', 'Tidak ada aturan yang sesuai.');
        }

        $results = [];
        foreach ($rules as $rule) {
            $diseaseId = $rule['disease_id'];
            $cfRule = $rule['cf_value'];
            $cfUser = $userValues[$rule['symptom_id']] ?? 0;

            $cfGejala = $cfRule * $cfUser;

            if (!isset($results[$diseaseId])) {
                $results[$diseaseId] = $cfGejala;
            } else {
                $results[$diseaseId] = $results[$diseaseId] + $cfGejala * (1 - $results[$diseaseId]);
            }
        }
        arsort($results);

        $diagnoses = [];
        foreach ($results as $diseaseId => $cfValue) {
            $disease = $diseaseModel->find($diseaseId);
            $disease['cf_value'] = $cfValue;
            $diagnoses[] = $disease;
        }

        return view('pages/diagnose_result', [
            'title'     => 'Hasil Diagnosa',
            'diagnoses' => $diagnoses
        ]);
    }
}

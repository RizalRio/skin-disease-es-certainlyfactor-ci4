<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Rules as ModelsRules;
use CodeIgniter\HTTP\ResponseInterface;

class Rules extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Rules'
        ];

        return view('pages/rules', $data);
    }

    public function getData()
    {
        $rulesModel = new ModelsRules();

        $start          = $this->request->getVar('start') ?? 0;
        $length         = $this->request->getVar('length') ?? 10;
        $searchValue    = $this->request->getVar('search')['value'] ?? '';

        $query = $rulesModel;

        if (!empty($searchValue)) {
            $query = $query->groupStart()
                ->like('diseases.name', $searchValue)
                ->orLike('symptoms.description', $searchValue)
                ->orLike('rules.cf_value', $searchValue)
                ->groupEnd();
        }

        $totalRecords = $rulesModel->countAll();
        $totalFiltered = $query->countAllResults(false);

        $query = $query->select('rules.id, rules.disease_id, rules.symptom_id, rules.cf_value, diseases.name as disease, symptoms.description as symptom')
            ->join('diseases', 'diseases.id = rules.disease_id')
            ->join('symptoms', 'symptoms.id = rules.symptom_id');

        $data = $query->orderBy('rules.id', 'ASC')
            ->findAll($length, $start);

        foreach ($data as &$row) {
            $row['actions'] = '<button type="button" class="btn btn-info btn-sm btn-edit mr-2" data-id="' . esc($row['id']) . '" data-toggle="modal" data-target="#editDiseases"><i class="fas fa-edit"></i></button>
                           <button type="button" class="btn btn-danger btn-sm btn-delete" data-id="' . esc($row['id']) . '" data-toggle="modal" data-target="#deleteDiseases"><i class="fas fa-trash"></i></button>';
        }

        $result = [
            'draw' => $this->request->getVar('draw'),
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $totalFiltered,
            'data' => $data,
        ];

        return $this->response->setJSON($result);
    }

    public function create()
    {
        $rulesModel = new ModelsRules();

        if ($this->request->getMethod() == 'post') {
            $dataPost = $this->request->getVar();

            $dataInsert = [
                'disease_id'    => $dataPost['selectDisease'],
                'symptom_id'    => $dataPost['selectSymptom'],
                'cf_value'      => $dataPost['inputCF'],
            ];


            if ($rulesModel->insert($dataInsert)) {
                session()->setFlashData('success', 'Data berhasil ditambahkan.');
                return redirect()->to($_SERVER['HTTP_REFERER']);
            } else {
                session()->setFlashData('danger', 'Data gagal ditambahkan!');

                $errors = $rulesModel->errors();
                if ($errors) {
                    foreach ($errors as $error) {
                        log_message('error', $error);
                    }
                }
                return redirect()->to($_SERVER['HTTP_REFERER']);
            }
        }
    }

    public function edit()
    {
        $rulesModel = new ModelsRules();
        $data = $this->request->getVar();

        if ($this->request->getMethod() == 'post') {
            $dataPost = $this->request->getVar();

            $dataEdit = [
                'disease_id'    => $dataPost['selectEditDisease'],
                'symptom_id'    => $dataPost['selectEditSymptom'],
                'cf_value'      => $dataPost['inputEditCF'],
            ];

            if ($rulesModel->update($dataPost['id'], $dataEdit)) {
                session()->setFlashData('success', 'Data berhasil diupdate.');
                return redirect()->to($_SERVER['HTTP_REFERER']);
            } else {
                session()->setFlashData('danger', 'Data gagal diupdate!');

                $errors = $rulesModel->errors();
                if ($errors) {
                    foreach ($errors as $error) {
                        log_message('error', $error);
                    }
                }
                return redirect()->to($_SERVER['HTTP_REFERER']);
            }
        } elseif ($this->request->isAJAX()) {
            $dataGet = $rulesModel->select('rules.id, rules.disease_id, rules.symptom_id, rules.cf_value, diseases.name as disease, symptoms.description as symptom')
                ->join('diseases', 'diseases.id = rules.disease_id')
                ->join('symptoms', 'symptoms.id = rules.symptom_id')
                ->find($data['id']);

            if (!empty($dataGet)) {
                $response = [
                    'status'        => 'success',
                    'message'       => 'Data berhasil didapatkan.',
                    'receivedData'  => $dataGet
                ];
            } else {
                $response = [
                    'status'        => 'error',
                    'message'       => 'Data gagal didapatkan.'
                ];
            }

            return $this->response->setJSON($response);
        }
    }

    public function delete()
    {
        $rulesModel = new ModelsRules();
        $idPost = $this->request->getVar('idDelete');

        if ($this->request->getMethod() == 'post' && !empty($idPost)) {
            if ($rulesModel->delete($idPost)) {
                session()->setFlashData('success', 'Data berhasil dihapus.');
                return redirect()->to($_SERVER['HTTP_REFERER']);
            } else {
                session()->setFlashData('danger', 'Data gagal dihapus!');

                $errors = $rulesModel->errors();
                if ($errors) {
                    foreach ($errors as $error) {
                        log_message('error', $error);
                    }
                }
                return redirect()->to($_SERVER['HTTP_REFERER']);
            }
        }
    }
}

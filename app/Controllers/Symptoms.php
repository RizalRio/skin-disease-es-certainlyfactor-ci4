<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Symptoms as ModelsSymptoms;
use CodeIgniter\HTTP\ResponseInterface;

class Symptoms extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Gejala'
        ];

        return view('pages/symptoms', $data);
    }

    public function getData()
    {
        $symptomsModel = new ModelsSymptoms();

        $start          = $this->request->getVar('start');
        $length         = $this->request->getVar('length');
        $searchValue    = $this->request->getVar('search')['value'];

        $query = $symptomsModel;

        if (!empty($searchValue)) {
            $query = $query->like('description', $searchValue)
                ->orLike('code', $searchValue);
        }

        $totalRecords = $symptomsModel->countAll();

        $totalFiltered = $query->countAllResults(false);

        $data = $query->orderBy('id', 'ASC')
            ->findAll($length, $start);

        // Add action buttons
        foreach ($data as &$row) {
            $row['actions'] = '<button type="button" class="btn btn-info btn-sm btn-edit mr-2" data-id="' . $row['id'] . '" data-toggle="modal" data-target="#editSymptoms"><i class="fas fa-edit"></i></button><button type="button" class="btn btn-danger btn-sm btn-delete" data-id="' . $row['id'] . '" data-toggle="modal" data-target="#deleteSymptoms"><i class="fas fa-trash"></i></button>';
        }

        $result = [
            'draw' => $this->request->getVar('draw'),
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $totalFiltered,
            'data' => $data
        ];

        return $this->response->setJSON($result);
    }

    public function create()
    {
        $symptomsModel = new ModelsSymptoms();

        if ($this->request->getMethod() == 'post') {
            $dataPost = $this->request->getVar();

            $dataInsert = [
                'code'          => $dataPost['code'],
                'description'   => strip_tags($dataPost['description'])
            ];


            if ($symptomsModel->insert($dataInsert)) {
                session()->setFlashData('success', 'Data berhasil ditambahkan.');
                return redirect()->to($_SERVER['HTTP_REFERER']);
            } else {
                session()->setFlashData('danger', 'Data gagal ditambahkan!');

                $errors = $symptomsModel->errors();
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
        $symptomsModel = new ModelsSymptoms();
        $data = $this->request->getVar();

        if ($this->request->getMethod() == 'post') {
            $dataPost = $this->request->getVar();

            $dataEdit = [
                'code'          => $dataPost['code'],
                'description'   => strip_tags($dataPost['description'])
            ];

            if ($symptomsModel->update($dataPost['id'], $dataEdit)) {
                session()->setFlashData('success', 'Data berhasil diupdate.');
                return redirect()->to($_SERVER['HTTP_REFERER']);
            } else {
                session()->setFlashData('danger', 'Data gagal diupdate!');

                $errors = $symptomsModel->errors();
                if ($errors) {
                    foreach ($errors as $error) {
                        log_message('error', $error);
                    }
                }
                return redirect()->to($_SERVER['HTTP_REFERER']);
            }
        } elseif ($this->request->isAJAX()) {
            $dataGet = $symptomsModel->find($data['id']);

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
        $symptomsModel = new ModelsSymptoms();
        $idPost = $this->request->getVar('idDelete');

        if ($this->request->getMethod() == 'post' && !empty($idPost)) {
            if ($symptomsModel->delete($idPost)) {
                session()->setFlashData('success', 'Data berhasil dihapus.');
                return redirect()->to($_SERVER['HTTP_REFERER']);
            } else {
                session()->setFlashData('danger', 'Data gagal dihapus!');

                $errors = $symptomsModel->errors();
                if ($errors) {
                    foreach ($errors as $error) {
                        log_message('error', $error);
                    }
                }
                return redirect()->to($_SERVER['HTTP_REFERER']);
            }
        }
    }

    public function getSymptoms()
    {
        $symptomModel = new ModelsSymptoms();

        $symptoms = $symptomModel->findAll();

        $data = [];
        foreach ($symptoms as $symptom) {
            $data[] = [
                'id' => $symptom['id'],
                'text' => $symptom['description']
            ];
        }

        return $this->response->setJSON($data);
    }
}

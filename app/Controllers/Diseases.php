<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Diseases as ModelsDiseases;
use CodeIgniter\HTTP\ResponseInterface;

class Diseases extends BaseController
{
    public function index()
    {
        return view('pages/diseases');
    }

    public function getData()
    {
        $diseasesModel = new ModelsDiseases();

        $start          = $this->request->getVar('start');
        $length         = $this->request->getVar('length');
        $searchValue    = $this->request->getVar('search')['value'];

        $query = $diseasesModel;

        if (!empty($searchValue)) {
            $query = $query->like('name', $searchValue)
                ->orLike('code', $searchValue)
                ->orLike('description', $searchValue)
                ->orLike('suggestion', $searchValue);
        }

        $totalRecords = $diseasesModel->countAll();

        $totalFiltered = $query->countAllResults(false);

        $data = $query->orderBy('id', 'ASC')
            ->findAll($length, $start);

        // Add action buttons
        foreach ($data as &$row) {
            $row['actions'] = '<a href="' . base_url('user/edit/' . $row['id']) . '" class="btn btn-sm btn-primary mr-3">Edit</a><a href="' . base_url('user/edit/' . $row['id']) . '" class="btn btn-sm btn-primary">Edit</a>';
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
        $diseasesModel = new ModelsDiseases();

        if ($this->request->getMethod() == 'post') {
            $dataPost = $this->request->getVar();

            $dataInsert = [
                'code'          => $dataPost['code'],
                'name'          => $dataPost['name'],
                'description'   => $dataPost['description'],
                'suggestion'    => $dataPost['suggestion'],
            ];


            if ($diseasesModel->insert($dataInsert)) {
                session()->setFlashData('success', 'Data berhasil ditambahkan.');
                return redirect()->to($_SERVER['HTTP_REFERER']);
            } else {
                session()->setFlashData('danger', 'Data gagal ditambahkan!');

                $errors = $diseasesModel->errors();
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
        $diseasesModel = new ModelsDiseases();

        if ($this->request->getMethod() == 'post') {
        } else {
        }
    }
}

<?php

namespace App\Controllers;

use App\Models\ComicsModel;

class Komik extends BaseController
{
    protected $comicsModel;

    public function __construct()
    {
        $this->comicsModel = new ComicsModel();
    }

    public function index()
    {
        // $comics = $this->comicsModel->findAll();
        
        $data = [
            'title' => 'Daftar Komik | Daffa CI4',
            'comics' => $this->comicsModel->getKomik()
        ]; 

        return view('komik/index', $data);
    }
    
    public function detail($slug)
    {
        $data = [
            'title' => 'Detail Komik | Daffa CI4',
            'comics' => $this->comicsModel->getKomik($slug)
        ];
        
        return view('komik/detail', $data);
    }
    
    public function create()
    {
        // session();
        $data = [
            'title' => 'Tambah Data Komik',
            'validation' => \Config\Services::validation()
        ]; 
    
        return view('komik/create', $data);
    }

    public function save()
    {   
        if(!$this->validate([
            'judul' => [
                'rules' => 'required|is_unique[comics.judul]',
                'errors' => [
                    'required' => '{field} komik harus diisi',
                    'is_unique' => '{field} komik sudah terdaftar'
                ]
            ],
            'sampul' => 'uploaded[sampul]|is_image[sampul]'
        ])) {
            // $validation = \Config\Services::validation();
            // return redirect()->to('/komik/create')->withInput()->with('validation', $validation);
            return redirect()->back()->withInput();
        }

        $slug = url_title($this->request->getVar('judul'), '-', true);
        $this->comicsModel->save([
            'judul' => $this->request->getVar('judul'),
            'slug' => $slug,
            'penulis' => $this->request->getVar('penulis'),
            'penerbit' => $this->request->getVar('penerbit'),
            'sampul' => $this->request->getVar('sampul'),
        ]);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan');

        return redirect()->to('/komik');
    }

    public function delete($id)
    {
        $this->comicsModel->delete($id);
        return redirect()->to('/komik');
    }

    public function edit($slug)
    {
        $data = [
            'title' => 'Ubah Data Komik',
            'validation' => \Config\Services::validation(),
            'comics' => $this->comicsModel->getKomik($slug)
        ]; 
    
        return view('komik/edit', $data);
    }

    public function update($id)
    {
        $komikLama = $this->comicsModel->getKomik(($this->request->getVar('slug')));
        if($komikLama['judul'] == $this->request->getVar('judul')) {
            $rule_judul = 'required';
        }
        else {
            $rule_judul = 'required|is_unique[comics.judul]';
        }

        if(!$this->validate([
            'judul' => [
                'rules' => $rule_judul,
                'errors' => [
                    'required' => '{field} komik harus diisi',
                    'is_unique' => '{field} komik sudah terdaftar'
                ]
            ]
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to('/komik/edit/' . $this->request->getVar('slug'))->withInput()->with('validation', $validation);
        }
        
        $slug = url_title($this->request->getVar('judul'), '-', true);
        $this->comicsModel->save([
            'id' => $id,
            'judul' => $this->request->getVar('judul'),
            'slug' => $slug,
            'penulis' => $this->request->getVar('penulis'),
            'penerbit' => $this->request->getVar('penerbit'),
            'sampul' => $this->request->getVar('sampul'),
        ]);

        return redirect()->to('/komik');
    }
}

<?php

namespace App\Models;

use CodeIgniter\Model;

class ComicsModel extends Model
{
    protected $table = 'comics';
    protected $useTimestamps = true;
    protected $allowedFields = ['judul', 'slug', 'penulis', 'penerbit', 'sampul'];

    public function getKomik($slug = false)
    {
        if($slug == false) {
            return $this->findAll();
        }

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan');

        return $this->where(['slug' => $slug])->first();
    }
}
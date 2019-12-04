<?php

namespace App\Controllers;

use App\Models\Kategori;

class KategoriController extends \Phalcon\Mvc\Controller
{

    public function indexAction()
    {
        $kategories = Kategori::find();
        $this->view->kategories = $kategories;
    }

    public function createAction(){
        $nama_kategori = $this->request->getPost('nama_kategori');
        $kategori = new Kategori();
        $kategori->nama_kategori = $nama_kategori;
        $kategori->save();
        $this->flashSession->success('Success Creating new Kategori');

        return $this->response->redirect('/kategori');
    }

    public function listAction(){

    }
    public function deleteAction(){
        $id = $this->request->getPost('id');
        $kategori = Kategori::findFirst($id);
        $kategori->delete();

        $this->flashSession->success('Success Deleting Kategori');

        return $this->response->redirect('/kategori');
    }

}


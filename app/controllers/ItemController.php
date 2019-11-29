<?php

namespace App\Controllers;
use App\Forms\ItemForm;
use App\Controllers\ControllerBase as Controller;
use App\Models\Items;

class ItemController extends Controller
{

    public function indexAction()
    {
        $items = Items::find();
        $this->view->items = $items;
        $this->view->kontol = 'KONTOL';
    }

    public function createAction(){
       $form = new ItemForm();

       $this->view->form = $form;
    }

    public function newAction(){
        $this->validateForm($_POST, $_FILES);

        $files = $this->request->getUploadedFiles();
        $file = $files[0];

        $file->moveTo('files'.$file->getName());

        $item = new Items();
        $item->nama_barang =$this->request->getPost('namaBarang');
        $item->harga_barang = $this->request->getPost('hargaBarang');
        $item->tipe_barang = $this->request->getPost('tipeBarang');
        $item->stock = $this->request->getPost('stock');
        $item->image = 'files/'.$file->getName();

        $item->save();

        $this->response->redirect('/item');
        return;
    }

    public function updateStockAction($id){
        $item = Items::findFirst($id);
        if(!$item){
            $this->flashSession->error("WRONG ID");
            return $this->_redirectBack();
        }
        $item->stock = $this->request->getPost('stok');
        $item->save();

        return $this->response->redirect('/item');
    }

    public function editAction($id){
        $item = Items::findFirst($id);
//        $this->view->disable();
//        return $item->nama_barang;
        $form = new ItemForm($item);

        $this->view->form = $form;
    }

    public function updateAction($id){
        $item = Items::findFirst($id);
        if(!$item){
            $this->flashSession->error("WRONG ID");
            return $this->_redirectBack();
        }

        $this->validateForm($_POST, $_FILES);
        $files = $this->request->getUploadedFiles();
        if($files[0]->getSize() > 0){
            $files = $this->request->getUploadedFiles();
            $file = $files[0];

            $file->moveTo('files/'.$file->getName());
            unlink($item->image);
            $item->image = 'files/'.$file->getName();
        }

        $item->nama_barang =$this->request->getPost('nama_barang');
        $item->harga_barang = $this->request->getPost('harga_barang');
        $item->tipe_barang = $this->request->getPost('tipe_barang');
        $item->stock = $this->request->getPost('stock');

        $item->save();

        $this->response->redirect('/item');
        return;
    }

    private function deleteAction($id){
        if ($this->request->isPost()) {
            if (!$this->security->checkToken()) {
                $this->flashSession->error("Request expired");
                return $this->_redirectBack();
            }
        }
        $item = Items::findFirst($id);
        if(!$item){
            $this->flashSession->error("WRONG ID");
            return $this->_redirectBack();
        }
        $item->delete();
        $this->response->redirect('/item');
        return ;

    }

    public function listItemAction($category){
        $item = Items::find([
            'conditions' => "tipe_barang='".$category."'",
            'columns' => 'id, nama_barang, harga_barang'
        ]);
        $this->view->disable();
        return json_encode($item);
    }

    private function validateForm($post, $files){
        $form = new ItemForm();
        if(!$form->isValid(array_merge($post, $files))){
            $messages = $form->getMessages();
            foreach ($messages as $message) {
                $this->flashSession->error($message);
            }

            return $this->_redirectBack();
        }
    }



}

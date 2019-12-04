<?php

namespace App\Controllers;
use App\Controllers\ControllerBase as Controller;
use App\Models\Kategori;
use App\Models\Transactions;
use App\Models\TransactionsItem;

class TransactionController extends Controller
{

    public function indexAction()
    {
        $this->view->transactions = Transactions::find();

    }

    public function createAction(){
        $this->view->kategories = Kategori::find();
    }

    public function storeAction(){
        $this->view->disable();

        $data = $this->request->getJsonRawBody();

        $transaction = new Transactions();
        $items = [];
        foreach ($data->cart as $key => $item){
            $items[$key] = new TransactionsItem();
            $items[$key]->items_id = $item->id;
            $items[$key]->jumlah = $item->jumlah;
            $items[$key]->total_harga = $item->total;
            $transaction->total_harga += $item->total;
        }
        $transaction->users = $this->getDI()->getShared('auth')->user();
        $transaction->transactionsItem = $items;
        $transaction->save();
        return $this->response->setJsonContent([
            'status' => 'SUCCESS',
            'message' => 'add transaction success'
        ]);
    }

    public function deleteAction(){
        if(!$this->request->isPost()){
            return $this->_redirectBack();
        }
        $id = $this->request->getPost('unique_id');
        $transactions = Transactions::findFirst($id);
        $transactions->delete();

        return $this->response->redirect('/transaction');
    }

}


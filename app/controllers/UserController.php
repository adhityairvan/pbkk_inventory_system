<?php
namespace App\Controllers;
use App\Forms\UserForm;
use App\Models\Users;

class UserController extends \Phalcon\Mvc\Controller
{

    public function indexAction()
    {
        $users = Users::find();
        $this->view->users = $users;

        $form = new UserForm();
        $this->view->form = $form;
        $transaction = Users::findFirst(1)->Transactions;
    return;
    }

    public function createAction(){
        $form = new UserForm();
        $user = new Users();
        $form->bind($_POST, $user);
        if($form->isValid()){
            $user->password = $this->security->hash($user->password);
            $user->save();
        }
        else{
            $messages = $form->getMessages();

            foreach ($messages as $message) {
                $this->flashSession->error($message);
            }
        }

        return $this->response->redirect('/user');
    }

    public function deleteAction(){
        $id = $this->request->getPost('user_id');
        $user = Users::findFirst($id);
        $user->delete();

        $this->flashSession->success('Delete user success');
        return $this->response->redirect('/user');
    }

}


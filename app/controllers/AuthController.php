<?php

namespace App\Controllers;

use App\Forms\LoginForm;
use App\Forms\RegisterForm;
use App\Models\Users;

class AuthController extends ControllerBase
{

    public function showLoginAction()
    {
        $this->view->loginForm = new LoginForm();
        $this->view->pick('auth/login');
    }

    public function loginAction()
    {
        $form = new LoginForm();
        if (!$form->isValid($_POST)) {
            foreach ($form->getMessages() as $message) {
                $this->flashSession->error($message);
            }
            return $this->_redirectBack();
        }
        $auth = $this->auth;
        $loggedIn = $auth->attemp($this->request->getPost('email'), $this->request->getPost('password'));
        if (!$loggedIn){
            $this->flashSession->error('Wrong email/password. Please enter the correct credentials');
            return $this->_redirectBack();
        }
        else{
            return $this->response->redirect('item');
        }
    }

    public function showRegisterAction(){
        $this->view->registerForm = new RegisterForm();
        $this->view->pick('auth/register');
    }

    public function registerAction(){
        $form = new RegisterForm();
        if(!$form->isValid($_POST)){
            foreach ($form->getMessages() as $message){
                $this->flashSession->error($message);
            }
            return $this->_redirectBack();
        }
        $user = new Users();
        $user->email = $this->request->getPost('email');
        $user->password = $this->security->hash($this->request->getPost('password'));
        $user->save();
        return $this->response->redirect('/login');
    }

    public function logoutAction(){
        $auth = $this->auth;
        $this->di->getShared('auth')->destroy();
        return $this->response->redirect('/login');
    }

    public function testAction() {
        return $this->config->guard->guests;
    }

}


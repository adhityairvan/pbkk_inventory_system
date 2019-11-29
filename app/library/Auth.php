<?php


namespace App\Libraries;

use Phalcon\DiInterface;
use Phalcon\Di;

use App\Models\Users;

class Auth
{
    protected $di;
    private $user = null;
    private $session;
    public function __construct(DiInterface $di)
    {
        $this->di = $di;
        $this->session = $di->getShared('session');
    }
    public function attemp(String $email, String $password) {
        $user = Users::findFirst("email = '".$email."'");
        if(!$user){
            return false;
        }
        $checkPass = $this->di->get('security')->checkHash($password, $user->password);
        if(!$checkPass){
            return false;
        }
        $this->session->set('user_id', $user->id);
        $this->user = $user;
        return true;
    }

    public function user(){
        if(!is_null($this->user)){
            return $this->user;
        }
        else if($this->session->has('user_id')){
            $this->user = Users::findFirst($this->session->get('user_id'));
            return $this->user();
        }
        else{
            return false;
        }
    }

    public function id(){
        return $this->session->get('user_id');
    }

    public function destroy(){
        if(!is_null($user)){
            $this->user = null;
        }
        $this->session->destroy();
    }

    public function checkAuth(){
        if($this->session->has('user_id')){
            return true;
        }
        else{
            return false;
        }
    }
}
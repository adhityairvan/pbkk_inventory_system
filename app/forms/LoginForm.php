<?php


namespace App\Forms;


use Phalcon\Forms\Element\Email;
use Phalcon\Forms\Element\Password;
use Phalcon\Forms\Form;
use Phalcon\Validation\Validator\Email as ValidEmail;
use Phalcon\Validation\Validator\PresenceOf;

class LoginForm extends Form
{
    public function initialize(){
        $email = new Email('email', [
            'placeholder' => 'enter registered email',
            'class' => 'form-control form-control-user',
            'aria-describedby' => 'emailHelp'
        ]);
        $email->addValidator(new PresenceOf());
        $email->addValidator(new ValidEmail());
        $password = new Password('password', [
            'placeholder' => 'enter valid password',
            'class' => 'form-control form-control-user',
        ]);
        $password->addValidator(new PresenceOf());

        $this->add($email);
        $this->add($password);

    }

}
<?php


namespace App\Forms;


use Phalcon\Forms\Element\Email;
use Phalcon\Forms\Element\Password;
use Phalcon\Forms\Form;
use Phalcon\Validation\Validator\Email as ValidEmail;
use Phalcon\Validation\Validator\PresenceOf;

class UserForm extends Form
{
    public function initialize(){
        $email = new Email('email', [
            'placeholder' => 'enter registered email',
            'class' => 'form-control',
            'aria-describedby' => 'emailHelp'
        ]);
        $email->addValidator(new PresenceOf());
        $email->addValidator(new ValidEmail());
        $password = new Password('password', [
            'placeholder' => 'enter valid password',
            'class' => 'form-control',
        ]);
        $password->addValidator(new PresenceOf());

        $this->add($email);
        $this->add($password);

    }

}
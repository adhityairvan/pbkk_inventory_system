<?php

namespace App\Controllers;
use Phalcon\Mvc\Controller;

class ControllerBase extends Controller
{
    protected function _redirectBack() {
        return $this->response->redirect($_SERVER['HTTP_REFERER']);
    }
}

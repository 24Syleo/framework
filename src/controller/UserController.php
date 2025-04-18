<?php

namespace Syleo24\Framework\controller;

use Syleo24\Framework\core\Controller;

class UserController extends Controller
{
    public function index()
    {
        $this->render('user', ['title' => 'Utilisateurs']);
    }

    public function add()
    {
        try {
            //code...
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}

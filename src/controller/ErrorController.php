<?php

namespace Syleo24\Framework\controller;

use Syleo24\Framework\core\Controller;

class ErrorController extends Controller
{
    public function index()
    {
        $this->render('error', ['title' => 'Erreur']);
    }
}

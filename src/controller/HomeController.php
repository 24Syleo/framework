<?php

namespace Syleo24\Framework\controller;

use Syleo24\Framework\core\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $this->render('home', ['title' => 'Accueil']);
    }
}

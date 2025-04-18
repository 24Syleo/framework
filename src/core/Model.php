<?php

namespace Syleo24\Framework\core;

use Syleo24\Framework\util\Database;
// /core/Controller.php

class Model
{
    public $pdo;

    public function __construct()
    {
        $this->pdo = Database::connect();
    }
}

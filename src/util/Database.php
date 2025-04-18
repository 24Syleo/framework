<?php

namespace Syleo24\Framework\util;

use PDO;
use Exception;

class Database
{
    /**
     * connection Database
     * @return PDO
     */
    public static function connect()
    {
        try {
            $db = new PDO('mysql:host=' . $_ENV['HOST_NAME'] . ';dbname=' . $_ENV['DB_NAME'], $_ENV['USER_NAME'], $_ENV['PASSWORD']);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            return $db;
        } catch (Exception $e) {
            throw $e;
        }
    }
}

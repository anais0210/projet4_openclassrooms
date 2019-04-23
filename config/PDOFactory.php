<?php
namespace config;

class PDOFactory
{
    public static function Connect()
    {
        $db = new \PDO('mysql:host=blog.local;dbname=db', 'root', 'root');
        $db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

        return $db;
    }
}
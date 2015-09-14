<?php
namespace Util;

class BDConnectionFactory
{
    const BANCO = "mydb";
    const USUARIO = "root";
    const SENHA = "";
    const HOSTNAME = "localhost";
    const PORT = 3306;
    private static $instance = null;
    private $connection;

    public function __construct()
    {
        self::connect();
    }

    private function connect()
    {
        $this->connection = mysqli_connect(self::HOSTNAME, self::USUARIO, self::SENHA, self::BANCO, self::PORT, null) or die('falha de banco de dados');
    }

    public static function getInstance()
    {
        if (self::$instance == null)
            return self::$instance = new BDConnectionFactory();
        else
            return self::$instance;
    }

    public function getConnection()
    {
        return $this->connection;
    }
}

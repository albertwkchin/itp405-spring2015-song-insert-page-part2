<?php
    namespace Itp\Base;
    use \PDO;

class Database {
    private $host = 'itp460.usc.edu';
    private $dbname = 'music';
    private $user = 'student';
    private $password = 'ttrojan';
    public static $pdo;

    public function __construct() {
        if (!static::$pdo) {
            $connectionString = "mysql:host=" . $this->host . ";dbname=" . $this->dbname;
            static::$pdo = new PDO($connectionString, $this->user, $this->password);
        }
    }

}
<?php
namespace App\Core;

use PDO;
use PDOException;

/**
 * Class Database
 * @package App\Core
 */
class Database
{
    protected static $instance;
    protected $pdo;

    protected function __construct() {
        $opt  = array(
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
            PDO::ATTR_EMULATE_PREPARES   => FALSE,
        );
        $this->pdo = new PDO("sqlite:".__DIR__."/../db/live.sqlite");
    }


    /**
     * a classical static method to make it universally available
     * @return Database
     */
    public static function instance()
    {
        if (self::$instance === null)
        {
            self::$instance = new self;
        }
        return self::$instance;
    }

    /**
     * a proxy to native PDO methods
     * @param $method
     * @param $args
     * @return mixed
     */
    public function __call($method, $args)
    {
        return call_user_func_array(array($this->pdo, $method), $args);
    }

    /**
     * helper function to run prepared statements
     * @param $sql
     * @param array $args
     * @return bool|\PDOStatement
     */
    public function run($sql, $args = [])
    {
        if (!$args)
        {
             //return $this->query($sql);
        }
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($args);
        return $stmt;
    }

    /**
     * Get a list of all tables
     * @return array
     */
    public function getTableList()
    {
        try {
            $tables = [];
            $sql = "SELECT  `name` FROM sqlite_master WHERE `type`='table'  ORDER BY name";
            $stmt = $this->pdo->query($sql);
            //$stmt->fetch(PDO::FETCH_ASSOC);
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $tables[] = $row['name'];
            }
            return $tables;
        }
        catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    /**
     * @return array
     */
    public function getFields()
    {
        try {
            $result = $this->pdo->query('select * from CODE limit 1');
            return array_keys($result->fetch(PDO::FETCH_ASSOC));
        }
        catch (PDOException $e) {
            echo $e->getMessage();
        }

    }

}

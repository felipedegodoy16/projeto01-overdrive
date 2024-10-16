<?php  
class ConexaoDAO {
    public static $instance;

    // Método Construtor
    public function __construct() {
        
    }

    public static function getConexao() {
        if(!isset(self::$instance)) {
            $db_name = 'teste';
            $db_host = '127.0.0.1';
            $db_user = 'root';
            $db_password = '';

            self::$instance = new PDO('mysql:host=' . $db_host . ';dbname=' . $db_name, $db_user, $db_password,
                array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
            self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            self::$instance->setAttribute(PDO::ATTR_ORACLE_NULLS, PDO::NULL_EMPTY_STRING);
        }
        return self::$instance;
    }
}
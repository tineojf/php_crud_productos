<?php
class Conexion
{
  protected $conexion_db;
  public function __construct()
  {
    $host = 'localhost';
    $db = 'dbEntregable';
    $user = 'root';
    $pass = '';
    $port = 3306;

    $options = array(
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    );
    try {
      $this->conexion_db = new PDO(
        'mysql:host=' . $host . ';port=' . $port . ';dbname=' . $db,
        $user,
        $pass,
        $options
      );
    } catch (Exception $ex) {
      echo "Conexion fallida" . $ex->getMessage();
      exit();
    }
  }
}


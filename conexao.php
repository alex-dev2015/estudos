<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 13/09/2017
 * Time: 20:17
 */

class Conexao {

    private static $pdo ;

    public static function getInstance()
    {
        if (!isset(self::$pdo)){
            try {
                $pdo = new PDO('mysql:host=localhost;dbname=planoe','root','opendb123!!');
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
            return $pdo;
        }
        return self::$pdo;
    }



}
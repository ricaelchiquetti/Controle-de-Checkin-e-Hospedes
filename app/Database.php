<?php

namespace App;

use Exception;
use mysqli;

/**
 * Classe para gerenciar a conexão com o DB.
 * @package App
 * @author Ricael V. Chiquetti <ricaelchiquetti28@gmail.com>
 */
class Database {

    //teoricamente colocar no CONFIG.php
    const
        SERVER = "localhost",
        USER = "root",
        DB = "hotel_db";

    /**
     * Cria uma nova conexão com o BD.
     * @return mysqli|false
     */
    public static function getConnection() {
        try {
            $connection = new mysqli(self::SERVER, self::USER, '', self::DB);
            if ($connection->connect_error) {
                throw new Exception("Conexão falhou: {$connection->connect_error}");
            }
            return $connection;
        } catch (Exception $e) {
            die("Erro na conexão: {$e->getMessage()}");
        }
    }
}

<?php
/*
classe para: 
 -efetuar a conexão com segurança; 
 -setar utf8;
 -setar atributo para aparecer os erros;
*/
    class MySql{

        private static $pdo;

        public static function connect(){

            if(self::$pdo == null){
                try{
                    self::$pdo = new PDO('mysql:host='.HOST.';dbname='.DB,USER,PASS,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8", PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_EMULATE_PREPARES => false));
                    self::$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                }catch(Exception $e){
                    echo 'erro ao conectar';
                }
            }
            return self::$pdo;
        }

    }


?>
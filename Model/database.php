<?php

class database{
    const server="localhost";
    const user="root";
    const password="";
    const dbname="db_sab_final";

    public static function conect(){
        try
        {
            $connection = new PDO("mysql:host=".self::server.";dbname=".self::dbname.";charset=utf8",self::user,self::password);

            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $connection;
        }
        catch(PDOException $e)
        {
            return "Falló".$e->getMessage();
        }
    }
}
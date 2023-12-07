<?php
require_once FCPATH . 'lib/adodb/adodb.inc.php';

class ADOdb
{
    static $initialize = null;
    public static $Db = null;

    private function __construct(){
        self::$Db = ADOnewConnection(LocalEnv::$driver);
        self::$Db->connect("", LocalEnv::$user, LocalEnv::$password, LocalEnv::$database);
        self::$Db->execute("SET NAMES 'utf8'");
    }

    public static function Connect(){
        if(self::$initialize == null){
            self::$initialize = new ADOdb();
        }
        return self::$initialize;
    }
}
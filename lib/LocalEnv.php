<?php 
class LocalEnv {

    static $driver;
    static $host;
    static $user;
    static $password;
    static $database;
    static $decryptionMethod;
    static $secretKey;
    static $server_name;
    static $server_port;

    public static function Init()
    {
        $__ARRS = array();
        $fopen = fopen(__DIR__ . "/.env", 'r');
        if ($fopen) {
            while (($line = fgets($fopen)) !== false) {
                $line_is_comment = (substr(trim($line), 0, 1) == '#') ? true : false;
                if ($line_is_comment || trim($line) == '') continue;

                $exp = explode("#", $line, 2);
                $line_no_comment = $exp[0];
                $env_ex = preg_split('/(\s?)\=(\s?)/', $line_no_comment);
                $env_name = trim($env_ex[0]);
                $env_value = isset($env_ex[1]) ? trim($env_ex[1]) : "";
                $__ARRS["{$env_name}"] = $env_value;
            }
            fclose($fopen);
        }
        self::$driver = $__ARRS['DB_DRIVER'];
        self::$host = $__ARRS['DB_HOST'];
        self::$user = $__ARRS['DB_USER'];
        self::$password = $__ARRS['DB_PASSWORD'];
        self::$database = $__ARRS['DB_DATABASE'];
        self::$decryptionMethod = $__ARRS['decryptionMethod'];
        self::$secretKey = $__ARRS['secretKey'];
        
        if($__ARRS['MODE'] == 'development'){
            self::$server_name = $__ARRS['DEV_SERVER_NAME'];
            self::$server_port = $__ARRS['DEV_SERVER_PORT'];
        } else {
            self::$server_name = $__ARRS['PRO_SERVER_NAME'];
            self::$server_port = $__ARRS['PRO_SERVER_PORT'];
        }
    }
}
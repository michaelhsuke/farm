<?php
/**
 * Created by PhpStorm.
 * User: xuke
 * Date: 2015/9/19
 * Time: 17:19
 */

interface IConnectInfo {

    const HOST = 'localhost';
    const UNAME = 'root';
    const PASSWD = 'abc123!@#';
    const DBNAME = 'test';

    public function doConnect();
}

class UniversalConnect implements IConnectInfo {

    private static $server = IConnectInfo::HOST;
    private static $currentDB = IConnectInfo::DBNAME;
    private static $user = IConnectInfo::UNAME;
    private static $pass = IConnectInfo::PASSWD;
    private static $hookup;
    public function doConnect() {
        self::$hookup = mysqli_connect(self::$server, self::$user, self::$pass, self::$currentDB);
        if (self::$hookup) {
            echo 'Successful connection to MySQL';
        } elseif (mysqli_connect_error(self::$hookup)) {
            echo 'Here is why it failed ' . mysqli_connect_error();
        }

        return self::$hookup;
    }
}
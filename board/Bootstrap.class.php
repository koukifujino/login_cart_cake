<?php
namespace board;

require_once(dirname(__FILE__) . './../vendor/autoload.php');

class Bootstrap {
    const DB_HOST = 'localhost';
    const DB_NAME = 'xs442994_usercake';
    const DB_USER = 'xs442994_fujino';
    const DB_PASS = '28090060';

    const APP_DIR = '/home/xs442994/xs442994.xsrv.jp/public_html/login_cart_cake/';

    const TEMPLATE_DIR = self::APP_DIR . 'templates/board/';
    const CACHE_DIR = false;

    const X_SERVER_HOST = 'localhost';
    const X_SERVER_PORT = 'xs442994_usercake';
    const X_SERVER_USER = 'xs442994_fujino';
    const X_SERVER_PASS = '28090060';

    public static function loadClass($class) {
        $path = str_replace('\\', '/', self::APP_DIR . $class . '.class.php');
        require_once $path;
    }

    public static function connectToXServer() {
        $connection = ssh2_connect(self::X_SERVER_HOST, self::X_SERVER_PORT);
        ssh2_auth_password($connection, self::X_SERVER_USER, self::X_SERVER_PASS);
        // ここに、Xサーバー上で何を行うかを指定します。
    }
}

spl_autoload_register([
    'board\Bootstrap',
    'loadClass'
]);

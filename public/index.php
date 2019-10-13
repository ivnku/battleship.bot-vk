<?php
require_once dirname(__DIR__) . '/config/config.php';
require_once ROOT . '/vendor/autoload.php';


if ($_SERVER['REQUEST_URI'] == '/confirmation') {
    echo CONFIRM_TOKEN;
} else {
    $data = json_decode(file_get_contents('php://input'));
    var_dump($data);  
}

<?php
require_once dirname(__DIR__) . '/config/config.php';
require_once ROOT . '/vendor/autoload.php';

use BSBot\Game\Field;

if ($_SERVER['REQUEST_URI'] == '/confirmation') {
    echo CONFIRM_TOKEN;
} else {
//    $data = json_decode(file_get_contents('php://input'));
//    var_dump($data);
    
    $bot = new Field();
    $bot->generateShips('141414');
    
    for ($i = 0; $i < 10; $i++) {
        foreach ($bot->map as $letter) {
            echo $letter[$i] . ' ';
        }
        echo '<br>';
    }
    echo '<br>';
    print_r($bot->ships);
}

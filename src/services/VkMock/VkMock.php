<?php

namespace BSBot\services\VkMock;


/**
 * Class VkMock - mock of the vk server which sends requests to the game
 * @package BSBot\services\VkMock
 */
class VkMock
{
    public static function send(string $message): string 
    {
        //TODO forming of the message
        return json_encode($message);
    }
}
<?php

namespace BSBot\services\Logger;


class Logger
{
    /**
     * @param string $message
     * @param string $filename
     * @param string $type - trace (default) or error
     */
    public static function log(string $message, string $filename = 'log', string $type = 'trace'): void
    {
        $file = fopen(LOGS . "/{$filename}.txt", 'a');
        $date = date('H:i:s d.m.Y');
        
        $start = "============================= {$date} ==============================\n";
        $end   = "\n================================================================================\n\n\n";
        
        if ($type == 'error') {
            $start = "XXXXXXXXXXXXXXXXXXXXXXXXXXXXX {$date} XXXXXXXXXXXXXXXXXXXXXXXXXXXXX\n";
            $end = "\nXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX\n\n\n";
        }
        
        fwrite($file, $start . $message . $end);
    }
}
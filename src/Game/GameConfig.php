<?php

class GameConfig {
    private const LETTER_COORD = [
        'player' => [
            'A' => 70, 'Б'=>105, 'В'=>140, 'Г'=>175, 'Д'=>210, 'Е'=>245, 'Ж'=>280, 'З'=>315, 'И'=>350, 'К'=>385
        ],
        'opponent' => [
            'A' => 490, 'Б'=>525, 'В'=>560, 'Г'=>595, 'Д'=>630, 'Е'=>665, 'Ж'=>700, 'З'=>735, 'И'=>770, 'К'=>805
        ]
    ];
    
    private const NUMBERS_COORD = [
        '1'=>140, '2'=>175, '3'=>210, '4'=>245, '5'=>280, '6'=>315, '7'=>350, '8'=>385, '9'=>420, '10'=>455
    ];
    
    /**
     * Get an array of 'x' and 'y' coordinates, where shot takes place
     * 
     * @param string $side - player or opponent
     * @param string $letter
     * @param string $number
     * @return array
     */
    public static function getCoord(string $side, string $letter, string $number): array
    {
        return ['letter' => self::LETTER_COORD[$side][$letter], 'number' => self::NUMBERS_COORD[$number]];
    }
}

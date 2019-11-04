<?php

namespace BSBot\Game;

class GameConfig {
    /**
     * Array for connecting letters with coordinates of picture cells
     */
    public const LETTER_COORD = [
        'player' => [
            'A' => 70, 'Б'=>105, 'В'=>140, 'Г'=>175, 'Д'=>210, 'Е'=>245, 'Ж'=>280, 'З'=>315, 'И'=>350, 'К'=>385
        ],
        'opponent' => [
            'A' => 490, 'Б'=>525, 'В'=>560, 'Г'=>595, 'Д'=>630, 'Е'=>665, 'Ж'=>700, 'З'=>735, 'И'=>770, 'К'=>805
        ]
    ];
    
    /**
     * Array for connecting numbers with coordinates of picture cells
     */
    public const NUMBERS_COORD = [
        '1'=>140, '2'=>175, '3'=>210, '4'=>245, '5'=>280, '6'=>315, '7'=>350, '8'=>385, '9'=>420, '10'=>455
    ];
    
    /**
     * Array for connecting 'x' indexes of the $map array with coordinates of picture cells
     */
    public const X_INDEX_COORD = [
        'player' => [ 70, 105, 140, 175, 210, 245, 280, 315, 350, 385 ],
        'opponent' => [ 490, 525, 560, 595, 630, 665, 700, 735, 770, 805 ]
    ];
    
    /**
     * Array for connecting 'y' indexes of the $map array with coordinates of picture cells
     */
    public const Y_INDEX_COORD = [ 140, 175, 210, 245, 280, 315, 350, 385, 420, 455 ];
}

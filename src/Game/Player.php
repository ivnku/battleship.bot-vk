<?php

namespace BSBot\Game;


class Player
{
    /**
     * VK id of a player
     * @var string
     */
    public $player_id;
    
    /**
     * String like "Б2"
     * @var string 
     */
    public $move;
    
    /**
     * Field object which contains player's field and 
     * array containing arrays of ships' coordinates
     * @var Field 
     */
    public $field;
    
    /**
     * Two dimensional array of player's opponent field
     * @var array 
     */
    public $opponent_field;
    
    /**
     * The last move on the opponent field
     * @var array 
     */
    public $last_action;
    
    public function __construct(string $player_id, string $move, Field $field, array $opponent_field, array $last_action)
    {
        $this->player_id      = $player_id;
        $this->move           = $move;
        $this->field          = $field;
        $this->opponent_field = $opponent_field;
        $this->last_action    = $last_action;
    }
}
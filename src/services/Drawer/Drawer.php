<?php

namespace BSBot\services\Drawer;

use BSBot\Game\GameConfig;
use Imagine\Imagick\Imagine;
use Imagine\Image\Point;

class Drawer
{
    /**
     * @var Imagine - object for interacting with imagick library
     */
    private $imagine;
    
    /**
     * @var \Imagine\Image\ImageInterface|object - object of game field
     */
    private $field;
    
    public function __construct()
    {
        $this->imagine = new Imagine();
        //$this->field   = $this->imagine->open(IMAGES . '/initial_field.png'); //TODO remove from here and open image from sessions
    }
    
    /**
     * Saves field to the session directory
     * 
     * @param string $player_id
     */
    public function saveField(string $player_id): void
    {
        $this->field->save(SESSIONS . "/{$player_id}.png");
    }
    
    /**
     * Draws ships on the initial field picture. Every ship is drawn starting 
     * in a one point either from the up to the down or from the left to the right
     * 
     * @param array $ships - array of ships' coordinates
     * @param string $player_id - vk id of player
     */
    public function drawShips(array $ships, string $player_id): void
    {
        $this->field = $this->imagine->open(IMAGES . '/initial_field.png');
        
        foreach ($ships as $ship) {
            if (count($ship) == 1) {
                $xy = $this->getPictureCoords('player', $ship[0]);
                $point = new Point($xy[0], $xy[1]);
                $shipPic = $this->imagine->open(IMAGES . "/1_ship.png");
                $this->field->paste($shipPic, $point);
            } else {
                
                $isVertical = $ship[0][0] == $ship[1][0];
                $xy = [];
                
                if ($isVertical) {
                    
                    if (end($ship)[1] - $ship[0][1] < 0) { // means first point is below the last
                        $xy = $this->getPictureCoords('player', end($ship));
                    } else {
                        $xy = $this->getPictureCoords('player', $ship[0]);
                    }
                    $shipPic = $this->imagine->open(IMAGES . "/".count($ship)."_ship.png");
                    $shipPic = $shipPic->rotate(90);
                    
                } else {
                    
                    if(end($ship)[0] - $ship[0][0] < 0) {
                        $xy = $this->getPictureCoords('player', end($ship));
                    } else {
                        $xy = $this->getPictureCoords('player', $ship[0]);
                    }
                    $shipPic = $this->imagine->open(IMAGES . "/".count($ship)."_ship.png");
                }
                
                $point = new Point($xy[0], $xy[1]);
                $this->field->paste($shipPic, $point);
            }
        }
        $this->saveField($player_id);
    }
    
    /**
     * Draws a hit (a cross) on the field object
     * 
     * @param string $side - a player's or an opponent's field
     * @param string $playerMove - the point which user has chosen (e.g. "Б2")
     */
    public function drawHit(string $side, string $playerMove): void
    {
        $xy = $this->getPictureCoords($side, $playerMove);
        $point = new Point($xy[0], $xy[1]);
        $hit = $this->imagine->open(IMAGES . '/hit.png');
        $this->field->paste($hit, $point);
    }
    
    /**
     * Draws a miss (a point) on the field object
     * 
     * @param string $side - a player's or an opponent's field
     * @param string $playerMove - the point which user has chosen (e.g. "Б2")
     */
    public function drawMiss(string $side, string $playerMove): void
    {
        $xy = $this->getPictureCoords($side, $playerMove);
        $point = new Point($xy[0], $xy[1]);
        $miss = $this->imagine->open(IMAGES . '/miss.png');
        $this->field->paste($miss, $point);
    }
    
    /**
     * Get 'x' and 'y' coordinates on the picture from player input or from two indexes of map
     * 
     * @param string $side - a player's or an opponent's field
     * @param string|array $input - the point which user has chosen (e.g. "Б2") 
     * or array of the player's field array
     * @return array
     */
    public function getPictureCoords(string $side, $input): array
    {
        if(gettype($input) == 'string') {
            return [GameConfig::LETTER_COORD[$side][$input[0]], GameConfig::NUMBERS_COORD[$input[1]]];
        } else {
            return [GameConfig::X_INDEX_COORD[$side][$input[0]], GameConfig::Y_INDEX_COORD[$input[1]]];
        }
    }
}
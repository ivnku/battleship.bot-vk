<?php

namespace BSBot\services\Drawer;

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
        $this->field   = $this->imagine->open(IMAGES . '/initial_field.png');
    }
    
    public function saveField(string $player_id, string $opponent_id): void
    {
        $this->field->save(SESSIONS . "/{$player_id}_{$opponent_id}.png");
    }
    
    /**
     * Draws a ship of the specific type on the field object
     * 
     * @param int $type - type of ship
     * @param int $x
     * @param int $y
     * @param $position - vertical or horizontal
     */
    public function drawShip(int $type, int $x, int $y, string $position): void
    {
        $point = new Point($x, $y);
        $ship = $this->imagine->open(IMAGES . "/{$type}_ship.png");
        if ($position == 'vertical') {
            $ship = $ship->rotate(90);
        }
        
        $this->field->paste($ship, $point);
    }
    
    /**
     * Draws a hit (a cross) on the field object
     * 
     * @param int $x
     * @param int $y
     */
    public function drawHit(int $x, int $y): void
    {
        $point = new Point($x, $y);
        $hit = $this->imagine->open(IMAGES . '/hit.png');
        $this->field->paste($hit, $point);
    }
    
    /**
     * Draws a miss (a point) on the field object
     * 
     * @param int $x
     * @param int $y
     */
    public function drawMiss(int $x, int $y): void
    {
        $point = new Point($x, $y);
        $miss = $this->imagine->open(IMAGES . '/miss.png');
        $this->field->paste($miss, $point);
    }
}
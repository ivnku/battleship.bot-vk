<?php

namespace BSBot\Game;

class Field
{
    public $field = [];
    public $ships = [];
    
    public function __construct()
    {
        // TODO deserialize $field array from redis
    }
    
    /**
     * Generating of the initial field with ships
     */
    public function generateShips(): void
    {
        // every array is a letter and every item is a number of the field
        $this->field = array_fill(0, 10, [0,0,0,0,0,0,0,0,0,0]);

        $ships = [4, 3, 3, 2, 2, 2, 1, 1, 1, 1];
        $empty = $this->field; // empty array for getting random point from it
        
        foreach ($ships as $ship) {
            $isPlaced = false;
            $currShipEmpty = $empty; // map of empty cells for current ship
            
            while ($isPlaced == false) {
                $letter = array_rand($currShipEmpty);
                $number = array_rand($currShipEmpty[$letter]);
                if (! $isPlaced = $this->findPosition(['letter' => $letter, 'number' => $number], $ship, $empty)) {
                    unset($currShipEmpty[$letter][$number]);
                }
                
            }
        }
    }
    
    /**
     * Once we found empty point we should find the full position for {n} decker to place.
     * We search in 4 directions
     *      ^
     *     *|*
     *    <-p->
     *     *|*
     *      V
     * @param array $point - the found empty point
     * @param int $ship - the number of a ship's decks
     * @param array $empty - array of empty cells of the field
     * @return bool - found or not
     */
    private function findPosition(array $point, int $ship, array &$empty): bool 
    {
        if (rand(0,1)) { // choose what we will change first: letter or number
            // assoc arrays require tricky logic for shuffle
            $keys = array_keys($point);
            shuffle($keys);
            $point = array_merge(array_flip($keys), $point);
        }
        
        $directions = [-1, 1];
        if (rand(0,1)) { // choose which way we will go first: adding to coordinate or subtracting
           shuffle($directions); 
        }
        
        $shipCoords = []; // ship coords if searching for empty space will finally succeed
        $isPlaceFound = false;
        
        foreach ($point as $coordinate => $value) {
            foreach ($directions as $direction) {
                
                $shipCoords[] = [$point['letter'], $point['number']];
                for ($j = 1; $j < $ship; $j++) {
                    if ($coordinate == 'letter') {
                        
                        if (! isset($empty[$value + $j * $direction][$point['number']]) ) {
                            $shipCoords = [];
                            continue 2;
                        }
                        $shipCoords[] = [$value + $j * $direction, $point['number']]; 
                        
                    } else {
                        
                        if (! isset($empty[$point['letter']][$value + $j * $direction]) ) {
                            $shipCoords = [];
                            continue 2;
                        }
                        $shipCoords[] = [$point['letter'], $value + $j * $direction];
                        
                    }
                }
                $this->placeShip($shipCoords, $empty);
                $isPlaceFound = true;
                break 2;
                
            }
        }
        
        return $isPlaceFound;
    }
    
    /**
     * Once position was found we remove coordinates of the ship from $empty as well as
     * coordinates which are around the ship. Also we fill $this->field with the new ship
     * 
     * @param array $shipCoords - coordinates of the placed ship
     * @param array $empty - array of empty cells of the field
     */
    public function placeShip(array $shipCoords, array &$empty): void
    {
        $offset = [-1, 0, 1]; // the offset for one of the coordinates
        
        foreach ($shipCoords as $coords) {
            $this->field[$coords[0]][$coords[1]] = 1; // saving ship coords to the field variable
        }
        $this->ships[] = $shipCoords;
        
        foreach ($shipCoords as $coords) {
            $letter = $coords[0];
            $number = $coords[1];
            foreach ($offset as $off) {
                for ($i = -1; $i < 2; $i++) {
                    if (isset($empty[$letter + $off][$number + $i])) {
                        if (count($empty[$letter + $off]) == 1) {
                            unset($empty[$letter + $off]); // if it's last element - we remove array
                        } else {
                            unset($empty[$letter + $off][$number + $i]); // instead we remove element
                        }
                    }
                }
            }
        }
    }
    
}

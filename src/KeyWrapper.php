<?php
/**
 * Created by PhpStorm.
 * User: xyden
 * Date: 19.07.2018
 * Time: 14:08
 */

namespace Xydens\Configuration;


class KeyWrapper implements \Iterator {

    /**
     * @var array
     */
    protected $parts;

    /**
     * @var int
     */
    private $position = 0;

    /**
     * KeyWrapper constructor.
     * @param $string
     */
    function __construct($string) {
        $this->parts = self::makePartsFromString($string);
        $this->position = 0;
    }

    /**
     * @param $string
     * @return array
     */
    protected static function makePartsFromString($string){
        if(strlen($string) < 1)
            throw new \RuntimeException('Key must be a real, not empty string!');
        return explode('.',$string);
    }

    public function length(){
        return count($this->parts);
    }

    public function remainingLength(){
        return $this->length() - $this->key();
    }

    /**
     * @return array
     */
    public function getParts() {
        return $this->parts;
    }

    public function rewind() {
        $this->position = 0;
    }

    public function current() {
        return $this->parts[$this->position];
    }

    public function key() {
        return $this->position;
    }

    public function next() {
        ++$this->position;
    }

    public function valid() {
        return isset($this->parts[$this->position]);
    }

    public function getPassedParts(){
        return array_slice($this->parts,0,$this->position);
    }

    public function getPath(){
        return implode('.',$this->getParts());
    }

    public function getPassedPath(){
        return implode('.',$this->getPassedParts());
    }

}
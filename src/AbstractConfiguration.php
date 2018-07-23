<?php
/**
 * Created by PhpStorm.
 * User: xyden
 * Date: 19.07.2018
 * Time: 15:43
 */

namespace Xydens\Configuration;

use Xydens\Configuration\Interfaces\Configuration;
use Xydens\Configuration\Interfaces\Loader;

use Xydens\Configuration\Helpers;
use Xydens\Configuration\Exceptions\ConfigurationException;
use Xydens\Configuration\Exceptions\KeyMissingException;
use Xydens\Configuration\Exceptions\NotObjectException;

/**
 * {@inheritdoc}
 * @package Xydens\Configuration
 */
abstract class AbstractConfiguration implements Configuration{

    /**
     * @var array
     */
    protected $array = [];

    /**
     * MutableConfiguration constructor.
     * @param Loader|null $loader
     */
    function __construct($loader = null) {
        if($loader != null){
            $loader->load();
            $this->array = $loader->getConfigurationArray();
        }
    }

    /**
     * {@inheritdoc}
     */
    public function toArray(){
        return $this->array;
    }

    /**
     * {@inheritdoc}
     */
    public function get($key, $default = null) {
        try{
            return $this->getOrFail($key);
        }
        catch (ConfigurationException $exception){
            return $default;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getOrFail($key) {
        $wrapped_key = self::wrapKey($key);
        return Helpers::reduceIterator(function($acc,$part) use($wrapped_key){
            if(!is_array($acc)) {
                throw new NotObjectException($wrapped_key);
            }
            if(!array_key_exists($part,$acc))
                throw new KeyMissingException($wrapped_key);
            return $acc[$part];
        },$wrapped_key,$this->array);
    }


    /**
     * {@inheritdoc}
     */
    public function has($key) {
        $wrapped_key = self::wrapKey($key);
        $array = $this->array;
        $result = true;
        while ($wrapped_key->valid()){
            if( !(is_array($array) && array_key_exists($wrapped_key->current(),$array)) ){
                $result = false;
                break;
            }
            $array = $array[$wrapped_key->current()];
            $wrapped_key->next();
        }
        $wrapped_key->rewind();
        return $result;
    }

    /**
     * Mutates configuration object
     * @param KeyWrapper $key
     * @param mixed $value
     */
    protected function mutate(KeyWrapper $key,$value){
        $this->array = self::recursiveMutate($this->array,$key,$value);
        $key->rewind();
    }

    /**
     * Helper function for mutation
     * @param array $array
     * @param KeyWrapper $key
     * @param mixed $value
     * @return array
     * @throws NotObjectException
     */
    protected static function recursiveMutate($array,KeyWrapper $key,$value){
        $current_part = $key->current();
        $key->next();
        if($key->remainingLength() == 0){
            $array[$current_part] = $value;
        }
        else{
            if(!array_key_exists($current_part,$array))
                $array[$current_part] = [];
            if(!is_array($array[$current_part]))
                throw new NotObjectException($key);
            $array[$current_part] = self::recursiveMutate($array[$current_part],$key,$value);
        }
        return $array;
    }

    public function mergeWithMutation(Configuration $configuration){
        $this->array = array_merge($configuration->toArray(),$this->array);
    }

    /**
     * @param string $key
     * @return KeyWrapper
     */
    protected static function wrapKey($key){
        return new KeyWrapper($key);
    }

}
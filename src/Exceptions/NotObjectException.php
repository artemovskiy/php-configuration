<?php
/**
 * Created by PhpStorm.
 * User: xyden
 * Date: 19.07.2018
 * Time: 14:20
 */

namespace Xydens\Configuration\Exceptions;

use Xydens\Configuration\KeyWrapper;


class NotObjectException extends ConfigurationException {

    /**
     * @var KeyWrapper
     */
    protected $key;

    /**
     * KeyMissingException constructor.
     * @param KeyWrapper $key
     */
    public function __construct($key) {
        $this->key = $key;
        parent::__construct($this->makeMessage(), 500, null);
    }

    protected function makeMessage(){
        return "Config value by path \"{$this->key->getPassedPath()}\" is not an object! Could not process \"{$this->key->getPath()}\"!";
    }

}